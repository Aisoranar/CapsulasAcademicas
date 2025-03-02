<?php

namespace App\Policies;

use App\Models\Asesoria;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AsesoriaPolicy
{
    /**
     * Permite crear una asesoría.
     * Admin y docentes pueden crear.
     */
    public function create(User $user)
    {
        return in_array($user->rol, ['admin', 'docente'])
            ? Response::allow()
            : Response::deny('No tienes permiso para crear asesorías.');
    }

    /**
     * Permite actualizar la asesoría.
     * Tanto admin como docentes pueden actualizar cualquier asesoría.
     */
    public function update(User $user, Asesoria $asesoria)
    {
        return in_array($user->rol, ['admin', 'docente'])
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar esta asesoría.');
    }

    /**
     * Permite eliminar la asesoría.
     * Tanto admin como docentes pueden eliminar cualquier asesoría.
     */
    public function delete(User $user, Asesoria $asesoria)
    {
        return in_array($user->rol, ['admin', 'docente'])
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar esta asesoría.');
    }
}
