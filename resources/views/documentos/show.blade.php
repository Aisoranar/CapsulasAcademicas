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

<hr>
<h3 class="text-center">Comentarios</h3>

<!-- Formulario para agregar un comentario principal al documento -->
<form action="{{ route('comentarios.store') }}" method="POST">
    @csrf
    <!-- Campos para la relación polimórfica -->
    <input type="hidden" name="commentable_id" value="{{ $documento->id }}">
    <input type="hidden" name="commentable_type" value="App\Models\Documento">
    <!-- Comentario principal: sin parent_id -->
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
@foreach($documento->comentarios->where('parent_id', null) as $comentario)
    @include('comentarios._comentario', ['comentario' => $comentario])
@endforeach

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    // Toggle para mostrar/ocultar formularios de respuesta inline
    const replyToggleButtons = document.querySelectorAll('.reply-toggle');
    replyToggleButtons.forEach(button => {
        button.addEventListener('click', function(){
            const commentId = this.getAttribute('data-id');
            const formContainer = document.getElementById('reply-form-' + commentId);
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
