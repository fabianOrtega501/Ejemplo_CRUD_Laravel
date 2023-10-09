<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\curso;
use App\Models\estudiante;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        estudiante::factory()->times(15)->create();
        curso::factory()->times(8)->create()->each(
            function($curso){
                $curso->estudiantes()->sync(
                    estudiante::all()->random(3)
                );
            }
        );
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
