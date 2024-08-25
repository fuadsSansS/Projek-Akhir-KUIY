{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">

        {{-- <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="mb-3 col-9">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="formFile">
                </div>

                <div class="mb-3 col-9">
                    <button type="button" class="btn btn-primary">Primary</button>
                </div>

            </div>
        </div> --}}


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables User Uploader</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (Auth::user()->role === 'user')
                        <a href="dashboard/create" class="btn btn-primary btn-icon-split mb-2">
                            <span class="text">Add Data</span>
                        </a>
                    @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>File </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($zipFiles as $file)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $file->nama_file }}</td>
                                    <td>
                                        @if (Auth::user()->role === 'admin')
                                            <a href="{{ route('file.download', $file->id) }}"
                                                class="btn btn-primary btn-icon-split mb-2">
                                                <span class="text">Download</span>
                                            </a>
                                        @else
                                        <div class="ml-4 d-flex justify-content-start">
                                            <a href="{{ route('file.edit', $file->id) }}" class="btn btn-primary my-2 align-self-end mr-2">
                                                <span class="text">Edit</span>
                                            </a>
                                            <form action="{{ route('file.delete', $file->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger my-2 align-self-end">Hapus</button>
                                            </form>
                                        </div>

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
