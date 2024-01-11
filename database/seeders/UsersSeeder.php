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
            'password' => 'PasseMuitoSegura10@',
            'username' => 'Rictrix',
            'email' => 'ricardocerqueiragoncalves10@gmail.com',
            'phone_number' => '987654321',
            'address' => 'Ponte de Lima',
            'user_type' => 'Admin'
        ]);

        User::create([
            'name' => 'Gonçalo Fonte',
            'password' => 'ZefaCarquej@28',
            'username' => 'Fonte',
            'email' => 'goncalofonte28@gmail.com',
            'phone_number' => '984512789',
            'address' => 'Outeiro',
            'user_type' => 'Admin'
        ]);
    }
}

