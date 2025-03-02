<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('asesoria_metricas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asesoria_id')->constrained('asesorias')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nombre_completo');
            $table->string('email');
            $table->string('rol');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asesoria_metricas');
    }
};
