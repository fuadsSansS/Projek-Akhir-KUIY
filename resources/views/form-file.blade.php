
@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="zip_file" accept=".zip" id="formFile">

                    <div class="mb-3 col-9">
                        <button type="submit" class="btn btn-primary">Primary</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
