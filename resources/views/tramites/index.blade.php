@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Trámites Disponibles</h1>
        <a href="{{ route('tramites.create') }}" class="btn btn-primary mb-3">Nuevo Trámite</a>
        <div>
            <form method="GET" action="{{ route('tramites.index') }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Buscar trámites" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Título</th>
                <th>Área</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Última Actualización</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tramites as $tramite)
                <tr>
                    <td>{{ $tramite->title }}</td>
                    <td>{{ $tramite->area->nombre }}</td>
                    <td>{{ $tramite->category->name}}</td>
                    <td>{{ $tramite->status ? 'Activo' : 'Inactivo' }}</td>
                    <td>{{ $tramite->updated_at->toFormattedDateString() }}</td>
                    <td>
                        <a href="{{ route('tramites.edit', $tramite->id) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('tramites.destroy', $tramite->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este trámite?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $tramites->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
