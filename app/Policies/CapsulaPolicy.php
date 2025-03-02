<?php

namespace App\Policies;

use App\Models\Capsula;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CapsulaPolicy
{
    /**
     * Permite crear una cápsula.
     * Admin y docentes pueden crear.
     */
    public function create(User $user)
    {
        return in_array($user->rol, ['admin', 'docente'])
            ? Response::allow()
            : Response::deny('No tienes permiso para crear cápsulas.');
    }

    /**
     * Permite actualizar una cápsula.
     * Admin puede actualizar cualquier cápsula.
     * Docente puede actualizar solo la suya.
     */
    public function update(User $user, Capsula $capsula)
    {
        if ($user->rol === 'admin') {
            return Response::allow();
        }
        if ($user->rol === 'docente' && $capsula->docente_id == $user->id) {
            return Response::allow();
        }
        return Response::deny('No tienes permiso para actualizar esta cápsula.');
    }

    /**
     * Permite eliminar una cápsula.
     * Admin puede eliminar cualquier cápsula.
     * Docente puede eliminar solo la suya.
     */
    public function delete(User $user, Capsula $capsula)
    {
        if ($user->rol === 'admin') {
            return Response::allow();
        }
        if ($user->rol === 'docente' && $capsula->docente_id == $user->id) {
            return Response::allow();
        }
        return Response::deny('No tienes permiso para eliminar esta cápsula.');
    }
}
