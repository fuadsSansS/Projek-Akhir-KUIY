@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if (Route::is('visa.edit'))
                    <h6 class="m-0 font-weight-bold text-primary">Edit Visa</h6>
                    <form id="update-visa" class="mt-6 space-y-6">
                        @method('PATCH')
                        <input type="hidden" name="id_visa" id="id_visa" value="{{ $visa->id_visa }}">
                    @else
                        <h6 class="m-0 font-weight-bold text-primary">Create visa</h6>
                        <form id="create-visa" role="form">
                @endif
                @csrf
            </div>
            <div class="card-body">
                <div class="col-lg-9">
                    <div>
                        <label for="nama_formulir" class="form-label">Nama Formulir</label>
                        <input id="nama_formulir" name="nama_formulir" type="text" class="form-control"
                            value="{{ Route::is('visa.edit') ? $visa->nama_formulir : '' }}"
                            {{ Route::is('visa.create') ? 'autofocus' : '' }} required />
                    </div>
                    <div id="fileUploadContainer" style="cursor: pointer"
                        class="grid grid-cols-1 w-full h-32 border border-primary rounded-md d-flex align-items-center justify-content-center">
                        <span id="fileName"
                            class="text-primary text-center">{{ Route::is('visa.edit') ? $visa->nama_formulir : '+' }}</span>
                    </div>
                    <input hidden type="file" id="fileInput" name="fileInput" class="d-none">

                    <div class="d-flex gap-4 align-items-center">
                        @if (Route::is('visa.edit'))
                            <button class="btn btn-primary">Update</button>
                        @else
                            <button class="btn btn-primary">Create</button>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
