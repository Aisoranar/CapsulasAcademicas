@extends('layouts.app')

@section('content')
<h2>Listado de Asesorías</h2>
<a href="{{ route('asesorias.create') }}" class="btn btn-primary mb-3">Crear nueva asesoría</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Materia</th>
            <th>Tema</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Docente</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asesorias as $asesoria)
            <tr>
                <td>{{ $asesoria->materia }}</td>
                <td>{{ $asesoria->tema }}</td>
                <td>{{ $asesoria->fecha }}</td>
                <td>{{ $asesoria->hora_inicio }} - {{ $asesoria->hora_fin }}</td>
                <td>{{ $asesoria->docente->nombre_completo }}</td>
                <td>
                    <a href="{{ route('asesorias.show', $asesoria->id) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('asesorias.edit', $asesoria->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('asesorias.destroy', $asesoria->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro?')" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
