
@extends('layouts.app')
@section('dashboard')

@if (Route::is('visa.edit') || Route::is('visa.create'))
    @include('Administrasi.visa-form')
@else
    @include('Administrasi.visa-table')
@endif

@endsection
