<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up(): void
    {
        Schema::create('asesoria_estudiante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asesoria_id')->constrained('asesorias')->onDelete('cascade');
            $table->foreignId('estudiante_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesoria_estudiante');
    }
};
