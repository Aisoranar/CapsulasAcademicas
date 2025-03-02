<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Muestra la lista de documentos.
     */
    public function index()
    {
        $documentos = Documento::with('docente')->get();
        return view('documentos.index', compact('documentos'));
    }

    /**
     * Muestra el formulario para subir un nuevo documento.
     */
    public function create()
    {
        return view('documentos.create');
    }

    /**
     * Almacena el documento en la base de datos y sube el archivo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo'     => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'categoria'   => 'nullable|string|max:255',
        ]);

        // Se sube el archivo al disco "public" en la carpeta "documentos"
        $path = $request->file('archivo')->store('documentos', 'public');
        $validated['archivo_path'] = $path;
        // Se guarda el nombre original del archivo para usarlo en la descarga
        $validated['nombre_original'] = $request->file('archivo')->getClientOriginalName();
        // Se asigna el docente autenticado
        $validated['docente_id'] = Auth::id();

        Documento::create($validated);

        return redirect()->route('documentos.index')->with('success', 'Documento subido exitosamente.');
    }

    /**
     * Muestra los detalles de un documento.
     */
    public function show($id)
    {
        $documento = Documento::with('docente')->findOrFail($id);
        return view('documentos.show', compact('documento'));
    }

    /**
     * Muestra el formulario para editar un documento.
     */
    public function edit($id)
    {
        $documento = Documento::findOrFail($id);
        return view('documentos.edit', compact('documento'));
    }

    /**
     * Actualiza el documento y, en caso de haber un nuevo archivo, lo reemplaza.
     */
    public function update(Request $request, $id)
    {
        $documento = Documento::findOrFail($id);
        $validated = $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria'   => 'nullable|string|max:255',
            'archivo'     => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ]);

        if ($request->hasFile('archivo')) {
            // Eliminar el archivo antiguo si existe
            if ($documento->archivo_path) {
                Storage::disk('public')->delete($documento->archivo_path);
            }
            $path = $request->file('archivo')->store('documentos', 'public');
            $validated['archivo_path'] = $path;
            // Actualizamos el nombre original del archivo
            $validated['nombre_original'] = $request->file('archivo')->getClientOriginalName();
        }

        $documento->update($validated);

        return redirect()->route('documentos.index')->with('success', 'Documento actualizado exitosamente.');
    }

    /**
     * Elimina el documento y su archivo asociado.
     */
    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        if ($documento->archivo_path) {
            Storage::disk('public')->delete($documento->archivo_path);
        }
        $documento->delete();

        return redirect()->route('documentos.index')->with('success', 'Documento eliminado exitosamente.');
    }

    /**
     * Descarga el documento con el nombre y formato original.
     */
    public function download($id)
    {
        $documento = Documento::findOrFail($id);
        // Ruta almacenada en el disco "public"
        $path = $documento->archivo_path;
        // Usa el nombre original, o si no existe, el basename del path
        $filename = $documento->nombre_original ? $documento->nombre_original : basename($path);
        // Ruta completa del archivo
        $fullPath = Storage::disk('public')->path($path);
        // Determinar el MIME type
        $mimeType = Storage::disk('public')->mimeType($path);
    
        return response()->download($fullPath, $filename, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="'.$filename.'"'
        ]);
    }
}
