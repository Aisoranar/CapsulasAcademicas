@extends('layouts.app')

@section('content')
<h2>{{ $capsula->titulo }}</h2>
<div class="mb-3">
    <p>{{ $capsula->descripcion }}</p>
</div>
<div class="mb-3">
    @if(strpos($capsula->video_url, 'youtube.com') !== false || strpos($capsula->video_url, 'youtu.be') !== false)
        @php
            if (! function_exists('extractVideoID')) {
                function extractVideoID($url) {
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
                    return $matches[1] ?? '';
                }
            }
            $videoID = extractVideoID($capsula->video_url);
            // Se agregan parámetros para minimizar distracciones
            $embedUrl = "https://www.youtube.com/embed/" . $videoID . "?rel=0&showinfo=0";
        @endphp
        <div class="ratio ratio-16x9">
            <iframe src="{{ $embedUrl }}" title="{{ $capsula->titulo }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <p class="mt-2">
            Si el video no se reproduce, <a href="{{ $capsula->video_url }}" target="_blank">ver en YouTube</a>.
        </p>
    @else
        <video controls class="w-100">
            <source src="{{ $capsula->video_url }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
    @endif
</div>
<div class="mb-3">
    <p><strong>Categoría:</strong> {{ $capsula->categoria ?? 'Sin categoría' }}</p>
    <p><strong>Docente:</strong> {{ $capsula->docente->nombre_completo }}</p>
</div>
<a href="{{ route('capsulas.index') }}" class="btn btn-secondary">Volver al listado</a>
@endsection
