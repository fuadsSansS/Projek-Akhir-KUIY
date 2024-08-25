@extends('layouts.app')
@section('dashboard')
    <div class="container-fulid">

        <div class="container pt-4">
            <div class="card shadow-sm rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-white border border-gray-200">
                    <div class="d-flex justify-content-between">
                        @if (Auth::user()->role === 'admin')
                            <a href="visa/create" class="btn btn-primary btn-icon-split mb-2">
                                <span class="text">Add Data</span>
                            </a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <!-- Content goes here -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 5%" class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">No.</span>
                                    </th>
                                    <th style="width: 50%" class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Nama
                                            Formulir</span>
                                    </th>
                                    <th style="width: 20%" class="px-6 py-3 bg-gray-50 text-center">
                                        <span
                                            class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $no = 1; ?>
                                <?php foreach ($dataVisa as $visa): ?>
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                        <?php echo $no++; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                        <?php echo strtoupper($visa->nama_formulir); ?>
                                    </td>
                                    @if (Auth::user()->role === 'admin')
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 text-center">
                                            <a class="btn btn-secondary" href="visa/edit/{{ $visa->id_visa }}">Edit</a>
                                            <a class="btn btn-danger" id="delete-visa" value="{{ $visa->id_visa }}"
                                                href="#">Delete</a>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 text-center">
                                            <a href="{{ route('download', ['fileName' => $visa->file]) }}" download>
                                                <button class="btn btn-primary">Download</button>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
