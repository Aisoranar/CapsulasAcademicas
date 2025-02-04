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
        Schema::create('capsulas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('docente_id')->constrained('users');
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('video_url');
            $table->integer('duracion'); // En minutos
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capsulas');
    }
};
