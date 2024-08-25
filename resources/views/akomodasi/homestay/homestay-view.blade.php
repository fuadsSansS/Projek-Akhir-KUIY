@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">
        <div class="container">
            <div class="card shadow mb-4">
                <div class="row" style="margin: 1%">
                    <div class="col-md-12">
                        <div class="bg-gray-100 p-6 rounded-md shadow-md">
                            <div class="d-flex justify-content-center">
                                <div class="row">
                                    @if (!$dataPhoto->isEmpty())
                                        @foreach ($dataPhoto as $photo)
                                            <div class="col-6 col-md-4">
                                                <img class="img-thumbnail img-fluid"
                                                    src="{{ asset('storage/uploads/images/' . $photo->file_name . '.' . $photo->file_type) }}"
                                                    alt="{{ $photo->file_name }}" >
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-2">
                            <div class="col-8 p-3 mb-1">
                                <p class="h2 font-weight-bold">{{ ucwords($homestay->nama_homestay) }}</p>
                                <p class="h5 text-gray-600 font-weight-bold mb-4">{{ ucwords($homestay->alamat) }}</p>
                            </div>
                        </div>

                        <div class="d-flex mb-1">
                            <div class="flex-1">
                                <label class="form-label" for="jarak" value="Jarak">Distance Car</label>
                                <input disabled class="form-control bg-white" id="jarak" name="jarak" type="text"
                                    value="{{ $homestay->jarak_ke_yarsi_mobil }} KM" required />
                            </div>

                            <div class="flex-1">
                                <label class="form-label" for="jarak" value="Jarak">Distace Motorcycle</label>
                                <input disabled class="form-control bg-white" id="jarak" name="jarak" type="text"
                                    value="{{ $homestay->jarak_ke_yarsi_motor }} KM" required />
                            </div>

                            <div class="flex-1">
                                <label class="form-label" for="jarak" value="Jarak">Distance Walk</label>
                                <input disabled class="form-control bg-white" id="jarak" name="jarak" type="text"
                                    value="{{ $homestay->jarak_ke_yarsi_jk }} KM" required />
                            </div>
                        </div>

                        <div class="d-flex mb-1 ">
                            <div class="flex-1">
                                <p class="text-l font-semibold" for="ipl" value="IPL">IPL</p>
                                <input disabled id="ipl" name="ipl" type="text"
                                    value="Rp. {{ number_format($homestay->ipl, 0, ',', '.') }}"
                                    class="form-control number-format" required />
                            </div>
                            <div class="flex-1">
                                <p class="text-l font-semibold" for="listrik" value="Listrik">Electricity</p>
                                <input disabled id="listrik" name="listrik" type="text"
                                    value="Rp. {{ number_format($homestay->listrik, 0, ',', '.') }}"
                                    class="form-control number-format" required />
                            </div>
                            <div class="flex-1">
                                <label for="wifi">Wifi</label>
                                <input disabled id="wifi" name="wifi" type="text"
                                    value="Rp. {{ number_format($homestay->wifi, 0, ',', '.') }}"
                                    class="form-control number-format" required />
                            </div>
                        </div>
                        <div>
                            <p class="h6 font-weight-bold" for="kelebihan" value="Kelebihan">Adventages</p>
                            <textarea style="resize: none;" class="form-control" disabled id="kelebihan" name="kelebihan" rows="4">{{ $homestay->kelebihan }}</textarea>
                        </div>
                        <div>
                            <p class="h6 font-weight-bold" for="kekurangan" value="Kekurangan">Disadventages</p>
                            <textarea style="resize: none;" class="form-control" disabled id="kekurangan" name="kekurangan" rows="4">{{ $homestay->kekurangan }}</textarea>
                        </div>
                        @if (Auth::user()->role === 'user' && $pilihHomestay)
                            <div class="d-flex justify-content-center mt-1">
                                <button type="button" class="btn btn-primary w-25 text-center pilih-homestay"
                                    style="cursor: pointer" value="{{ $homestay->id_homestay }}">Choose</button>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
