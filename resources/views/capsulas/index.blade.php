@extends('layouts.app')

@section('content')
<h2>Listado de Cápsulas de Aprendizaje</h2>
<a href="{{ route('capsulas.create') }}" class="btn btn-primary mb-3">Subir nueva cápsula</a>
<div class="row">
    @foreach($capsulas as $capsula)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="https://img.youtube.com/vi/{{ extractVideoID($capsula->video_url) }}/hqdefault.jpg" alt="{{ $capsula->titulo }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $capsula->titulo }}</h5>
                    <p class="card-text">{{ Str::limit($capsula->descripcion, 100) }}</p>
                    <a href="{{ route('capsulas.show', $capsula->id) }}" class="btn btn-sm btn-info">Ver cápsula</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@php
    // Función auxiliar para extraer el ID del vídeo de YouTube
    function extractVideoID($url) {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
        return $matches[1] ?? '';
    }
@endphp

@endsection
