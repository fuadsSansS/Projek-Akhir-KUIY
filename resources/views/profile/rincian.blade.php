@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Detail User Chooise</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    @if (Auth::user()->role === 'admin')
                        <h1 class="text-2xl font-weight mb-4">{{ $rincian->user->name }}</h1>
                        <button class="btn btn-primary hide-print" style="cursor: pointer" id="print-rincian">Print</button>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Total</th>
                                @if (Auth::user()->role === 'user')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (!is_null($rincian->keimigrasian))
                                <tr>
                                    <td>{{ strtoupper($rincian->keimigrasian->item) }}</td>
                                    <td>Rp. {{ number_format($rincian->keimigrasian->total_biaya, 0, ',', '.') }}</td>
                                    @if (Auth::user()->role === 'user')
                                        <td><button class="btn btn-danger hide-print" id="delete-rincian-keimigrasian"
                                                value="{{ $rincian->keimigrasian->id_keimigrasian }}"
                                                href="#">Delete</button></td>
                                    @endif
                                </tr>
                            @endif
                            @if (!is_null($rincian->homestay))
                                <tr>
                                    <td> {{ strtoupper($rincian->homestay->nama_homestay) }}</td>
                                    <td> Rp. {{ number_format($rincian->homestay->harga, 0, ',', '.') }}</td>
                                    @if (Auth::user()->role === 'user')
                                        <td><button class="btn btn-danger hide-print" id="delete-rincian-homestay"
                                                value="{{ $rincian->homestay->id_homestay }}" href="#">Delete</button>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if (!is_null($rincian->dormitory))
                                <tr>
                                    <td> {{ strtoupper($rincian->dormitory->nama_dormitory) }}</td>
                                    <td> Rp. {{ number_format($rincian->dormitory->harga, 0, ',', '.') }}</td>
                                    @if (Auth::user()->role === 'user')
                                        <td><button class="btn btn-danger hide-print" id="delete-rincian-dormitory"
                                                value="{{ $rincian->dormitory->id_dormitory }}" href="#">Delete</button>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                            @if (!is_null($rincian->hotel))
                                <tr>
                                    <td> {{ strtoupper($rincian->hotel->nama_hotel) }}</td>
                                    <td> Rp. {{ number_format($rincian->hotel->harga, 0, ',', '.') }}</td>
                                    @if (Auth::user()->role === 'user')
                                        <td><button class="btn btn-danger hide-print" id="delete-rincian-hotel"
                                                value="{{ $rincian->hotel->id_hotel }}" href="#">Delete</button></td>
                                    @endif
                                </tr>
                            @endif
                            @if (!is_null($rincian->asuransi))
                                <tr>
                                    <td>{{ strtoupper($rincian->asuransi->nama_asuransi) }}</td>
                                    <td>Rp. {{ number_format($rincian->asuransi->harga, 0, ',', '.') }}</td>
                                    @if (Auth::user()->role === 'user')
                                        <td>
                                            <button class="btn btn-danger hide-print" id="delete-rincian-asuransi"
                                                value="{{ $rincian->asuransi->id_asuransi }}"
                                                href="#">Delete</button>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
