@extends('layouts.app')

@section('content')
<h2>Detalle del Usuario</h2>
<ul class="list-group">
    <li class="list-group-item"><strong>Nombre:</strong> {{ $user->nombre_completo }}</li>
    <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
    <li class="list-group-item"><strong>Identificación:</strong> {{ $user->identificacion }}</li>
    <li class="list-group-item"><strong>Rol:</strong> {{ $user->rol }}</li>
    <li class="list-group-item"><strong>Programa Académico:</strong> {{ $user->programa_academico ?? 'N/A' }}</li>
    <li class="list-group-item"><strong>Departamento Académico:</strong> {{ $user->departamento_academico ?? 'N/A' }}</li>
</ul>
<a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
@endsection
