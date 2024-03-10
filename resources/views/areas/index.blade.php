@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Listado de Áreas Municipales</h2>

    <!-- Botón para crear nueva área -->
    <a href="{{ route('areas.create') }}" class="btn btn-primary mb-3">Crear Nueva Área</a>
    
    <!-- Búsqueda de Áreas -->
    <form method="GET" action="{{ route('areas.index') }}">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Buscar área" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    @if($areas->isEmpty())
        <p>No se encontraron áreas.</p>
    @else
        @include('areas.partials.list', ['areas' => $areas])
    @endif

    <!-- Paginación -->
    <div class="mt-3">
        {{ $areas->links() }}
    </div>
</div>
@endsection

