@extends('layouts.app')

@section('content')
<h2>Crear Asesoría</h2>
<form action="{{ route('asesorias.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="docente_id" class="form-label">Docente</label>
        <select name="docente_id" id="docente_id" class="form-control" required>
            <option value="">Seleccione un docente</option>
            @foreach($docentes as $docente)
                <option value="{{ $docente->id }}">{{ $docente->nombre_completo }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="materia" class="form-label">Materia</label>
        <input type="text" name="materia" id="materia" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="tema" class="form-label">Tema</label>
        <input type="text" name="tema" id="tema" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora de inicio</label>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora de fin</label>
        <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="enlace_sala" class="form-label">Enlace a la sala virtual</label>
        <input type="url" name="enlace_sala" id="enlace_sala" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Crear asesoría</button>
</form>
@endsection
