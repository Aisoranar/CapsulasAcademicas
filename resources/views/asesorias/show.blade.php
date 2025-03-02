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
            <!-- El enlace ahora activa un modal -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#accederSalaModal">Acceder a la sala</a>
        </p>
    </div>
</div>

<!-- Modal para confirmar acceso a la sala -->
<div class="modal fade" id="accederSalaModal" tabindex="-1" aria-labelledby="accederSalaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('asesorias.metricas.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="accederSalaModalLabel">Confirmar Acceso a la Sala</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
              <p>Por favor, confirma tus datos antes de acceder a la sala.</p>
              <input type="hidden" name="asesoria_id" value="{{ $asesoria->id }}">
              <div class="mb-3">
                  <label class="form-label">Nombre Completo</label>
                  <input type="text" class="form-control" value="{{ auth()->user()->nombre_completo }}" readonly>
              </div>
              <div class="mb-3">
                  <label class="form-label">Correo Electrónico</label>
                  <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
              </div>
              <div class="mb-3">
                  <label class="form-label">Rol</label>
                  <input type="text" class="form-control" value="{{ auth()->user()->rol }}" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Aceptar y Acceder</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
