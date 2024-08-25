<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Upload;
use App\Models\Rincian;
use App\Models\Dormitory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responses\BaseResponse;
use Illuminate\Support\Facades\Auth;

class DormitoryController extends Controller
{
    public function index(){

        $dataDormitory = Dormitory::orderBy('created_at', 'DESC')->paginate(3);

        foreach ($dataDormitory as $dormitory) {
            $dataPhoto = Upload::where('id_parent', $dormitory->id_dormitory)->first();
            if ($dataPhoto) {
                $fileName = $dataPhoto->file_name;
                $fileType = $dataPhoto->file_type;
                $dormitory->cover = $fileName . "." . $fileType;
            } else {
                $dormitory->cover = "Cover Image";
            }
        }
        $pilihDormitory = $this->checkStatusRincian();

        return view('akomodasi/dormitory/dormitory', compact('dataDormitory', 'pilihDormitory'));

    }

    public function create()
    {

        return view('akomodasi/dormitory/dormitory');
    }

    public function edit(string $id)
    {
        $dormitory = Dormitory::where('id_dormitory', $id)->first();
        $dataPhoto = Upload::where('id_parent', $id)->get();

        return view('akomodasi/dormitory/dormitory', compact('dormitory','dataPhoto'));
    }

    public function view(string $id)
    {
        $dormitory = Dormitory::where('id_dormitory', $id)->first();
        $dataPhoto = Upload::where('id_parent', $id)->get();
        $pilihDormitory = $this->checkStatusRincian();

        return view('akomodasi/dormitory/dormitory', compact('dormitory', 'dataPhoto', 'pilihDormitory'));
    }


    public function save(Request $request)
    {
        try {
            $request->validate([
                'nama_dormitory' => ['required'],
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
            $newDormitory = Dormitory::create([
                'id_dormitory' => $uuid,
                'nama_dormitory' => $request->nama_dormitory,
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
            $newDormitory->save();

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
        return BaseResponse::successResponse('Create Dormitory!');
    }

    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $dormitory = Dormitory::where('id_dormitory', $id)->first();
            $dormitory->nama_dormitory = $request->nama_dormitory;
            $dormitory->alamat = $request->alamat;
            $dormitory->jarak_ke_yarsi_mobil = $request->jarak_mobil;
            $dormitory->jarak_ke_yarsi_motor = $request->jarak_motor;
            $dormitory->jarak_ke_yarsi_jk = $request->jarak_jk;
            $dormitory->ipl = str_replace('.', '', $request->ipl);
            $dormitory->listrik = str_replace('.', '', $request->listrik);
            $dormitory->wifi = str_replace('.', '', $request->wifi);
            $dormitory->kelebihan = $request->kelebihan;
            $dormitory->kekurangan = $request->kekurangan;
            $dormitory->harga = str_replace('.', '', $request->harga);
            $dormitory->save();

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
        return BaseResponse::successResponse('Update dormitory!');
    }

    public function delete(string $id)
    {
        try {
            $dormitory = Dormitory::findOrfail($id);

            if ($dormitory) {
                $dormitory->delete();
            }
        } catch (Exception $e) {
            return BaseResponse::errorResponse('Dormitory Not found!');
        }
        return BaseResponse::successResponse('Delete Dormtory!');
    }

    public function pilih(string $id)
    {
        try {
            $id_user = Auth::user()->id;
            $dormitory = Dormitory::findOrfail($id);
            $rincianUser = Rincian::where('id_user', $id_user)->first();

            if ($rincianUser->id_dormitory != null) {
                return BaseResponse::errorResponse('Sudah Pilih dormitory!');
            }
            $rincianUser->id_dormitory = $dormitory->id_dormitory;
            $rincianUser->save();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return BaseResponse::errorResponse('Dormitory Not Found!');
        }
        return BaseResponse::successResponse('Pilih Dormitory!');
    }

    public function checkStatusRincian() {
        $user = Auth::user();
        $rincianUser = Rincian::where("id_user", $user->id)->first();
        $pilihDormitory = false;
        if ($rincianUser && $rincianUser->id_dormitory == null) {
            $pilihDormitory = true;
        }

        return $pilihDormitory;
    }
}
