@extends('layouts.app')
@section('dashboard')

    <div class="container-fluid">
        <div class="d-flex">
            <main class="flex-grow-1 p-4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="h2 font-weight-bold mb-6">Rincian</p>
                    <div class="bg-white shadow-md rounded-lg">
                        <div class="overflow-hidden overflow-auto p-6 bg-white border border-gray-200">
                            <div class="w-100 align-middle">
                                <table class="w-100 table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%" class="px-6 py-3 bg-gray-50 text-left">
                                                <span
                                                    class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">No.</span>
                                            </th>
                                            <th style="width: 85%" class="px-6 py-3 bg-gray-50 text-left">
                                                <span
                                                    class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Nama</span>
                                            </th>
                                            <th style="width: 10%" class="px-6 py-3 bg-gray-50 text-center">
                                                <span
                                                    class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php $no = 1 @endphp
                                        @foreach ($dataRincian as $rincian)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                                <?php echo $no++; ?></td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900">
                                                <?php echo strtoupper($rincian->user->name); ?></td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 text-center">
                                                <a href="rincian/view/<?php echo $rincian->user->id; ?>"
                                                    class="btn btn-secondary">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
