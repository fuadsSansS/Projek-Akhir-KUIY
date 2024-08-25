@extends('layouts.app')
@section('dashboard')

@if (Route::is('hotel.edit') || Route::is('hotel.create'))
    @include('akomodasi.hotel.hotel-form')
@elseif (Route::is('hotel.view'))
    @include('akomodasi.hotel.hotel-view')
@else
    @include('akomodasi.hotel.hotel-table')
@endif

@endsection
