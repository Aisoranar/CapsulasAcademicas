<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecuta el seeder de usuarios
        $this->call([
            UserSeeder::class,
        ]);

        // Puedes agregar otros seeders aquí, por ejemplo:
        // $this->call(AnotherSeeder::class);
    }
}
