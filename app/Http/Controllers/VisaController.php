<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use App\Models\Visa;
use App\Models\Upload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responses\BaseResponse;

class VisaController extends Controller
{

    public function index()
    {
        $dataVisa = Visa::orderBy('created_at', 'DESC')->paginate(5);
        foreach ($dataVisa as $visa) {
            $dataPhoto = Upload::where('id_parent', $visa->id_visa)->first();
            if ($dataPhoto) {
                $fileName = $dataPhoto->file_name;
                $fileType = $dataPhoto->file_type;
                $visa->file = $fileName . "." . $fileType;
            } else {
                $visa->file = "Cover File";
            }
        }
        return view('Administrasi/visa', compact('dataVisa'));
    }

    public function create()
    {
        return view('Administrasi/visa');
    }

    public function edit(string $id)
    {
        $visa = Visa::where('id_visa', $id)->first();
        return view('Administrasi/visa', compact('visa'));
    }

    public function save(Request $request)
    {
        try {
            DB::beginTransaction();
            $uuid = Str::uuid();
            $newVisa = Visa::create([
                'id_visa' => $uuid,
                'nama_formulir' => $request->nama_formulir,
            ]);

            $newVisa->save();

            if ($request->hasFile('files')) {
                $uploadController = new UploadController();
                $newPhoto = $uploadController->uploadFile($request, $uuid);
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
        return BaseResponse::successResponse('Create Visa!');
    }

    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $visa = Visa::where('id_visa', $request->id)->first();

            $visa->nama_formulir = $request->nama_formulir;

            if ($request->hasFile('files')) {
                $uploadController = new UploadController();

                $deleteOldFile = $uploadController->deleteUpload($id);
                $responseDataDelete = json_decode($deleteOldFile->getContent(), true);

                if ($responseDataDelete['responseCode'] == '200') {
                    $newFile = $uploadController->uploadFile($request, $id);
                    $responseDataUpload = json_decode($newFile->getContent(), true);

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
        return BaseResponse::successResponse('Update Succes!');
    }

    public function delete(string $id)
    {
        try {
            $visa = Visa::findOrfail($id);

            if ($visa) {
                $visa->delete();
            }
        } catch (Exception $e) {
            return BaseResponse::errorResponse('Visa Not found!');
        }
        return BaseResponse::successResponse('Delete visa!');
    }
}
