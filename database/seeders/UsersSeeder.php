<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Ricardo Gonçalves',
            'password' => bcrypt('PasseMuitoSegura10'),
            'username' => 'Rictrix',
            'email' => 'ricardocerqueiragoncalves10@gmail.com',
            'phone_number' => '987654321',
            'address' => 'Ponte de Lima',
        ]);
    }
}

