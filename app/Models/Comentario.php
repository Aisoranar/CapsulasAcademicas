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
    ];

    public function capsula()
    {
        return $this->belongsTo(Capsula::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
