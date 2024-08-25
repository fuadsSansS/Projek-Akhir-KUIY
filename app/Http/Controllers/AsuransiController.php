<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Rincian;
use App\Models\Asuransi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Responses\BaseResponse;
use Illuminate\Support\Facades\Auth;

class AsuransiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rincianUser = Rincian::where("id_user", $user->id)->first();
        $dataAsuransi = Asuransi::orderBy('created_at', 'DESC')->paginate(5);

        $pilihAsuransi = false;
        if ($rincianUser != null) {
             if ($rincianUser->id_asuransi == null) {
                 $pilihAsuransi = true;
             }
        }

        return view('akomodasi/asuransi/asuransi', compact('dataAsuransi','pilihAsuransi'));
    }

    public function create()
    {
        return view('akomodasi/asuransi/asuransi');
    }

    public function edit(string $id)
    {
        $asuransi = Asuransi::where('id_asuransi', $id)->first();
        return view('akomodasi/asuransi/asuransi', compact('asuransi'));
    }

    public function save(Request $request)
    {
        try {

            $request->validate([
                'nama_asuransi' => ['required'],
                'harga' => ['required']
            ]);

            $newAsuransi = Asuransi::create([
                'id_asuransi' => Str::uuid(),
                'nama_asuransi' => $request->nama_asuransi,
                'harga' => str_replace('.', '', $request->harga)
            ]);

            $newAsuransi->save();

        } catch (Exception $e) {
            return BaseResponse::errorResponse($e->getMessage());
        }
        return BaseResponse::successResponse('Create Asuransi!');

    }

    public function update(Request $request, string $id)
    {
        try {
            $asuransi = Asuransi::where('id_asuransi', $id)->first();
            $asuransi->nama_asuransi = $request->nama_asuransi;
            $asuransi->harga = str_replace('.', '', $request->harga);
            $asuransi->save();
        } catch (Exception $e) {
            return BaseResponse::errorResponse($e->getMessage());
        }
        return BaseResponse::successResponse('Update Asuransi!');
    }

    public function delete(string $id)
    {
        try {
            $asuransi = Asuransi::findOrfail($id);

            if ($asuransi) {
                $asuransi->delete();
            }
        } catch (Exception $e) {
            return BaseResponse::errorResponse('Asuransi Not Found!');
        }
        return BaseResponse::successResponse('Delete Asuransi!');
    }

    public function pilih(string $id)
    {
        try {
            $id_user = Auth::user()->id;
            $asuransi = Asuransi::findOrfail($id);
            $rincianUser = Rincian::where('id_user', $id_user)->first();

            if ($rincianUser->id_asuransi != null) {
                return BaseResponse::errorResponse('Sudah Pilih asuransi!');
            }
            $rincianUser->id_asuransi = $asuransi->id_asuransi;
            $rincianUser->save();
        } catch (Exception $e) {
            return BaseResponse::errorResponse('Asuransi Not Found!');
        }
        return BaseResponse::successResponse('Pilih Asuransi!');
    }

}
