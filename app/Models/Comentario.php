<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'capsula_id',
        'user_id',
        'contenido',
        'parent_id',
    ];

    public function capsula()
    {
        return $this->belongsTo(Capsula::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Comentario padre (si es respuesta a otro comentario)
    public function parent()
    {
        return $this->belongsTo(Comentario::class, 'parent_id');
    }

    // Respuestas al comentario (comentarios hijos)
    public function replies()
    {
        return $this->hasMany(Comentario::class, 'parent_id');
    }

    // Reacciones (like/dislike)
    public function reacciones()
    {
        return $this->hasMany(ComentarioReaccion::class);
    }
}
