@extends('layouts.app')

@section('content')
<h2>Editar Usuario</h2>
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nombre_completo" class="form-label">Nombre completo</label>
        <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" value="{{ $user->nombre_completo }}" required>
    </div>
    <div class="mb-3">
        <label for="identificacion" class="form-label">Número de identificación</label>
        <input type="text" name="identificacion" id="identificacion" class="form-control" value="{{ $user->identificacion }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select name="rol" id="rol" class="form-control" required>
            <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="docente" {{ $user->rol == 'docente' ? 'selected' : '' }}>Docente</option>
            <option value="estudiante" {{ $user->rol == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="programa_academico" class="form-label">Programa Académico</label>
        <select name="programa_academico" id="programa_academico" class="form-control">
            <option value="">Seleccione un programa</option>
            @foreach($programas as $programa)
                <option value="{{ $programa }}" {{ $user->programa_academico == $programa ? 'selected' : '' }}>{{ $programa }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="departamento_academico" class="form-label">Departamento</label>
        <input type="text" name="departamento_academico" id="departamento_academico" class="form-control" value="{{ $user->departamento_academico }}">
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
</form>
@endsection

@section('scripts')
<!-- Incluye jQuery y Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#programa_academico').select2({
            placeholder: 'Seleccione un programa',
            allowClear: true
        });
    });
</script>
@endsection
