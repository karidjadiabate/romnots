<?php

namespace Database\Seeders;

use App\Models\TypeSujet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSujetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeSujet::create([
            'libtypesujet' => 'Devoir',
        ]);

        TypeSujet::create([
            'libtypesujet' => 'Examen',
        ]);

        TypeSujet::create([
            'libtypesujet' => 'Interrogation',
        ]);

        TypeSujet::create([
            'libtypesujet' => 'Test',
        ]);
    }
}
