@extends('layouts.app')
@section('dashboard')
    @if (Route::is('keimigrasian.edit') || Route::is('keimigrasian.create'))
        @include('akomodasi.keimigrasian.keimigrasian-form')
    @elseif (Route::is('keimigrasian.view'))
        @include('akomodasi.keimigrasian.keimigrasian-view')
    @else
        @include('akomodasi.keimigrasian.keimigrasian-table')
    @endif
@endsection
