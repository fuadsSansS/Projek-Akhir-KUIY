<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Upload;
use App\Models\Rincian;
use App\Models\Homestay;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responses\BaseResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadController;


class HomestayController extends Controller
{
    public function index()
    {
        $dataHomestay = Homestay::orderBy('created_at', 'DESC')->paginate(3);

        foreach ($dataHomestay as $homestay) {
            $dataPhoto = Upload::where('id_parent', $homestay->id_homestay)->first();
            if ($dataPhoto) {
                $fileName = $dataPhoto->file_name;
                $fileType = $dataPhoto->file_type;
                $homestay->cover = $fileName . "." . $fileType;
            } else {
                $homestay->cover = "Cover Image";
            }
        }
        $pilihHomestay = $this->checkStatusRincian();

        return view('akomodasi/homestay/homestay', compact('dataHomestay', 'pilihHomestay'));
    }

    public function create()
    {

        return view('akomodasi/homestay/homestay');
    }

    public function edit(string $id)
    {
        $homestay = Homestay::where('id_homestay', $id)->first();
        $dataPhoto = Upload::where('id_parent', $id)->get();

        return view('akomodasi/homestay/homestay', compact('homestay','dataPhoto'));
    }

    public function view(string $id)
    {
        $homestay = Homestay::where('id_homestay', $id)->first();
        $dataPhoto = Upload::where('id_parent', $id)->get();
        $pilihHomestay = $this->checkStatusRincian();

        return view('akomodasi/homestay/homestay', compact('homestay', 'dataPhoto', 'pilihHomestay'));
    }

    public function save(Request $request)
    {
        try {
            $request->validate([
                'nama_homestay' => ['required'],
                'alamat' => ['required'],
                'jarak_mobil' => ['required'],
                'jarak_motor' => ['required'],
                'jarak_jk' => ['required'],
                'ipl' => ['required'],
                'listrik' => ['required'],
                'wifi' => ['required'],
                'kelebihan' => ['required'],
                'kekurangan' => ['required'],
                'harga' => ['required']
                ]);

            DB::beginTransaction();
            $uuid = Str::uuid();
            $newHomestay = Homestay::create([
                'id_homestay' => $uuid,
                'nama_homestay' => $request->nama_homestay,
                'alamat' => $request->alamat,
                'jarak_ke_yarsi_mobil' => $request->jarak_mobil,
                'jarak_ke_yarsi_motor' => $request->jarak_motor,
                'jarak_ke_yarsi_jk' => $request->jarak_jk,
                'ipl' => str_replace('.', '', $request->ipl),
                'listrik' => str_replace('.', '', $request->listrik),
                'wifi' => str_replace('.', '', $request->wifi),
                'kelebihan' => $request->kelebihan,
                'kekurangan' => $request->kekurangan,
                'harga' => str_replace('.', '', $request->harga),
            ]);
            $newHomestay->save();

            if ($request->hasFile('files')) {
                $uploadController = new UploadController();
                $newPhoto = $uploadController->uploadPhoto($request, $uuid);
                $responseData = json_decode($newPhoto->getContent(), true);

                if ($responseData['responseCode'] != '200') {
                    return BaseResponse::errorResponse("Failed Upload!");
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return BaseResponse::errorResponse($e->getMessage());
        }
        return BaseResponse::successResponse('Create Homestay!');
    }

    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $homestay = Homestay::where('id_homestay', $id)->first();
            $homestay->nama_homestay = $request->nama_homestay;
            $homestay->alamat = $request->alamat;
            $homestay->jarak_ke_yarsi_mobil = $request->jarak_mobil;
            $homestay->jarak_ke_yarsi_motor = $request->jarak_motor;
            $homestay->jarak_ke_yarsi_jk = $request->jarak_jk;
            $homestay->ipl = str_replace('.', '', $request->ipl);
            $homestay->listrik = str_replace('.', '', $request->listrik);
            $homestay->wifi = str_replace('.', '', $request->wifi);
            $homestay->kelebihan = $request->kelebihan;
            $homestay->kekurangan = $request->kekurangan;
            $homestay->harga = str_replace('.', '', $request->harga);
            $homestay->save();

            if ($request->hasFile('files')) {
                $uploadController = new UploadController();

                $deleteOldPhoto = $uploadController->deleteUpload($id);
                $responseDataDelete = json_decode($deleteOldPhoto->getContent(), true);

                if ($responseDataDelete['responseCode'] == '200') {
                    $newPhoto = $uploadController->uploadPhoto($request, $id);
                    $responseDataUpload = json_decode($newPhoto->getContent(), true);

                    if ($responseDataUpload['responseCode'] != '200') {
                        return BaseResponse::errorResponse("Failed Upload!");
                    }
                }
            }
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return BaseResponse::errorResponse($e->getMessage());
        }
        return BaseResponse::successResponse('Update Homestay!');
    }

    public function delete(string $id)
    {
        try {
            $homestay = Homestay::findOrfail($id);

            if ($homestay) {
                $homestay->delete();
            }
        } catch (Exception $e) {
            return BaseResponse::errorResponse('Homestay Not found!');
        }
        return BaseResponse::successResponse('Delete Homestay!');
    }

    public function pilih(string $id)
    {
        try {
            $id_user = Auth::user()->id;
            $homestay = Homestay::findOrfail($id);
            $rincianUser = Rincian::where('id_user', $id_user)->first();

            if ($rincianUser->id_homestay != null) {
                return BaseResponse::errorResponse('Sudah Pilih Homestay!');
            }
            $rincianUser->id_homestay = $homestay->id_homestay;
            $rincianUser->save();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return BaseResponse::errorResponse('Homestay Not Found!');
        }
        return BaseResponse::successResponse('Pilih Homestay!');
    }

    public function checkStatusRincian() {
        $user = Auth::user();
        $rincianUser = Rincian::where("id_user", $user->id)->first();
        $pilihHomestay = false;
        if ($rincianUser && $rincianUser->id_homestay == null) {
            $pilihHomestay = true;
        }

        return $pilihHomestay;
    }
}
