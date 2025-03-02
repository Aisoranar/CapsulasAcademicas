<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AsesoriaController;
use App\Http\Controllers\CapsulaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComentarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {

    // Asesorías:
    // La acción "show" es accesible para todos los usuarios autenticados.
    Route::get('asesorias/{asesoria}', [AsesoriaController::class, 'show'])->name('asesorias.show');
    // Las demás acciones del CRUD se definen en el resource (la autorización se maneja con policies en el controlador).
    Route::resource('asesorias', AsesoriaController::class)->except(['show']);

    // Cápsulas:
    // La acción "show" es accesible para todos los usuarios autenticados.
    Route::get('capsulas/{capsula}', [CapsulaController::class, 'show'])->name('capsulas.show');
    // Las demás acciones del CRUD se definen en el resource (la autorización se maneja con policies en el controlador).
    Route::resource('capsulas', CapsulaController::class)->except(['show']);

    // Documentos:
    // La acción "show" es accesible para todos los usuarios autenticados.
    Route::get('documentos/{documento}', [DocumentoController::class, 'show'])->name('documentos.show');
    // Las demás acciones del CRUD se definen en el resource (la autorización se maneja con policies en el controlador).
    Route::resource('documentos', DocumentoController::class)->except(['show']);

    // Ruta para descargar el documento con su nombre y formato original.
    Route::get('/documentos/{id}/download', [DocumentoController::class, 'download'])->name('documentos.download');

    // Usuarios:
    // La acción "show" (ver perfil) estará disponible para todos los usuarios autenticados.
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    // Las demás acciones del CRUD de usuarios (crear, editar, eliminar) se protegen con el middleware 'admin'.
    Route::resource('users', UserController::class)->except(['show'])->middleware('admin');

    // Rutas para comentarios (polimórficos)
    Route::post('comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::post('comentarios/{comentario}/reaccion', [ComentarioController::class, 'reaccion'])->name('comentarios.reaccion');
});
