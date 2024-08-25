<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Hotel;
use App\Models\Upload;
use App\Models\Rincian;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responses\BaseResponse;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    //
    public function index(){

        $dataHotel = Hotel::orderBy('created_at', 'DESC')->paginate(3);

        foreach ($dataHotel as $hotel) {
            $dataPhoto = Upload::where('id_parent', $hotel->id_hotel)->first();
            if ($dataPhoto) {
                $fileName = $dataPhoto->file_name;
                $fileType = $dataPhoto->file_type;
                $hotel->cover = $fileName . "." . $fileType;
            } else {
                $hotel->cover = "Cover Image";
            }
        }
        $pilihHotel = $this->checkStatusRincian();

        return view('akomodasi/hotel/hotel', compact('dataHotel', 'pilihHotel'));
    }

    public function create(){
        return view('akomodasi.hotel.hotel');
    }

    public function edit(string $id)
    {
        $hotel = Hotel::where('id_hotel', $id)->first();
        $dataPhoto = Upload::where('id_parent', $id)->get();

        return view('akomodasi/hotel/hotel', compact('hotel','dataPhoto'));
    }

    public function view(string $id)
    {
        $hotel = Hotel::where('id_hotel', $id)->first();
        $dataPhoto = Upload::where('id_parent', $id)->get();
        $pilihHotel = $this->checkStatusRincian();

        return view('akomodasi/hotel/hotel', compact('hotel', 'dataPhoto', 'pilihHotel'));
    }

    public function save(Request $request)
    {
        try {
            $request->validate([
                'nama_hotel' => ['required'],
                'alamat' => ['required'],
                'jarak_mobil' => ['required'],
                'jarak_motor' => ['required'],
                'jarak_jk' => ['required'],
                'kelebihan' => ['required'],
                'kekurangan' => ['required'],
                'harga' => ['required']
                ]);

            DB::beginTransaction();
            $uuid = Str::uuid();
            $newhotel = Hotel::create([
                'id_hotel' => $uuid,
                'nama_hotel' => $request->nama_hotel,
                'alamat' => $request->alamat,
                'jarak_ke_yarsi_mobil' => $request->jarak_mobil,
                'jarak_ke_yarsi_motor' => $request->jarak_motor,
                'jarak_ke_yarsi_jk' => $request->jarak_jk,
                'kelebihan' => $request->kelebihan,
                'kekurangan' => $request->kekurangan,
                'harga' => str_replace('.', '', $request->harga),
            ]);
            $newhotel->save();

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
        return BaseResponse::successResponse('Create hotel!');
    }


    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $hotel = Hotel::where('id_hotel', $id)->first();
            $hotel->nama_hotel = $request->nama_hotel;
            $hotel->alamat = $request->alamat;
            $hotel->jarak_ke_yarsi_mobil = $request->jarak_mobil;
            $hotel->jarak_ke_yarsi_motor = $request->jarak_motor;
            $hotel->jarak_ke_yarsi_jk = $request->jarak_jk;
            $hotel->kelebihan = $request->kelebihan;
            $hotel->kekurangan = $request->kekurangan;
            $hotel->harga = str_replace('.', '', $request->harga);
            $hotel->save();

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
        return BaseResponse::successResponse('Update hotel!');
    }


    public function delete(string $id)
    {
        try {
            $hotel = Hotel::findOrfail($id);

            if ($hotel) {
                $hotel->delete();
            }
        } catch (Exception $e) {
            return BaseResponse::errorResponse('Hotel Not found!');
        }
        return BaseResponse::successResponse('Delete Hotel!');
    }

    public function pilih(string $id)
    {
        try {
            $id_user = Auth::user()->id;
            $hotel = Hotel::findOrfail($id);
            $rincianUser = Rincian::where('id_user', $id_user)->first();

            if ($rincianUser->id_hotel != null) {
                return BaseResponse::errorResponse('Sudah Pilih hotel!');
            }
            $rincianUser->id_hotel = $hotel->id_hotel;
            $rincianUser->save();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return BaseResponse::errorResponse('hotel Not Found!');
        }
        return BaseResponse::successResponse('Pilih hotel!');
    }

    public function checkStatusRincian() {
        $user = Auth::user();
        $rincianUser = Rincian::where("id_user", $user->id)->first();
        $pilihHotel = false;
        if ($rincianUser && $rincianUser->id_hotel == null) {
            $pilihHotel = true;
        }

        return $pilihHotel;
    }
}
