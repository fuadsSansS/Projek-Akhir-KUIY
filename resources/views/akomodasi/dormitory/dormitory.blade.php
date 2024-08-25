@extends('layouts.app')
@section('dashboard')

@if (Route::is('dormitory.edit') || Route::is('dormitory.create'))
    @include('akomodasi.dormitory.dormitory-form')
@elseif (Route::is('dormitory.view'))
    @include('akomodasi.dormitory.dormitory-view')
@else
    @include('akomodasi.dormitory.dormitory-table')
@endif

@endsection
