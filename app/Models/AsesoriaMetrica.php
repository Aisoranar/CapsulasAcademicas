<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesoriaMetrica extends Model
{
    use HasFactory;

    protected $fillable = [
        'asesoria_id',
        'user_id',
        'nombre_completo',
        'email',
        'rol',
    ];

    public function asesoria()
    {
        return $this->belongsTo(Asesoria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
