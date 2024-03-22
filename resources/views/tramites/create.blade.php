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

        <form action="{{ route('tramites.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="titulo">Título del Trámite:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="area_id">Área Relacionada:</label>
                <select class="form-control" id="area_id" name="area_id" required>
                    <option value="">Selecciona un área</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="category_id">Categoría:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Selecciona una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Estado:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>


            <div class="form-group">
                <label for="slug">Slug:</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>

            <div class="form-group">
                <label for="summary">Resumen:</label>
                <textarea class="form-control" id="summary" name="summary" required></textarea>
            </div>

            <div class="form-group">
                <label for="procedure">Procedimiento:</label>
                <textarea class="form-control" id="procedure" name="procedure" required></textarea>
            </div>

            <div class="form-group">
                <label for="who">¿Quién puede realizarlo?:</label>
                <textarea class="form-control" id="who" name="who" required></textarea>
            </div>

            <div class="form-group">
                <label for="when">¿Cuándo se puede realizar?:</label>
                <textarea class="form-control" id="when" name="when" required></textarea>
            </div>

            <div class="form-group">
                <label for="cost">¿Tiene costo?:</label>
                <select class="form-control" id="cost" name="cost" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="online">¿Se puede realizar en línea?:</label>
                <select class="form-control" id="online" name="online" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="url">URL:</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>

            <div class="form-group">
                <label for="time">Tiempo estimado:</label>
                <input type="text" class="form-control" id="time" name="time" required>
            </div>

            <div class="form-group">
                <label for="more">Más información:</label>
                <textarea class="form-control" id="more" name="more" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Crear Trámite</button>
            <a href="{{ route('tramites.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
