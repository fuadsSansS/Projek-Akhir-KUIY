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
                            <a class="btn btn-primary" href="homestay/create">Create</a>
                        @endif
                    </div>
                    <div class="container pt-2">
                        @foreach ($dataHomestay as $homestay)
                        <div class="container mb-3">
                            <div class="card p-4 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="row g-0">
                                        <div class="col-6 col-md-4">
                                            <div href="#" style="cursor: pointer" value="{{ $homestay->id_homestay }}"
                                                class="homestay flex flex-col items-center">
                                                <img class="img-fluid"
                                                            src="{{ asset('storage/uploads/images/' . $homestay->cover) }}"
                                                            alt="{{ $homestay->cover }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-8">
                                            <div href="#" value="{{ $homestay->id_homestay }}"
                                                class="homestay ml-4 flex flex-col col-span-5">
                                                <h1 class="text-left text-2xl font-bold">
                                                    {{ ucwords($homestay->nama_homestay) }}</h1>
                                                <p class="text-left text-md">{{ ucwords($homestay->alamat) }}
                                                </p>
                                                <p class="text-left text-xl font-semibold text-primary mb-2">Rp.
                                                    {{ number_format($homestay->harga, 0, ',', '.') }}</p>
                                            </div>
                                            @if (Auth::user()->role === 'admin')
                                            <div class="ml-4 d-flex justify-content-start">
                                                <div class="d-inline-block mr-2">
                                                    <a href="homestay/edit/{{ $homestay->id_homestay }}"
                                                        class="btn btn-secondary my-2 align-self-end">Edit</a>
                                                </div>
                                                <div class="d-inline-block mr-2">
                                                    <a href="#" id="delete-homestay" value="{{ $homestay->id_homestay }}"
                                                        class="btn btn-danger my-2 align-self-end">Delete</a>
                                                </div>
                                            </div>
                                            @elseif ($pilihHomestay)
                                            <div
                                                class="d-flex flex-column align-items-center col-span-2 justify-content-center">
                                                <button class="btn btn-primary pilih-homestay" style="cursor: pointer"
                                                    value="{{ $homestay->id_homestay }}">Pilih</button>
                                            </div>
                                            @else
                                            <div href="#" style="cursor: pointer" value="{{ $homestay->id_homestay }}"
                                                class="homestay d-flex flex-column align-items-center col-span-1">
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
