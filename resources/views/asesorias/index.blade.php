@extends('layouts.app')

@section('content')
<h2>Listado de Asesorías</h2>
@if(auth()->user()->rol !== 'estudiante')
    <a href="{{ route('asesorias.create') }}" class="btn btn-primary mb-3">Crear nueva asesoría</a>
@endif

<div class="row">
    @foreach($asesorias as $asesoria)
        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <!-- Encabezado con el ícono grande -->
                <div class="card-header text-center bg-white border-0">
                    <i class="bi bi-calendar-check" style="font-size: 4rem; color: #001f3f;"></i>
                </div>
                <!-- Información de la asesoría -->
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $asesoria->materia }}</h5>
                    <p class="card-text">{{ $asesoria->tema }}</p>
                    <p class="card-text mb-1"><strong>Fecha:</strong> {{ $asesoria->fecha }}</p>
                    <p class="card-text mb-1"><strong>Horario:</strong> {{ $asesoria->hora_inicio }} - {{ $asesoria->hora_fin }}</p>
                    <p class="card-text"><strong>Docente:</strong> {{ $asesoria->docente->nombre_completo }}</p>
                </div>
                <!-- Botones de acción agrupados con separación -->
                <div class="card-footer text-center">
                    <div class="d-flex justify-content-center gap-2" role="group" aria-label="Acciones">
                        <a href="{{ route('asesorias.show', $asesoria->id) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i> Ver
                        </a>
                        @if(auth()->user()->rol !== 'estudiante')
                        <a href="{{ route('asesorias.edit', $asesoria->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('asesorias.destroy', $asesoria->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
