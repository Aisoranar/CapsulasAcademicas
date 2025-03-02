<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentable_id',
        'commentable_type',
        'user_id',
        'contenido',
        'parent_id'
    ];

    // Relación polimórfica: el elemento al que se comenta (Documento, Cápsula, etc.)
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Comentario padre (en caso de respuesta)
    public function parent()
    {
        return $this->belongsTo(Comentario::class, 'parent_id');
    }

    // Respuestas (comentarios hijos)
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
