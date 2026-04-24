<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $admin = User::where('email', 'admin@uatf.bo')->first();

        // Crear 15 notas distribuidas entre categorías [cite: 99]
        Note::factory(15)->create()->each(function ($note) use ($users, $admin) {
            
            // 1. Asignar al admin como 'owner' en la tabla pivote [cite: 100, 105]
            $note->users()->attach($admin->id, ['role' => 'owner']);

            // 2. Compartir con 1 o 2 usuarios aleatorios (que no sean el admin) [cite: 100]
            $colaboradores = $users->where('id', '!=', $admin->id)->random(rand(1, 2));

            foreach ($colaboradores as $user) {
                $note->users()->attach($user->id, [
                    'role' => fake()->randomElement(['editor', 'viewer']) // [cite: 100]
                ]);
            }
        });
    }
}