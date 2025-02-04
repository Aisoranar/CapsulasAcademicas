@extends('layouts.app')

@section('content')
<h2>Editar Documento</h2>
<form action="{{ route('documentos.update', $documento->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $documento->titulo }}" required>
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción (opcional)</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ $documento->descripcion }}</textarea>
    </div>
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría (opcional)</label>
        <input type="text" name="categoria" id="categoria" class="form-control" value="{{ $documento->categoria }}">
    </div>
    <div class="mb-3">
        <label for="archivo" class="form-label">Archivo (dejar en blanco para conservar el actual)</label>
        <input type="file" name="archivo" id="archivo" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Documento</button>
</form>
@endsection
