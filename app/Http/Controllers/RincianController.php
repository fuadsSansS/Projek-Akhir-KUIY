<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Rincian;
use App\Http\Responses\BaseResponse;
use Illuminate\Support\Facades\Auth;

class RincianController extends Controller
{
    public function indexUser() {
        $user = Auth::user();
        $rincian = Rincian::where('id_user', $user->id)->firstOrFail();
        $this->hitungTotalRincian($rincian);

        return view('profile/rincian', compact('rincian'));
    }

    public function indexAdmin() {
        $dataRincian = Rincian::orderBy('created_at', 'DESC')->paginate(10);
        return view('rincian', compact('dataRincian'));
    }

    public function view($id) {
        $rincian = Rincian::where('id_user', $id)->firstOrFail();
        $this->hitungTotalRincian($rincian);

        return view('profile/rincian', compact('rincian'));
    }

    public function deleteKeimigrasian() {
        $user = Auth::user();

        try {
            $rincian = Rincian::where('id_user', $user->id)->firstOrFail();
            $rincian->id_keimigrasian = null;
            $rincian->save();
        } catch (Exception $e) {
            return BaseResponse::errorResponse("Keimigrasian Not Found!");
        }

        return BaseResponse::successResponse('Delete Keimigrasian!');
    }

    public function deleteAsuransi() {
        $user = Auth::user();

        try {
            $rincian = Rincian::where('id_user', $user->id)->firstOrFail();
            $rincian->id_asuransi = null;
            $rincian->save();
        } catch (Exception $e) {
            return BaseResponse::errorResponse("Asuransi Not Found!");
        }

        return BaseResponse::successResponse('Delete Asuransi!');
    }

    public function deleteHomestay() {
        $user = Auth::user();

        try {
            $rincian = Rincian::where('id_user', $user->id)->firstOrFail();
            $rincian->id_homestay = null;
            $rincian->save();
        } catch (Exception $e) {
            return BaseResponse::errorResponse("Homestay Not Found!");
        }

        return BaseResponse::successResponse('Delete Homestay!');
    }

    public function deleteDormitory() {
        $user = Auth::user();

        try {
            $rincian = Rincian::where('id_user', $user->id)->firstOrFail();
            $rincian->id_dormitory = null;
            $rincian->save();
        } catch (Exception $e) {
            return BaseResponse::errorResponse("dormitori Not Found!");
        }

        return BaseResponse::successResponse('Delete Dormitory!');
    }

    public function deleteHotel() {
        $user = Auth::user();

        try {
            $rincian = Rincian::where('id_user', $user->id)->firstOrFail();
            $rincian->id_hotel = null;
            $rincian->save();
        } catch (Exception $e) {
            return BaseResponse::errorResponse("Hotel Not Found!");
        }

        return BaseResponse::successResponse('Delete Hotel!');
    }

    public function hitungTotalRincian($dataRincian) {
        $totalRincian = 0;
        if (!is_null($dataRincian->homestay)) {
            $totalRincian += $dataRincian->homestay->harga;
        }

        if (!is_null($dataRincian->asuransi)) {
            $totalRincian += $dataRincian->asuransi->harga;
        }

        if (!is_null($dataRincian->keimigrasian)) {
            $totalRincian += $dataRincian->keimigrasian->total_biaya;
        }
        $dataRincian->totalRincian = $totalRincian;
    }
}
