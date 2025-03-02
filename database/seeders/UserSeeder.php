<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Ejecuta el seeder para crear los usuarios iniciales.
     */
    public function run(): void
    {
        // Usuario administrador
        User::create([
            'nombre_completo'         => 'Administrador del Sistema',
            'identificacion'          => '0001',
            'email'                   => 'aisor@gmail.com',
            'password'                => Hash::make('aisor123'),
            'rol'                     => 'admin',
            'programa_academico'      => null,
            'departamento_academico'  => null,
        ]);
        // Usuario administrador
        User::create([
            'nombre_completo'         => 'Camilo',
            'identificacion'          => '0002',
            'email'                   => 'camilo@gmail.com',
            'password'                => Hash::make('camilo123'),
            'rol'                     => 'admin',
            'programa_academico'      => null,
            'departamento_academico'  => null,
        ]);

        // Usuario docente
        User::create([
            'nombre_completo'         => 'Docente de Prueba',
            'identificacion'          => '0003',
            'email'                   => 'docente@example.com',
            'password'                => Hash::make('password'),
            'rol'                     => 'docente',
            'programa_academico'      => null,
            'departamento_academico'  => 'Departamento de Ejemplo',
        ]);

        // Usuario estudiante
        User::create([
            'nombre_completo'         => 'Estudiante de Prueba',
            'identificacion'          => '0004',
            'email'                   => 'estudiante@example.com',
            'password'                => Hash::make('password'),
            'rol'                     => 'estudiante',
            // Se asigna un programa válido de acuerdo a la migración
            'programa_academico'      => 'Ingeniería Informática',
            'departamento_academico'  => null,
        ]);
    }
}
