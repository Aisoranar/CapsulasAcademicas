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
                    <a href="{{ asset('storage/' . $documento->archivo_path) }}" class="btn btn-sm btn-success" download>Descargar</a>
                    <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-sm btn-warning">Editar</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
