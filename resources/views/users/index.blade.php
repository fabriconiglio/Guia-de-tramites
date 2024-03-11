@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestión de Usuarios</h2>
    <div>
        <!-- Búsqueda -->
        <form method="GET" action="{{ route('users.index') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Buscar" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabla de Usuarios -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role) <!-- Muestra todos los roles del usuario -->
                        <span>{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este usuario?');">
                        Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    {{ $users->links() }}
</div>
@endsection
