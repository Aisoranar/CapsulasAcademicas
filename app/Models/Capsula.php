<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capsula extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'video_url',
        'docente_id',
        'categoria',
        'duracion', // Agregado el campo duracion
    ];

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
