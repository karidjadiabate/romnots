<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'nomrole' => 'Etudiant',
        ]);

        Role::create([
            'nomrole' => 'Professeur',
        ]);

        Role::create([
            'nomrole' => 'Surveillant',
        ]);

        Role::create([
            'nomrole' => 'Correcteur',
        ]);

        Role::create([
            'nomrole' => 'Admin',
        ]);

        Role::create([
            'nomrole' => 'SuperAdmin',
        ]);
    }
}
