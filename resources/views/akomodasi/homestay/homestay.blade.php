@extends('layouts.app')
@section('dashboard')

@if (Route::is('homestay.edit') || Route::is('homestay.create'))
    @include('akomodasi.homestay.homestay-form')
@elseif (Route::is('homestay.view'))
    @include('akomodasi.homestay.homestay-view')
@else
    @include('akomodasi.homestay.homestay-table')
@endif

@endsection
