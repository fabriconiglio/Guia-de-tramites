@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Trámite</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tramites.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title">Título del Trámite:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="area_id">Área Relacionada:</label>
                <select class="form-control" id="area_id" name="area_id" required>
                    <option value="">Selecciona un área</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="category_id">Categoría:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Selecciona una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="status">Estado:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>


            <div class="form-group mb-3">
                <label for="slug">Slug:</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="summary">Resumen:</label>
                <textarea class="form-control" id="summary" name="summary" required>{{ old('summary') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="procedure">Procedimiento:</label>
                <textarea class="form-control" id="procedure" name="procedure">{{ old('procedure') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="who">¿Quién puede realizarlo?:</label>
                <textarea class="form-control" id="who" name="who">{{ old('who') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="when">¿Cuándo se puede realizar?:</label>
                <textarea class="form-control" id="when" name="when">{{ old('when') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="cost">¿Tiene costo?:</label>
                <select class="form-control" id="cost" name="cost" required>
                    <option value="1" {{ old('cost') == 1 ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ old('cost') == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="online">¿Se puede realizar en línea?:</label>
                <select class="form-control" id="online" name="online" required>
                    <option value="1" {{ old('online') == 1 ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ old('online') == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="url">URL:</label>
                <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}">
            </div>

            <div class="form-group mb-3">
                <label for="time">Tiempo estimado:</label>
                <input type="text" class="form-control" id="time" name="time" value="{{ old('time') }}">
            </div>

            <div class="form-group mb-3">
                <label for="more">Más información:</label>
                <textarea class="form-control" id="more" name="more">{{ old('more') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="documentos">Subir Nuevos Documentos:</label>
                <input type="file" class="form-control" id="documentos" name="documentos[]" multiple>
                <small class="form-text text-muted">Tipos de archivo permitidos: PDF, JPG, PNG. Máximo 2MB por archivo.</small>
            </div>

            <button type="submit" class="btn btn-success">Crear Trámite</button>
            <a href="{{ route('tramites.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('title').addEventListener('input', function() {
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
