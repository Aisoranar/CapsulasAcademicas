<?php

namespace App\Policies;

use App\Models\Asesoria;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AsesoriaPolicy
{
    /**
     * Permite actualizar la asesoría.
     * El admin puede actualizar cualquier asesoría,
     * el docente puede actualizar solo la suya.
     */
    public function update(User $user, Asesoria $asesoria)
    {
        if ($user->rol === 'admin') {
            return Response::allow();
        }
        if ($user->rol === 'docente' && $asesoria->docente_id == $user->id) {
            return Response::allow();
        }
        return Response::deny('No tienes permiso para actualizar esta asesoría.');
    }

    /**
     * Permite eliminar la asesoría.
     * El admin puede eliminar cualquier asesoría,
     * el docente puede eliminar solo la suya.
     */
    public function delete(User $user, Asesoria $asesoria)
    {
        if ($user->rol === 'admin') {
            return Response::allow();
        }
        if ($user->rol === 'docente' && $asesoria->docente_id == $user->id) {
            return Response::allow();
        }
        return Response::deny('No tienes permiso para eliminar esta asesoría.');
    }
}
