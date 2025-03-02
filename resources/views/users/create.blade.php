@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="mb-0">Crear Nuevo Usuario</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
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
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select name="rol" id="rol" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="docente">Docente</option>
                                <option value="estudiante">Estudiante</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="programa_academico" class="form-label">Programa Académico</label>
                            <select name="programa_academico" id="programa_academico" class="form-control">
                                <option value="">Seleccione un programa</option>
                                @foreach($programas as $programa)
                                    <option value="{{ $programa }}">{{ $programa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="departamento_academico" class="form-label">Departamento</label>
                            <input type="text" name="departamento_academico" id="departamento_academico" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Incluye jQuery y Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- CSS para agregar el ícono de búsqueda en el campo de Select2 -->
<style>
.select2-container--default .select2-search--dropdown .select2-search__field {
    background: url('https://cdn-icons-png.flaticon.com/512/483/483356.png') no-repeat 10px center;
    padding-left: 35px;
}
</style>
<script>
    $(document).ready(function() {
        $('#programa_academico').select2({
            placeholder: 'Seleccione un programa',
            allowClear: true,
            minimumResultsForSearch: 0 // Siempre muestra el campo de búsqueda
        });
    });
</script>
@endsection
