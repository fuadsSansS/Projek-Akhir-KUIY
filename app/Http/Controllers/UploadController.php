<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Upload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Responses\BaseResponse;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function uploadPhoto(Request $request, $parent)
    {
        $validator = Validator::make($request->all(), [
            'files.*' => 'image|mimes:jpeg,png,jpg|max:1024', // Max size: 1MB
        ]);

        if ($validator->fails()) {
            return BaseResponse::errorResponse($validator->errors()->first());
        }

        try {
            foreach ($request->file('files') as $file) {
                $this->saveUpload($file, $parent);
            }
        } catch (Exception $e) {
            return BaseResponse::errorResponse($e->getMessage());
        }

        return BaseResponse::successResponse("Success Upload Photo!");
    }

    public function uploadFile(Request $request, $parent)
    {
        $validator = Validator::make($request->all(), [
            'files.*' => 'mimes:pdf,doc,docx|max:2024', // Max size: 1MB
        ]);

        if ($validator->fails()) {
            return BaseResponse::errorResponse($validator->errors()->first());
        }

        try {
            foreach ($request->file('files') as $file) {
                $this->saveUpload($file, $parent);
            }
        } catch (Exception $e) {
            return BaseResponse::errorResponse($e->getMessage());
        }

        return BaseResponse::successResponse("Success Upload File!");
    }

    public function saveUpload($file, $parent)
    {
        $fileSavedName = $file->getClientOriginalName();
        $fileName = pathinfo($fileSavedName, PATHINFO_FILENAME);
        $fileType = $file->getClientOriginalExtension();

        if (in_array(strtolower($fileType), ['png', 'jpg', 'jpeg', 'gif'])) {
            $file->storeAs('uploads/images', $fileSavedName, 'public');
        } else {
            $file->storeAs('uploads/files', $fileSavedName, 'public');
        }

        $newUpload = Upload::create([
            'id_upload' => Str::uuid(),
            'id_parent' => $parent,
            'file_name' => $fileName,
            'file_type' => $fileType
        ]);
        $newUpload->save();
    }

    public function deleteUpload($idParent) {
        try {
            $uploads = Upload::where('id_parent', $idParent)->get();

            foreach ($uploads as $upload) {
                $this->deleteToStorage($upload);
            }
        } catch (Exception $e) {
            return BaseResponse::errorResponse($e->getMessage());
        }
        return BaseResponse::successResponse("Success Delete File!");
    }

    public function deleteToStorage($upload)
    {
        $path = $this->getStoragePath($upload->file_type, $upload->file_name);
        Storage::disk('public')->delete($path);

        $upload->delete();
    }

    private function getStoragePath($fileType, $fileName)
    {
        if (in_array(strtolower($fileType), ['png', 'jpg', 'jpeg', 'gif'])) {
            return 'uploads/images/' . $fileName;
        } else {
            return 'uploads/files/' . $fileName;
        }
    }

}
