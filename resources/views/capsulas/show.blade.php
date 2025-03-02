@extends('layouts.app')

@section('content')
<h2 class="text-center">{{ $capsula->titulo }}</h2>

<!-- Descripción estilizada y centrada -->
<div class="mb-3" style="max-width: 600px; margin: auto; border: 2px solid #ddd; border-radius: 8px; padding: 15px;">
    <p class="text-center">{{ $capsula->descripcion }}</p>
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
            $embedUrl = "https://www.youtube.com/embed/" . $videoID . "?rel=0&showinfo=0";
        @endphp
        <div class="ratio ratio-16x9" style="max-width: 600px; margin: auto; border: 2px solid #ddd; border-radius: 8px; overflow: hidden;">
            <iframe src="{{ $embedUrl }}" title="{{ $capsula->titulo }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <p class="mt-2 text-center">
            Si el video no se reproduce, <a href="{{ $capsula->video_url }}" target="_blank">ver en YouTube</a>.
        </p>
    @else
        <video controls class="w-100" style="max-width: 600px; margin: auto; border: 2px solid #ddd; border-radius: 8px; display: block;">
            <source src="{{ $capsula->video_url }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
    @endif
</div>

<div class="mb-3 text-center">
    <p><strong>Categoría:</strong> {{ $capsula->categoria ?? 'Sin categoría' }}</p>
    <p><strong>Docente:</strong> {{ $capsula->docente->nombre_completo }}</p>
</div>

<hr>
<h3 class="text-center">Comentarios</h3>

<!-- Formulario para agregar un comentario principal -->
<form action="{{ route('comentarios.store') }}" method="POST">
    @csrf
    <input type="hidden" name="capsula_id" value="{{ $capsula->id }}">
    <!-- parent_id vacío para comentarios principales -->
    <input type="hidden" name="parent_id" value="">
    <div class="alert alert-warning">
        Por favor, cuida tu vocabulario y no utilices palabras no relacionadas al tema.
    </div>
    <div class="mb-3">
        <textarea name="contenido" class="form-control" rows="3" placeholder="Escribe tu comentario"></textarea>
        @error('contenido')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Comentar</button>
</form>

<hr>
<!-- Mostrar comentarios principales y sus respuestas -->
@foreach($capsula->comentarios->where('parent_id', null) as $comentario)
    @include('comentarios._comentario', ['comentario' => $comentario])
@endforeach

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    // Se añaden listeners a todos los botones "Responder"
    const replyToggleButtons = document.querySelectorAll('.reply-toggle');
    replyToggleButtons.forEach(button => {
        button.addEventListener('click', function(){
            const commentId = this.getAttribute('data-id');
            const formContainer = document.getElementById('reply-form-' + commentId);
            // Se alterna la visibilidad del formulario
            if(formContainer.style.display === 'none' || formContainer.style.display === ''){
                formContainer.style.display = 'block';
            } else {
                formContainer.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
