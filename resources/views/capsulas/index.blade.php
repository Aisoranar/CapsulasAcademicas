@extends('layouts.app')

@section('content')
<h2>Listado de Cápsulas de Aprendizaje</h2>
<a href="{{ route('capsulas.create') }}" class="btn btn-primary mb-3">Subir nueva cápsula</a>

@php
    if (! function_exists('extractVideoID')) {
        function extractVideoID($url) {
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
            return $matches[1] ?? '';
        }
    }
@endphp

<div class="row">
    @foreach($capsulas as $capsula)
        <div class="col-md-4 mb-3">
            <div class="card">
                @if(strpos($capsula->video_url, 'youtube.com') !== false || strpos($capsula->video_url, 'youtu.be') !== false)
                    <img src="https://img.youtube.com/vi/{{ extractVideoID($capsula->video_url) }}/hqdefault.jpg" alt="{{ $capsula->titulo }}" class="card-img-top">
                @else
                    <!-- Se muestra el video subido como vista previa -->
                    <video class="card-img-top" src="{{ $capsula->video_url }}" muted preload="metadata" style="width:100%; height:auto;"></video>
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $capsula->titulo }}</h5>
                    <p class="card-text">{{ Str::limit($capsula->descripcion, 100) }}</p>
                    <a href="{{ route('capsulas.show', $capsula->id) }}" class="btn btn-sm btn-info">Ver cápsula</a>
                    <a href="{{ route('capsulas.edit', $capsula->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('capsulas.destroy', $capsula->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta cápsula?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
