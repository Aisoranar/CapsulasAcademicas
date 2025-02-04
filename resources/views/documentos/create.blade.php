@extends('layouts.app')

@section('content')
<h2>Subir Nuevo Documento</h2>
<form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción (opcional)</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría (opcional)</label>
        <input type="text" name="categoria" id="categoria" class="form-control">
    </div>
    <div class="mb-3">
        <label for="archivo" class="form-label">Archivo</label>
        <input type="file" name="archivo" id="archivo" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
    </div>
    <button type="submit" class="btn btn-primary">Subir Documento</button>
</form>
@endsection
