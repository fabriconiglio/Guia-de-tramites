@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle de Usuario</h2>

    <!-- Aquí pondrías tu formulario para actualizar usuarios -->
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ID y Email no son editables, así que los puedes mostrar como texto -->
        <div class="mb-3">
            <label class="form-label">Id de Usuario</label>
            <input type="text" class="form-control" value="{{ $user->id }}" readonly>
        </div>

        <!-- Email (solo lectura) -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
        </div>

        <!-- Nombre de usuario -->
        <div class="mb-3">
            <label class="form-label">Nombre de usuario</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <!-- Estado de la cuenta -->
        <div class="mb-3">
            <label class="form-label">Estado:</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ $user->is_active ? 'selected' : '' }}>Habilitado</option>
                <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Deshabilitado</option>
            </select>
        </div>

        <!-- Rol de usuario -->
        <div class="mb-3">
            <label class="form-label">Rol de Usuario</label>
            <select name="role" class="form-control">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botones -->
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver al listado</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection

