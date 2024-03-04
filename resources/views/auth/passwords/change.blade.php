@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cambiar Contraseña</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Contraseña Actual -->
                        <div class="form-group">
                            <label for="current_password">Contraseña Actual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>

                        <!-- Nueva Contraseña -->
                        <div class="form-group">
                            <label for="new_password">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>

                        <!-- Confirmar Nueva Contraseña -->
                        <div class="form-group">
                            <label for="new_confirm_password">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_confirm_password" name="new_confirm_password" required>
                        </div>

                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">
                            Cambiar Contraseña
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
