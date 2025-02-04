<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asesorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('docente_id')->constrained('users');
            $table->string('materia');       // Campo requerido: materia
            $table->string('tema');          // Campo para el tema de la asesoría
            $table->date('fecha');           // Fecha de la asesoría
            $table->string('hora_inicio');   // Hora de inicio (puedes cambiar a time() si lo prefieres)
            $table->string('hora_fin');      // Hora de fin
            $table->string('enlace_sala');   // Enlace a la sala (ej. Google Meet)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesorias');
    }
};
