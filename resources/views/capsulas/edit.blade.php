@extends('layouts.app')

@section('content')
<h2>Editar Cápsula de Aprendizaje</h2>
<form action="{{ route('capsulas.update', $capsula->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $capsula->titulo }}" required>
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ $capsula->descripcion }}</textarea>
    </div>
    <div class="mb-3">
        <label for="video_url" class="form-label">URL del Video</label>
        <input type="url" name="video_url" id="video_url" class="form-control" value="{{ $capsula->video_url }}" required>
    </div>
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría (opcional)</label>
        <input type="text" name="categoria" id="categoria" class="form-control" value="{{ $capsula->categoria }}">
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Cápsula</button>
</form>
@endsection
