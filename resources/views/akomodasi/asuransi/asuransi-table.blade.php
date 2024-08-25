@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Insurance</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    @if (Auth::user()->role === 'admin')
                        <a href="asuransi/create" class="btn btn-primary btn-icon-split mb-2">
                            <span class="text">Add Data</span>
                        </a>
                    @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Insurance</th>
                                    <th>Price</th>
                                    @if ($pilihAsuransi || Auth::user()->role === 'admin')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($dataAsuransi as $asuransi)
                            <tbody>
                                <tr>
                                    <td>
                                        {{ $no++ }}
                                    </td>
                                    <td>
                                        {{ strtoupper($asuransi->nama_asuransi) }}
                                    </td>
                                    <td>
                                        Rp. {{ number_format($asuransi->harga, 0, ',', '.') }}
                                    </td>
                                        @if (Auth::user()->role === 'admin')
                                        <td>
                                            <a class="btn btn-secondary"
                                                href="asuransi/edit/{{ $asuransi->id_asuransi }}">Edit</a>
                                            <a class="btn btn-danger" id="delete-asuransi"
                                                value="{{ $asuransi->id_asuransi }}" href="#">Delete</a>
                                        </td>
                                        @elseif ($pilihAsuransi)

                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-center">
                                            <button class="btn btn-primary pilih-asuransi" value="{{$asuransi->id_asuransi}}" style="cursor: pointer">Pilih</button>
                                        </td>
                                        @endif
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
