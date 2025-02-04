@extends('layouts.app')

@section('content')
<h2>{{ $documento->titulo }}</h2>
<p>{{ $documento->descripcion }}</p>
<p><strong>Categoría:</strong> {{ $documento->categoria ?? 'Sin categoría' }}</p>
<p><strong>Subido por:</strong> {{ $documento->docente->nombre_completo }}</p>
<a href="{{ asset('storage/' . $documento->archivo_path) }}" class="btn btn-success" download>Descargar Documento</a>
<a href="{{ route('documentos.index') }}" class="btn btn-secondary">Volver al listado</a>
@endsection
