<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AsesoriaController;
use App\Http\Controllers\CapsulaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComentarioController;


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
    Route::resource('asesorias', AsesoriaController::class);
    Route::resource('capsulas', CapsulaController::class);
    Route::resource('documentos', DocumentoController::class);
    
    // Ruta para descargar el documento con su nombre y formato original
    Route::get('/documentos/{id}/download', [DocumentoController::class, 'download'])->name('documentos.download');
    
    // Rutas de administración de usuarios (solo para administradores, se puede proteger con middleware adicional)
    Route::resource('users', UserController::class);
    
   // Rutas para comentarios
   Route::post('comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
   Route::post('comentarios/{comentario}/reaccion', [ComentarioController::class, 'reaccion'])->name('comentarios.reaccion');
});
