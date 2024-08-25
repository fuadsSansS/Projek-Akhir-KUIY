<?php

namespace App\Http\Controllers;

use App\Models\ZipFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class UploadZipController extends Controller
{
    public function index()
    {
        // $userFiles = ZipFile::where('id_user', Auth::id())->get();
        // return view('dashboard', compact('userFiles'));

        if (Auth::user()->role === 'admin') {
            $zipFiles = ZipFile::all();
        } else {
            $zipFiles = ZipFile::where('id_user', Auth::id())->get();
        }

        return view('dashboard', compact('zipFiles'));

    }
    public function create()
    {
        return view('form-file');
    }


    public function edit($fileId)
    {
        $zipFile = ZipFile::findOrFail($fileId);
        return view('edit-file', compact('zipFile'));
    }

    public function update(Request $request, $fileId)
    {
        $request->validate([
            'zip_file' => 'required|mimes:zip|max:2048',
        ]);

        $zipFile = ZipFile::findOrFail($fileId);

        // Hapus file lama jika diperlukan
        Storage::delete('uploads/datadiri' . $zipFile->nama_file);

        $newFileName = time() . '_' . $request->user()->name . '.' . $request->zip_file->extension();
        $request->zip_file->storeAs('public/uploads/datadiri', $newFileName);

        // Update record di database
        $zipFile->update([
            'nama_file' => $newFileName,
        ]);

        return redirect()->route('index')->with('success', 'File berhasil diupdate.');
    }

    public function save(Request $request)
    {

        $request->validate([
            'zip_file' => 'required|mimes:zip|max:20000',
        ]);

        $zipFileName = time() . '_' . $request->user()->name . '.' . $request->zip_file->extension();
        $request->zip_file->storeAs('uploads/datadiri', $zipFileName, 'public');


        $zipFile = ZipFile::create([
            'id_user' => $request->user()->id,
            'nama_file' => $zipFileName // Pastikan sesuai dengan nama field di database
        ]);

        return redirect()->route('index')->with('success', 'File berhasil diupload.');
    }

    public function delete($fileId)
    {
        $zipFile = ZipFile::findOrFail($fileId);

        // Hapus file yang terkait
        Storage::delete('uploads/datadiri' . $zipFile->nama_file);

        // Hapus record dari database
        $zipFile->delete();

        return redirect()->route('index')->with('success', 'File berhasil dihapus.');
    }

    public function download($fileId)
    {
        $zipFile = ZipFile::findOrFail($fileId);
        $filePath = 'public/uploads/datadiri/' . $zipFile->nama_file;


        $headers = [
            'Content-Type' => Storage::mimeType($filePath),
        ];

        $newName = 'downloaded_' . $zipFile->nama_file;

        return response()->download(Storage::path($filePath), $newName, $headers);
    }
}
