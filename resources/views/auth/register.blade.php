@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Registro de Estudiante</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre_completo" class="form-label">Nombre completo</label>
                <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="identificacion" class="form-label">Número de identificación</label>
                <input type="text" name="identificacion" id="identificacion" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico institucional</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@institucion.edu" required>
            </div>
            <div class="mb-3">
                <label for="carrera" class="form-label">Carrera o programa académico</label>
                <input type="text" name="carrera" id="carrera" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
    </div>
</div>
@endsection
