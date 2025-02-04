@extends('layouts.app')

@section('content')
<h2>{{ $capsula->titulo }}</h2>
<div class="mb-3">
    <p>{{ $capsula->descripcion }}</p>
</div>
<div class="mb-3">
    <div class="ratio ratio-16x9">
        <iframe src="{{ $capsula->video_url }}" title="{{ $capsula->titulo }}" allowfullscreen></iframe>
    </div>
</div>
<div class="mb-3">
    <p><strong>Categoría:</strong> {{ $capsula->categoria ?? 'Sin categoría' }}</p>
    <p><strong>Docente:</strong> {{ $capsula->docente->nombre_completo }}</p>
</div>
<a href="{{ route('capsulas.index') }}" class="btn btn-secondary">Volver al listado</a>
@endsection
