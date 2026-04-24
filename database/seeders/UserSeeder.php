<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crea 5 usuarios aleatorios [cite: 97]
        User::factory(5)->create();

        // Crea el usuario admin obligatorio usando firstOrCreate 
        User::firstOrCreate(
            ['email' => 'admin@uatf.bo'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'), // password por defecto
            ]
        );
    }
}