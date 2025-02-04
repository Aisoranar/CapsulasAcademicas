<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'docente_id',
        'materia',
        'tema',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'enlace_sala',
    ];

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function estudiantes()
    {
        // Se usa la tabla pivote "asesoria_estudiante"
        return $this->belongsToMany(User::class, 'asesoria_estudiante', 'asesoria_id', 'estudiante_id');
    }
}
