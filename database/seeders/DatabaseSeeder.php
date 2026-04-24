<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // El orden es crítico por las llaves foráneas [cite: 102, 103]
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            NoteSeeder::class,
        ]);
    }
}