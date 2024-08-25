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
                                <p class="h2 font-weight-bold">{{ ucwords($hotel->nama_hotel) }}</p>
                                <p class="h5 text-gray-600 font-weight-bold mb-4">{{ ucwords($hotel->alamat) }}</p>
                            </div>
                        </div>

                        <div class="d-flex mb-1">
                            <div class="flex-1 me-2">
                                <label class="form-label" for="jarak" value="Jarak">Distance Car</label>
                                <input disabled class="form-control bg-white " id="jarak" name="jarak" type="text"
                                    value="{{ $hotel->jarak_ke_yarsi_mobil }} Km/Hours" required />
                            </div>

                            <div class="flex-1 me-2">
                                <label class="form-label" for="jarak" value="Jarak">Distance Motorcycle</label>
                                <input disabled class="form-control bg-white " id="jarak" name="jarak" type="text"
                                    value="{{ $hotel->jarak_ke_yarsi_motor }} KM/Hours" required />
                            </div>

                            <div class="flex-1">
                                <label class="form-label" for="jarak" value="Jarak">Distance Walk</label>
                                <input disabled class="form-control bg-white" id="jarak" name="jarak" type="text"
                                    value="{{ $hotel->jarak_ke_yarsi_jk }} KM/Hours" required />
                            </div>
                        </div>
                        <div>
                            <p class="h6 font-weight-bold" for="kelebihan" value="Kelebihan">Adventages</p>
                            <textarea style="resize: none;" class="form-control" disabled id="kelebihan" name="kelebihan" rows="4">{{ $hotel->kelebihan }}</textarea>
                        </div>
                        <div>
                            <p class="h6 font-weight-bold" for="kekurangan" value="Kekurangan">Disadventages</p>
                            <textarea style="resize: none;" class="form-control" disabled id="kekurangan" name="kekurangan" rows="4">{{ $hotel->kekurangan }}</textarea>
                        </div>
                        @if (Auth::user()->role === 'user' && $pilihHotel)
                            <div class="d-flex justify-content-center mt-1">
                                <button type="button" class="btn btn-primary w-25 text-center pilih-hotel"
                                    style="cursor: pointer" value="{{ $hotel->id_hotel}}">Choose</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
