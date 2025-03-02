@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Listado de Usuarios</h2>
                </div>
                <div class="card-body">
                    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Crear Nuevo Usuario</a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre completo</th>
                                    <th>Email</th>
                                    <th>Identificación</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->nombre_completo }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->identificacion }}</td>
                                        <td>{{ $user->rol }}</td>
                                        <td>
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">Ver</a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('¿Seguro?')" class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
