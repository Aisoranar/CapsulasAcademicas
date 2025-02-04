<?php

namespace App\Http\Controllers;

use App\Models\Asesoria;
use App\Models\User;
use Illuminate\Http\Request;

class AsesoriaController extends Controller
{
    /**
     * Muestra la lista de asesorías.
     */
    public function index()
    {
        // Se cargan las relaciones de docente y estudiantes para cada asesoría
        $asesorias = Asesoria::with('docente', 'estudiantes')->get();
        return view('asesorias.index', compact('asesorias'));
    }

    /**
     * Muestra el formulario para crear una nueva asesoría.
     */
    public function create()
    {
        // Se obtiene la lista de docentes para que el usuario elija
        $docentes = User::where('rol', 'docente')->get();
        return view('asesorias.create', compact('docentes'));
    }

    /**
     * Almacena la nueva asesoría en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'docente_id'   => 'required|exists:users,id',
            'materia'      => 'required|string|max:255',
            'tema'         => 'required|string|max:255',
            'fecha'        => 'required|date',
            'hora_inicio'  => 'required',
            'hora_fin'     => 'required',
            'enlace_sala'  => 'required|url',
        ]);

        Asesoria::create($validated);

        return redirect()->route('asesorias.index')->with('success', 'Asesoría creada exitosamente.');
    }

    /**
     * Muestra los detalles de una asesoría en particular.
     */
    public function show($id)
    {
        $asesoria = Asesoria::with('docente', 'estudiantes')->findOrFail($id);
        return view('asesorias.show', compact('asesoria'));
    }

    /**
     * Muestra el formulario para editar una asesoría existente.
     */
    public function edit($id)
    {
        $asesoria = Asesoria::findOrFail($id);
        $docentes = User::where('rol', 'docente')->get();
        return view('asesorias.edit', compact('asesoria', 'docentes'));
    }

    /**
     * Actualiza la asesoría en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $asesoria = Asesoria::findOrFail($id);
        $validated = $request->validate([
            'docente_id'   => 'required|exists:users,id',
            'materia'      => 'required|string|max:255',
            'tema'         => 'required|string|max:255',
            'fecha'        => 'required|date',
            'hora_inicio'  => 'required',
            'hora_fin'     => 'required',
            'enlace_sala'  => 'required|url',
        ]);

        $asesoria->update($validated);

        return redirect()->route('asesorias.index')->with('success', 'Asesoría actualizada exitosamente.');
    }

    /**
     * Elimina una asesoría.
     */
    public function destroy($id)
    {
        $asesoria = Asesoria::findOrFail($id);
        $asesoria->delete();

        return redirect()->route('asesorias.index')->with('success', 'Asesoría eliminada exitosamente.');
    }
}
