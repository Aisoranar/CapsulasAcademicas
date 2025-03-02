@extends('layouts.app')

@section('content')
<h2>Documentos y Guías</h2>
<a href="{{ route('documentos.create') }}" class="btn btn-primary mb-3">Subir Nuevo Documento</a>
<div class="row">
    @foreach($documentos as $documento)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $documento->titulo }}</h5>
                    <p class="card-text">{{ Str::limit($documento->descripcion, 100) }}</p>
                    <a href="{{ route('documentos.download', $documento->id) }}" class="btn btn-sm btn-success">Descargar</a>
                    <!-- Botón para abrir el modal de previsualización del PDF -->
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#verDocumentoModal{{ $documento->id }}">
                        Ver PDF
                    </button>
                    <!-- Botón para ver los detalles (show) del documento -->
                    <a href="{{ route('documentos.show', $documento->id) }}" class="btn btn-sm btn-secondary">Ver Detalles</a>
                    <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-sm btn-warning">Editar</a>
                </div>
            </div>
        </div>

        <!-- Modal para previsualizar el documento PDF -->
        <div class="modal fade" id="verDocumentoModal{{ $documento->id }}" tabindex="-1" aria-labelledby="verDocumentoModalLabel{{ $documento->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verDocumentoModalLabel{{ $documento->id }}">{{ $documento->titulo }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        @if(pathinfo($documento->archivo_path, PATHINFO_EXTENSION) === 'pdf')
                            <iframe src="{{ asset('storage/' . $documento->archivo_path) }}#toolbar=0" frameborder="0" width="100%" height="600px"></iframe>
                        @else
                            <p>El documento no es un PDF y no se puede previsualizar.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('documentos.download', $documento->id) }}" class="btn btn-success">Descargar</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
