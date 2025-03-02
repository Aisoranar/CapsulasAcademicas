@extends('layouts.app')

@section('content')
<h2>Detalles de la Asesoría</h2>
<div class="card shadow-sm">
    <!-- Encabezado con el ícono grande -->
    <div class="card-header text-center bg-white border-0">
        <i class="bi bi-calendar-check" style="font-size: 4rem; color: #001f3f;"></i>
    </div>
    <!-- Detalles de la asesoría -->
    <div class="card-body">
        <h5 class="card-title text-center">{{ $asesoria->materia }} - {{ $asesoria->tema }}</h5>
        <p class="card-text"><i class="bi bi-calendar me-1"></i> <strong>Fecha:</strong> {{ $asesoria->fecha }}</p>
        <p class="card-text"><i class="bi bi-clock me-1"></i> <strong>Horario:</strong> {{ $asesoria->hora_inicio }} - {{ $asesoria->hora_fin }}</p>
        <p class="card-text"><i class="bi bi-person me-1"></i> <strong>Docente:</strong> {{ $asesoria->docente->nombre_completo }}</p>
        <p class="card-text">
            <i class="bi bi-link-45deg me-1"></i> 
            <strong>Enlace a la sala:</strong> 
            <a href="{{ $asesoria->enlace_sala }}" target="_blank">{{ $asesoria->enlace_sala }}</a>
        </p>
    </div>
</div>
@endsection
