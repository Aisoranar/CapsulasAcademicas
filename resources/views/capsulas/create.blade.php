@extends('layouts.app')

@section('content')
<h2>Subir Nueva Cápsula de Aprendizaje</h2>
<form action="{{ route('capsulas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
    </div>
    <div class="mb-3">
        <label for="video_url" class="form-label">URL del Video (opcional)</label>
        <input type="url" name="video_url" id="video_url" class="form-control">
    </div>
    <div class="mb-3">
        <label for="video_file" class="form-label">Subir Video (opcional)</label>
        <input type="file" name="video_file" id="video_file" class="form-control">
    </div>
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría (opcional)</label>
        <input type="text" name="categoria" id="categoria" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Subir Cápsula</button>
</form>
@endsection
