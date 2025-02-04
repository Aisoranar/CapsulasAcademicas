<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Para encriptar la contraseña

class UserController extends Controller
{
    /**
     * Muestra el listado de usuarios.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'identificacion'  => 'required|string|max:255|unique:users,identificacion',
            'email'           => 'required|email|max:255|unique:users,email',
            'password'        => 'required|string|min:6|confirmed',
            'rol'             => 'required|in:admin,docente,estudiante',
            'carrera'         => 'nullable|string|max:255',
            'departamento'    => 'nullable|string|max:255',
        ]);

        // Encriptar la contraseña antes de guardar
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra los detalles de un usuario.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Muestra el formulario para editar un usuario.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Actualiza la información del usuario.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:users,email,'.$user->id,
            'identificacion'  => 'required|string|max:255|unique:users,identificacion,'.$user->id,
            'rol'             => 'required|in:admin,docente,estudiante',
            'carrera'         => 'nullable|string|max:255',
            'departamento'    => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
