@extends('layouts.app')

@section('content')
<h2>{{ $documento->titulo }}</h2>
<p>{{ $documento->descripcion }}</p>
<p><strong>Categoría:</strong> {{ $documento->categoria ?? 'Sin categoría' }}</p>
<p><strong>Subido por:</strong> {{ $documento->docente->nombre_completo }}</p>
<div class="mb-3">
    @if(pathinfo($documento->archivo_path, PATHINFO_EXTENSION) === 'pdf')
        <iframe src="{{ asset('storage/' . $documento->archivo_path) }}#toolbar=0" frameborder="0" width="100%" height="600px"></iframe>
    @else
        <p>El documento no es un PDF y no se puede previsualizar.</p>
    @endif
</div>
<a href="{{ route('documentos.download', $documento->id) }}" class="btn btn-success">Descargar Documento</a>
<a href="{{ route('documentos.index') }}" class="btn btn-secondary">Volver al listado</a>
@endsection
