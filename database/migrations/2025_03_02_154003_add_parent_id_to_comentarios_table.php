<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('comentarios', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('contenido');
            $table->foreign('parent_id')->references('id')->on('comentarios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('comentarios', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
};
