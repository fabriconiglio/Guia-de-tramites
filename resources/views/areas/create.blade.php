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
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $area->nombre) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Estado:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="1" {{ old('status', $area->status) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('status', $area->status) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>


        <div class="form-group mb-3">
            <label for="slug">Slug:</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $area->slug) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $area->direccion) }}">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $area->telefono) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $area->email) }}">
        </div>

        <div class="mb-3">
            <label for="lat" class="form-label">Latitud</label>
            <input type="text" class="form-control" id="lat" name="lat" value="{{ old('lat', $area->lat) }}">
        </div>

        <div class="mb-3">
            <label for="lng" class="form-label">Longitud</label>
            <input type="text" class="form-control" id="lng" name="lng" value="{{ old('lng', $area->lng) }}">
        </div>

        <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <input type="text" class="form-control" id="horario" name="horario" value="{{ old('horario', $area->horario) }}">
        </div>


        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancelar</button>
        <button type="submit" class="btn btn-primary">{{ isset($area) ? 'Actualizar' : 'Crear' }}</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
function initAutocomplete() {
    // Obtener el elemento input para la dirección
    const input = document.getElementById('direccion');
    const options = {
        fields: ["address_components", "geometry"],
        types: ["address"],
    };

    // Crear el objeto autocomplete
    const autocomplete = new google.maps.places.Autocomplete(input, options);

    // Listener para manejar el evento de selección de dirección
    autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        if (!place.geometry) {
            // El usuario seleccionó la opción "Enter address", que no es una predicción proporcionada por el autocompletado
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        // Actualizar los campos de latitud y longitud
        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();
    });
}

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('nombre').addEventListener('input', function() {
        const title = this.value;
        const slugField = document.getElementById('slug');
        slugField.value = title
            .toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    });
});
</script>
@endsection
