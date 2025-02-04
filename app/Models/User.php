<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre_completo',
        'identificacion',
        'email',
        'password',
        'rol',
        'carrera',
        'departamento',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function asesorias()
    {
        return $this->hasMany(Asesoria::class, 'docente_id');
    }

    public function asistencias()
    {
        return $this->belongsToMany(Asesoria::class, 'asesoria_estudiante', 'estudiante_id', 'asesoria_id');
    }

    public function capsulas()
    {
        return $this->hasMany(Capsula::class, 'docente_id');
    }
}
