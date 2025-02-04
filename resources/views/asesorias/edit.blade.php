@extends('layouts.app')

@section('content')
<h2>Editar Asesoría</h2>
<form action="{{ route('asesorias.update', $asesoria->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="docente_id" class="form-label">Docente</label>
        <select name="docente_id" id="docente_id" class="form-control" required>
            @foreach($docentes as $docente)
                <option value="{{ $docente->id }}" {{ $asesoria->docente_id == $docente->id ? 'selected' : '' }}>
                    {{ $docente->nombre_completo }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="materia" class="form-label">Materia</label>
        <input type="text" name="materia" id="materia" class="form-control" value="{{ $asesoria->materia }}" required>
    </div>
    <div class="mb-3">
        <label for="tema" class="form-label">Tema</label>
        <input type="text" name="tema" id="tema" class="form-control" value="{{ $asesoria->tema }}" required>
    </div>
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $asesoria->fecha }}" required>
    </div>
    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora de inicio</label>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ $asesoria->hora_inicio }}" required>
    </div>
    <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora de fin</label>
        <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ $asesoria->hora_fin }}" required>
    </div>
    <div class="mb-3">
        <label for="enlace_sala" class="form-label">Enlace a la sala virtual</label>
        <input type="url" name="enlace_sala" id="enlace_sala" class="form-control" value="{{ $asesoria->enlace_sala }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar asesoría</button>
</form>
@endsection
