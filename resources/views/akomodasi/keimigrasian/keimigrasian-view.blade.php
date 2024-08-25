@extends('layouts.app')
@section('dashboard')


<div class="container-fluid">
    <div class="container">
        <div class="card shadow mb-4">
            <section>
                <div class="container">
                    <div class="row justify-content-between">
                        <h1 class="text-2xl font-bold mb-1 mt-2">Immigration</h1>
                    </div>
                    <div class="mt-2">
                        <label for="item" class="form-label">Item</label>
                        <input type="text" id="item" name="item" class="form-control" value="{{$keimigrasian->item}}" disabled />
                    </div>
                    <div class="mt-6">
                        <label for="keimigrasian" class="form-label">Details Immigration</label>
                        <textarea id="keimigrasian" name="keimigrasian" class="form-control" rows="4" style="resize: none;" disabled>{{$keimigrasian->keimigrasian}}</textarea>
                    </div>

                    <div class="mt-6">
                        <label for="kemenaker" class="form-label">Details Ministry Of Manpower</label>
                        <textarea id="kemenaker" name="kemenaker" class="form-control" rows="4" style="resize: none;" disabled>{{$keimigrasian->kemenaker}}</textarea>
                    </div>

                    <div class="row mt-6">
                        <div class="col-md-4">
                            <label for="biaya_keimigrasian" class="form-label">Cost Immigration</label>
                            <input type="text" id="biaya_keimigrasian" name="biaya_keimigrasian" class="form-control number-format" value="Rp. {{number_format($keimigrasian->biaya_keimigrasian, 0, ',', '.')}}" disabled />
                        </div>
                        <div class="col-md-4">
                            <label for="biaya_kemenaker" class="form-label">Cost Ministry Of Manpower </label>
                            <input type="text" id="biaya_kemenaker" name="biaya_kemenaker" class="form-control number-format" value="Rp. {{number_format($keimigrasian->biaya_kemenaker, 0, ',', '.')}}" disabled />
                        </div>
                        <div class="col-md-4">
                            <label for="total_biaya" class="form-label">Total Biaya</label>
                            <input type="text" id="total_biaya" name="total_biaya" class="form-control number-format" value="Rp. {{number_format($keimigrasian->total_biaya, 0, ',', '.')}}" disabled />
                        </div>
                    </div>
                    @if (Auth::user()->role === 'user' && $pilihKeimigrasian)
                        {{-- <div class="row mt-5">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-primary pilih-keimigrasian" value="{{$keimigrasian->id_keimigrasian}}" disabled>Pilih</button>
                            </div>
                        </div> --}}
                        <div class="d-flex justify-content-center mt-2 mb-2">
                            <button type="button" class="btn btn-primary w-25 text-center pilih-hotel"
                                style="cursor: pointer" value="{{ $keimigrasian->id_keimigrasian}}">Choose</button>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>






  @endsection
