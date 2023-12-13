<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Priority;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::create([
            'name' => 'Pouco Urgente',
        ]);

        Priority::create([
            'name' => 'Urgente',
        ]);

        Priority::create([
            'name' => 'Muito Urgente',
        ]);
    }
}
