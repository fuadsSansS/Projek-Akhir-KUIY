<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download($fileName)
    {
        $filePath = 'uploads/files/' . $fileName;
        $headers = [
            'Content-Type' => Storage::mimeType($filePath),
        ];

        return response()->download(storage_path("app/public/{$filePath}"), $fileName, $headers);
    }
}
