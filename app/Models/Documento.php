<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria',
        'archivo_path',
        'nombre_original',
        'docente_id',
    ];

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }
}
