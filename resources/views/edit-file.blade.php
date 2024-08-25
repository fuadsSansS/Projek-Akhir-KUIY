
@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('file.update', $zipFile->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="zip_file">Pilih File Zip Baru:</label>
                    <input type="file" name="zip_file" id="zip_file" accept=".zip">

                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
