
@extends('layouts.app')
@section('dashboard')

@if (Route::is('asuransi.edit') || Route::is('asuransi.create'))
    @include('akomodasi.asuransi.asuransi-form')
@else
    @include('akomodasi.asuransi.asuransi-table')
@endif

@endsection
