@extends('layouts.app')
@section('dashboard')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if (Route::is('hotel.edit'))
                <h6 class="m-0 font-weight-bold text-primary">Edit hotel</h6>
                <form id="update-hotel" class="mt-6 space-y-6">
                    @method('PATCH')
                    <input type="hidden" name="id_hotel" id="id_hotel" value="{{ $hotel->id_hotel }}">
                @else
                    <h6 class="m-0 font-weight-bold text-primary">Create hotel</h6>
                    <form id="create-hotel" role="form">
            @endif
            @csrf
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="col-lg-13">
                        <div class="form-group">
                            <label for="nama_hotel">Nama hotel</label>
                            <input type="text" id="nama_hotel" name="nama_hotel" class="form-control"
                                value="{{ Route::is('hotel.edit') ? $hotel->nama_hotel : '' }}"
                                {{ Route::is('hotel.create') ? 'autofocus' : '' }} required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Addres</label>
                            <input type="text" id="alamat" name="alamat" class="form-control"
                                value="{{ Route::is('hotel.edit') ? $hotel->alamat : '' }}" required>
                        </div>
                        <div class="d-flex mb-1">
                            <div class="flex-1" style="margin-right: 1%">
                                <label for="Distance Car" class="form-label">Distance car</label>
                                <input id="jarak_mobil" name="jarak_mobil" type="text"
                                    value="{{ Route::is('hotel.edit') ? $hotel->jarak_ke_yarsi_mobil : '0' }}"
                                    class="form-control number-format" required>
                                    <label >km/hour</label>
                            </div>

                            <div class="flex-1" style="margin-right: 1%">
                                <label for="Distance MotorCycle" class="form-label">Distance Motorcycle</label>
                                <input id="jarak_motor" name="jarak_motor" type="text"
                                    value="{{ Route::is('hotel.edit') ? $hotel->jarak_ke_yarsi_motor : '0' }}"
                                    class="form-control number-format" required>
                                    <label >km/hour</label>
                            </div>

                            <div class="flex-1" style="margin-right: 1%">
                                <label for="Distance Walk" class="form-label">Distance walk</label>
                                <input id="jarak_jk" name="jarak_jk" type="text"
                                    value="{{ Route::is('hotel.edit') ? $hotel->jarak_ke_yarsi_jk : '0' }}"
                                    class="form-control number-format" required>
                                    <label >km/hour</label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="kelebihan" class="control-label">Adventages</label>
                            <textarea style="resize: none;" class="form-control" id="kelebihan" name="kelebihan" rows="4">{{ Route::is('hotel.edit') ? $hotel->kelebihan : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="kekurangan" class="control-label">Disadvendtages</label>
                            <textarea style="resize: none;" class="form-control" id="kekurangan" name="kekurangan" rows="4">{{ Route::is('hotel.edit') ? $hotel->kekurangan : '' }}</textarea>
                        </div>
                        <div class="flex-1 mb-2">
                            <label for="harga" class="form-label">Price</label>
                            <input type="text" id="harga" name="harga"
                                class="form-control block w-full number-format"
                                value="{{ Route::is('hotel.edit') ? number_format($hotel->harga, 0, ',', '.') : '0' }}"
                                required>
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            @if (Route::is('hotel.edit'))
                                <button class="btn btn-primary block w-full">Update</button>
                            @else
                                <button class="btn btn-primary block w-full">Create</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="pt-8">
                        <div class="mr-md-4 pt-8">
                            <div class="relative bg-gray-100 p-6 rounded-md shadow-md mt-6">
                                <label for="photoInput" class="text-lg font-semibold mb-4 block">Upload
                                    Images</label>
                                <div id="fileUploadContainer"
                                    class="w-full h-32 border-dashed border-2 border-gray-300 rounded-md flex items-center justify-center">
                                    <form id="files">
                                        <span class="text-gray-500">+</span>
                                        <input type="file" id="photoInput" name="photoInput"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple>
                                    </form>
                                </div>
                                <label for="photoInput" class="text-lg font-semibold my-4 block">Preview</label>
                                <div class="d-flex justify-content-center w-100">
                                    <div id="preview-container"
                                        class="row row-cols-2 gap-2 align-items-center justify-content-center">
                                        @if (Route::is('hotel.edit'))
                                            @if (!$dataPhoto->isEmpty())
                                                @foreach ($dataPhoto as $photo)
                                                    <img class="object-cover max-h-24 max-w-30 w-100"
                                                        src="{{ asset('storage/uploads/images/' . $photo->file_name . '.' . $photo->file_type) }}"
                                                        alt="{{ $photo->file_name }}">
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
