<?php

use App\Models\Dormitory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisaController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RincianController;
use App\Http\Controllers\AsuransiController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomestayController;
use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\UploadZipController;
use App\Http\Controllers\KeimigrasianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {

    Route::get('dashboard', [UploadZipController::class, 'index'])->name('index');
    Route::get('dashboard/create',[UploadZipController::class,'create'])->name('create');
    Route::get('dashboard/edit', [UploadZipController::class, 'edit'])->name('edit');
    Route::get('/files/{fileId}/edit', [UploadZipController::class, 'edit'])->name('file.edit');
    Route::get('/files/{fileId}/download', [UploadZipController::class, 'download'])->name('file.download');

    Route::get('/asuransi', [AsuransiController::class, 'index'])->name('asuransi');
    Route::get('/asuransi/create', [AsuransiController::class, 'create'])->name('asuransi.create');
    Route::get('/asuransi/edit/{id}', [AsuransiController::class, 'edit'])->name('asuransi.edit');


    Route::get('/keimigrasian', [KeimigrasianController::class, 'index'])->name('keimigrasian');
    Route::get('/keimigrasian/create', [KeimigrasianController::class, 'create'])->name('keimigrasian.create');
    Route::get('/keimigrasian/edit/{id}', [KeimigrasianController::class, 'edit'])->name('keimigrasian.edit');
    Route::get('/keimigrasian/view/{id}', [KeimigrasianController::class, 'view'])->name('keimigrasian.view');

    // Homestay Views
    Route::get('/homestay', [HomestayController::class, 'index'])->name('homestay');
    Route::get('/homestay/create', [HomestayController::class, 'create'])->name('homestay.create');
    Route::get('/homestay/edit/{id}', [HomestayController::class, 'edit'])->name('homestay.edit');
    Route::get('/homestay/view/{id}', [HomestayController::class, 'view'])->name('homestay.view');

    Route::get('/dormitory',[DormitoryController::class,'index'])->name('dormitory');
    Route::get('/dormitory/create', [DormitoryController::class, 'create'])->name('dormitory.create');
    Route::get('/dormitory/edit/{id}', [DormitoryController::class, 'edit'])->name('dormitory.edit');
    Route::get('/dormitory/view/{id}', [DormitoryController::class, 'view'])->name('dormitory.view');

    Route::get('/hotel',[HotelController::class,'index'])->name('hotel');
    Route::get('/hotel/create', [HotelController::class, 'create'])->name('hotel.create');
    Route::get('/hotel/edit/{id}', [HotelController::class, 'edit'])->name('hotel.edit');
    Route::get('/hotel/view/{id}', [HotelController::class, 'view'])->name('hotel.view');


    Route::get('/visa', [VisaController::class, 'index'])->name('visa');
    Route::get('/visa/create', [VisaController::class, 'create'])->name('visa.create');
    Route::get('/visa/edit/{id}', [VisaController::class, 'edit'])->name('visa.edit');

    Route::get('/rincian', [RincianController::class, 'indexAdmin'])->name('rincian');
    Route::get('/rincian/view/{id}', [RincianController::class, 'view'])->name('rincian.view');

    Route::get('/profile/rincian', [RincianController::class, 'indexUser'])->name('profile.rincian');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/save', [UploadZipController::class,'save'])->name('dashboard.save');
Route::delete('/files/{fileId}/delete', [UploadZipController::class, 'delete'])->name('file.delete');

Route::post('asuransi/save', [AsuransiController::class, 'save'])->name('asuransi.save');
Route::post('asuransi/pilih/{id}', [AsuransiController::class, 'pilih'])->name('asuransi.pilih');
Route::patch('asuransi/update/{id}', [AsuransiController::class, 'update'])->name('asuransi.update');
Route::delete('asuransi/delete/{id}', [AsuransiController::class, 'delete'])->name('asuransi.delete');

// Keimigrasian Operations
Route::post('keimigrasian/save', [KeimigrasianController::class, 'save'])->name('keimigrasian.save');
Route::post('keimigrasian/pilih/{id}', [KeimigrasianController::class, 'pilih'])->name('keimigrasian.pilih');
Route::patch('keimigrasian/update/{id}', [KeimigrasianController::class, 'update'])->name('keimigrasian.update');
Route::delete('keimigrasian/delete/{id}', [KeimigrasianController::class, 'delete'])->name('keimigrasian.delete');

// Homestay Operations
Route::post('homestay/save', [HomestayController::class, 'save'])->name('homestay.save');
Route::post('homestay/pilih/{id}', [HomestayController::class, 'pilih'])->name('homestay.pilih');
Route::patch('homestay/update/{id}', [HomestayController::class, 'update'])->name('homestay.update');
Route::delete('homestay/delete/{id}', [HomestayController::class, 'delete'])->name('homestay.delete');

Route::post('dormitory/save', [DormitoryController::class, 'save'])->name('dormitory.save');
Route::post('dormitory/pilih/{id}', [DormitoryController::class, 'pilih'])->name('dormitory.pilih');
Route::patch('dormitory/update/{id}', [DormitoryController::class, 'update'])->name('dormitory.update');
Route::delete('dormitory/delete/{id}', [DormitoryController::class, 'delete'])->name('dormitory.delete');


Route::post('hotel/save', [HotelController::class, 'save'])->name('hotel.save');
Route::post('hotel/pilih/{id}',[HotelController::class,'pilih'])->name('hotel.pilih');
Route::patch('hotel/update/{id}', [HotelController::class, 'update'])->name('hotel.update');
Route::delete('hotel/delete/{id}', [HotelController::class, 'delete'])->name('hotel.delete');


Route::delete('rincian/delete-keimigrasian/{id}', [RincianController::class, 'deleteKeimigrasian'])->name('rincian.delete');
Route::delete('rincian/delete-asuransi/{id}', [RincianController::class, 'deleteAsuransi'])->name('rincian.delete');
Route::delete('rincian/delete-homestay/{id}', [RincianController::class, 'deleteHomestay'])->name('rincian.delete');

// Visa Operations
Route::post('visa/save', [VisaController::class, 'save'])->name('visa.save');
Route::patch('visa/update/{id}', [VisaController::class, 'update'])->name('visa.update');
Route::delete('visa/delete/{id}', [VIsaController::class, 'delete'])->name('visa.delete');

Route::delete('rincian/delete-keimigrasian/{id}', [RincianController::class, 'deleteKeimigrasian'])->name('rincian.delete');
Route::delete('rincian/delete-asuransi/{id}', [RincianController::class, 'deleteAsuransi'])->name('rincian.delete');
Route::delete('rincian/delete-homestay/{id}', [RincianController::class, 'deleteHomestay'])->name('rincian.delete');
Route::delete('rincian/delete-dormitory/{id}', [RincianController::class, 'deleteDormitory'])->name('rincian.delete');
Route::delete('rincian/delete-hotel/{id}', [RincianController::class, 'deleteHotel'])->name('rincian.delete');

// Download Operations
Route::get('/download-file/{fileName}', [DownloadController::class, 'download'])->name('download');

require __DIR__.'/auth.php';
