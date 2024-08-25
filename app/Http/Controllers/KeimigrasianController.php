<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Rincian;
use Illuminate\Support\Str;
use App\Models\Keimigrasian;
use Illuminate\Http\Request;
use App\Http\Responses\BaseResponse;
use Illuminate\Support\Facades\Auth;


class KeimigrasianController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dataKeimigrasian = Keimigrasian::orderBy('created_at', 'DESC')->paginate(5);
        $pilihKeimigrasian = $this->checkStatusRincian();

        return view('akomodasi/keimigrasian/keimigrasian', compact('dataKeimigrasian', 'pilihKeimigrasian'));
    }

    public function create()
    {
        return view('akomodasi/keimigrasian/keimigrasian');
    }

    public function edit(string $id)
    {
        $keimigrasian = Keimigrasian::where('id_keimigrasian', $id)->first();
        return view('akomodasi/keimigrasian/keimigrasian', compact('keimigrasian'));
    }

    public function view(string $id)
    {
        $keimigrasian = Keimigrasian::where('id_keimigrasian', $id)->first();
        $pilihKeimigrasian = $this->checkStatusRincian();

        return view('akomodasi/keimigrasian/keimigrasian', compact('keimigrasian', 'pilihKeimigrasian'));
    }

    public function save(Request $request)
    {
        try {
            $newKeimigrasian = Keimigrasian::create([
                'id_keimigrasian' => Str::uuid(),
                'item' => $request->item,
                'keimigrasian' => $request->keimigrasian,
                'kemenaker' => $request->kemenaker,
                'biaya_keimigrasian' => str_replace('.', '', $request->biaya_keimigrasian),
                'biaya_kemenaker' => str_replace('.', '', $request->biaya_kemenaker),
                'total_biaya' => str_replace('.', '', $request->total_biaya)
            ]);
            $newKeimigrasian->save();

        } catch (Exception $e) {
            return BaseResponse::errorResponse($e->getMessage());
        }
        return BaseResponse::successResponse('Create Keimigrasian!');
    }

    public function update(Request $request, string $id)
    {
        try {
            $keimigrasian = Keimigrasian::where('id_keimigrasian', $id)->first();

            $keimigrasian->item = $request->item;
            $keimigrasian->keimigrasian = $request->keimigrasian;
            $keimigrasian->kemenaker = $request->kemenaker;
            $keimigrasian->save();
        } catch (Exception $e) {
            return BaseResponse::errorResponse($e->getMessage());
        }
        return BaseResponse::successResponse('Update Keimigrasian!');
    }

    public function delete(string $id)
    {
        try {
            $keimigrasian = Keimigrasian::findOrfail($id);

            if ($keimigrasian) {
                $keimigrasian->delete();
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return BaseResponse::errorResponse('Keimigrasian Not Found!');
        }
        return BaseResponse::successResponse('Delete Keimigrasian!');
    }

    public function pilih(string $id)
    {
        try {
            $id_user = Auth::user()->id;
            $keimigrasian = Keimigrasian::findOrfail($id);
            $rincianUser = Rincian::where('id_user', $id_user)->first();

            if ($rincianUser->id_keimigrasian != null) {
                return BaseResponse::errorResponse('Sudah Pilih Keimigrasian!');
            }
            $rincianUser->id_keimigrasian = $keimigrasian->id_keimigrasian;
            $rincianUser->save();
        } catch (Exception $e) {
            return BaseResponse::errorResponse('Keimigrasian Not Found!');
        }
        return BaseResponse::successResponse('Pilih Keimigrasian!');
    }

    public function checkStatusRincian() {
        $user = Auth::user();
        $rincianUser = Rincian::where("id_user", $user->id)->first();
        $pilihKeimigrasian = false;
        if ($rincianUser && $rincianUser->id_keimigrasian == null) {
            $pilihKeimigrasian = true;
        }

        return $pilihKeimigrasian;
    }
}
