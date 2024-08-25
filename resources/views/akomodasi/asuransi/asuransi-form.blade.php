@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if (Route::is('asuransi.edit'))
                    <h6 class="m-0 font-weight-bold text-primary">Edit Insurance</h6>
                    <form id="update-asuransi" class="mt-6 space-y-6">
                        @method('PATCH')
                        <input type="hidden" name="id_asuransi" id="id_asuransi" value="{{ $asuransi->id_asuransi }}">
                @else
                    <h6 class="m-0 font-weight-bold text-primary">Create Insurance</h6>
                        <form id="create-asuransi" role="form">
                @endif
                @csrf
            </div>

            <div class="card-body">
                <div class="col-lg-9">

                        <div class="form-group">
                            <label>Name Insurance</label>
                            <input id="nama_asuransi" name="nama_asuransi" type="text"  class="form-control" type="text" placeholder="Default input"
                                aria-label="default input example" value="{{ Route::is('asuransi.edit') ? $asuransi->nama_asuransi : '' }}" {{ Route::is('asuransi.create') ? 'autofocus' : '' }}>
                        </div>

                        <div class="form-group">
                            <label>Price Insurance</label>
                            <input id="harga" name="harga" type="text" class="form-control number-format" type="text" placeholder="Default input"
                                aria-label="default input example" value="{{ Route::is('asuransi.edit') ? number_format($asuransi->harga, 0, ',', '.') : '' }}">
                        </div>

                        @if (Route::is('asuransi.edit'))
                            <button type="update" class="btn btn-dark">Update</button>
                        @else
                            <button class="btn btn-primary">Create</button>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
