@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if (Route::is('Keimigrasian.edit'))
                    <h6 class="m-0 font-weight-bold text-primary">Edit Immigration</h6>
                    <form id="update-keimigrasian" class="mt-6 space-y-6">
                        @method('PATCH')
                        <input type="hidden" name="id_keimigrasian" id="id_keimigrasian"
                            value="{{ $keimigrasian->id_keimigrasian }}">
                    @else
                        <h6 class="m-0 font-weight-bold text-primary">Create Immigration</h6>
                        <form id="create-keimigrasian" role="form">
                @endif
                @csrf
            </div>
            <div class="card-body">

                <div class="col-lg-12">

                    <div class="form-group">
                        <label for="item">Item</label>
                        <input id="item" name="item" type="text" class="form-control"
                            value="{{ Route::is('keimigrasian.edit') ? $keimigrasian->item : '' }}"
                            {{ Route::is('keimigrasian.create') ? 'autofocus' : '' }} required>
                    </div>


                    <div class="form-group">
                        <label for="keiigrasian" class="form-label">Details Immigration</label>
                        <textarea style="resize: none;" class="form-control" required id="keimigrasian" name="keimigrasian">
                                {{ Route::is('keimigrasian.edit') ? $keimigrasian->keimigrasian : '' }}
                        </textarea>
                    </div>
                    <div>
                        <label for="kemenaker" class="form-label">Details Ministry Of Manpower</label>
                        <textarea style="resize: none;" class="form-control" required id="kemenaker" name="kemenaker">
                            {{ Route::is('keimigrasian.edit') ? $keimigrasian->kemenaker : '' }}
                        </textarea>
                    </div>
                    <div class="d-flex">
                        <div class="flex-grow-2" style="margin-right: 10%">
                            <label for="biayaKeimigrasian" class="form-label">Price Immigration</label>
                            <input id="biayaKeimigrasian" name="biaya_keimigrasian" type="text" class="form-control"
                                value="{{ Route::is('keimigrasian.edit') ? $keimigrasian->biaya_keimigrasian : '0' }}"
                                required>
                        </div>

                        <div class="flex-grow-2" style="margin-right: 10%">
                            <label for="biayaKemenaker" class="form-label">Price Ministry Of Manpower</label>
                            <input id="biayaKemenaker" name="biaya_kemenaker" type="text"
                                class="form-control block w-full number-format"
                                value="{{ Route::is('keimigrasian.edit') ? $keimigrasian->biaya_kemenaker : '0' }}"
                                required />
                        </div>

                        <div class="flex-grow-2">
                            <label for="totalBiaya" class="form-label">Total Price</label>
                            <input id="totalBiaya" name="total_biaya" type="text"
                                class="form-control block w-full number-format"
                                value="{{ Route::is('keimigrasian.edit') ? $keimigrasian->total_biaya : '' }}" required
                                disabled />
                        </div>
                    </div>


                    @if (Route::is('keimigrasian.edit'))
                        <button type="update" class="btn btn-dark mt-2">Update</button>
                    @else
                        <button class="btn btn-primary mt-2">Create</button>
                        {{-- <a class="btn btn-primary create-asuransi">Create</a> --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
