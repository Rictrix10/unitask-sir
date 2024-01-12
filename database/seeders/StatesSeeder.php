<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        State::create([
            'name' => 'Para fazer',
        ]);

        State::create([
            'name' => 'Em andamento',
        ]);

        State::create([
            'name' => 'A aguardar',
        ]);

        State::create([
            'name' => 'Concluída',
        ]);

        State::create([
            'name' => 'Cancelada',
        ]);
    }
}
