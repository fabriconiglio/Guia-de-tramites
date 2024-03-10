@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($area) ? 'Editar Área' : 'Crear Nueva Área' }}</h1>
    <form action="{{ isset($area) ? route('areas.update', $area) : route('areas.store') }}" method="POST">
        @csrf
        @if(isset($area))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="area_id" class="form-label">Área Padre</label>
            <select class="form-control" id="area_id" name="area_id">
                <option value="">Ninguna</option>
                @foreach($areas as $areaPadre)
                    <option value="{{ $areaPadre->id }}" @if(isset($area) && $area->area_id === $areaPadre->id) selected @endif>
                        {{ $areaPadre->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $area->nombre ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $area->direccion ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $area->telefono ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $area->email ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="lat" class="form-label">Latitud</label>
            <input type="text" class="form-control" id="lat" name="lat" value="{{ $area->lat ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="lng" class="form-label">Longitud</label>
            <input type="text" class="form-control" id="lng" name="lng" value="{{ $area->lng ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <input type="text" class="form-control" id="horario" name="horario" value="{{ $area->horario ?? '' }}">
        </div>


        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancelar</button>
        <button type="submit" class="btn btn-primary">{{ isset($area) ? 'Actualizar' : 'Crear' }}</button>
    </form>
</div>
@endsection