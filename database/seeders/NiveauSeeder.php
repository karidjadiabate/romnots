<?php

namespace Database\Seeders;

use App\Models\Niveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Niveau::create([
            'code' => 'BTS1',
            'nomniveau' => 'Brevet de Technicien Supérieur 1',
        ]);

        Niveau::create([
            'code' => 'BTS2',
            'nomniveau' => 'Brevet de Technicien Supérieur 2',
        ]);

        Niveau::create([
            'code' => 'L1',
            'nomniveau' => 'Licence 1',
        ]);

        Niveau::create([
            'code' => 'L2',
            'nomniveau' => 'Licence 2',
        ]);

        Niveau::create([
            'code' => 'L3',
            'nomniveau' => 'Licence 3',
        ]);

        Niveau::create([
            'code' => 'M1',
            'nomniveau' => 'Master 1',
        ]);

        Niveau::create([
            'code' => 'M2',
            'nomniveau' => 'Master 2',
        ]);

        Niveau::create([
            'code' => 'Dr',
            'nomniveau' => 'Doctorat',
        ]);
    }
}
