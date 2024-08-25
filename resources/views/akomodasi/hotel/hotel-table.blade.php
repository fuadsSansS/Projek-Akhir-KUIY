<!-- DataTales Example -->
@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">
        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between">
                        @if (Auth::user()->role === 'admin')
                            <a class="btn btn-primary" href="hotel/create">Create</a>
                        @endif
                    </div>
                    <div class="container pt-2">
                        @foreach ($dataHotel as $hotel)
                            <div class="container mb-3">
                                <div class="card p-4 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="row g-0">
                                            <div class="col-6 col-md-4">
                                                <div href="#" style="cursor: pointer" value="{{ $hotel->id_hotel }}"
                                                    class="hotel flex flex-col items-center">
                                                    <img class="img-fluid"
                                                        src="{{ asset('storage/uploads/images/' . $hotel->cover) }}"
                                                        alt="{{ $hotel->cover }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-8">
                                                <div href="#" value="{{ $hotel->id_hotel }}"
                                                    class="hotel ml-4 flex flex-col col-span-5">
                                                    <h1 class="text-left text-2xl font-bold">
                                                        {{ ucwords($hotel->nama_hotel) }}</h1>
                                                    <p class="text-left text-md">{{ ucwords($hotel->alamat) }}
                                                    </p>
                                                    <p class="text-left text-xl font-semibold text-primary mb-2">Rp.
                                                        {{ number_format($hotel->harga, 0, ',', '.') }}</p>
                                                </div>
                                                @if (Auth::user()->role === 'admin')
                                                    <div class="ml-4 d-flex justify-content-start">
                                                        <div class="d-inline-block mr-2">
                                                            <a href="hotel/edit/{{ $hotel->id_hotel }}"
                                                                class="btn btn-secondary my-2 align-self-end">Edit</a>
                                                        </div>
                                                        <div class="d-inline-block mr-2">
                                                            <a href="#" id="delete-hotel"
                                                                value="{{ $hotel->id_hotel }}"
                                                                class="btn btn-danger my-2 align-self-end">Delete</a>
                                                        </div>
                                                    </div>
                                                @elseif ($pilihHotel)
                                                    <div
                                                        class="d-flex flex-column align-items-center col-span-2 justify-content-center">
                                                        <button class="btn btn-primary pilih-hotel"
                                                            style="cursor: pointer"
                                                            value="{{ $hotel->id_hotel }}">Pilih</button>
                                                    </div>
                                                @else
                                                    <div href="#" style="cursor: pointer" value="{{ $hotel->id_hotel}}"
                                                        class="hotel d-flex flex-column align-items-center col-span-1">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection
