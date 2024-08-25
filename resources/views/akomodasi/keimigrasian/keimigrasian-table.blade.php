@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Immigration</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    @if (Auth::user()->role === 'admin')
                        <a href="keimigrasian/create" class="btn btn-primary btn-icon-split mb-2">
                            <span class="text">Add Data</span>
                        </a>
                    @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        @if ($pilihKeimigrasian || Auth::user()->role === 'admin')
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        @endif
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($dataKeimigrasian as $keimigrasian)
                                <tr>
                                    <td>
                                        {{ $no++ }}
                                    </td>
                                    <td value="{{$keimigrasian->id_keimigrasian}}" class="keimigrasian">
                                        {{ strtoupper($keimigrasian->item) }}
                                    </td>
                                    @if (Auth::user()->role === 'admin')
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 text-center">
                                            <a class="btn btn-secondary"
                                                href="keimigrasian/edit/{{ $keimigrasian->id_keimigrasian }}">Edit</a>
                                            <a class="btn btn-danger" id="delete-keimigrasian"
                                                value="{{ $keimigrasian->id_keimigrasian }}" href="#">Delete</a>
                                        </td>
                                    @elseif ($pilihKeimigrasian)
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-center">
                                            <button class="btn btn-primary pilih-keimigrasian" style="cursor: pointer" value="{{$keimigrasian->id_keimigrasian}}">Pilih</button>
                                        </td>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
