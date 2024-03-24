@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Trámite Editado</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('tramites.index') }}" class="btn btn-secondary">Volver al Listado</a>
    </div>
@endsection
