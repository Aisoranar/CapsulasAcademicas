@extends('layouts.app')

@section('content')
<h2>Detalles de la Asesoría</h2>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $asesoria->materia }} - {{ $asesoria->tema }}</h5>
        <p class="card-text"><strong>Fecha:</strong> {{ $asesoria->fecha }}</p>
        <p class="card-text"><strong>Horario:</strong> {{ $asesoria->hora_inicio }} - {{ $asesoria->hora_fin }}</p>
        <p class="card-text"><strong>Docente:</strong> {{ $asesoria->docente->nombre_completo }}</p>
        <p class="card-text"><strong>Enlace a la sala:</strong> <a href="{{ $asesoria->enlace_sala }}" target="_blank">{{ $asesoria->enlace_sala }}</a></p>
    </div>
</div>
@endsection
