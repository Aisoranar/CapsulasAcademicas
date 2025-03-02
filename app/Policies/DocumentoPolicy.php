<?php

namespace App\Policies;

use App\Models\Documento;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DocumentoPolicy
{
    /**
     * Determina si el usuario puede crear un documento.
     * Se permite a usuarios con rol "admin" o "docente".
     */
    public function create(User $user)
    {
        return in_array($user->rol, ['admin', 'docente'])
            ? Response::allow()
            : Response::deny('No tienes permiso para crear documentos.');
    }

    /**
     * Determina si el usuario puede actualizar el documento.
     * Se permite a admin actualizar cualquier documento y a un docente solo si le pertenece.
     */
    public function update(User $user, Documento $documento)
    {
        if ($user->rol === 'admin') {
            return Response::allow();
        }
        if ($user->rol === 'docente' && $documento->docente_id == $user->id) {
            return Response::allow();
        }
        return Response::deny('No tienes permiso para actualizar este documento.');
    }

    /**
     * Determina si el usuario puede eliminar el documento.
     * Se permite a admin eliminar cualquier documento y a un docente solo si le pertenece.
     */
    public function delete(User $user, Documento $documento)
    {
        if ($user->rol === 'admin') {
            return Response::allow();
        }
        if ($user->rol === 'docente' && $documento->docente_id == $user->id) {
            return Response::allow();
        }
        return Response::deny('No tienes permiso para eliminar este documento.');
    }
}
