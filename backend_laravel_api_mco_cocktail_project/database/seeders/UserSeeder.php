<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $users = [
            [
                'username' => 'mco',
                'password' => 'mco',
                'name' => 'Iván de Monserrat Navarro',
                'address' => 'Calle Libertad 2',
                'phone' => '658231512',
                'email' => 'ivandmn1@gmail.com',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'mco2',
                'password' => 'mco2',
                'name' => 'Jose Pérez',
                'address' => 'Calle Libertadores 2',
                'phone' => '658231512',
                'email' => 'qeweqwesa@gmail.com',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
        ];
    
        foreach ($users as $user) {
            User::factory()->create($user);
        }
        // User::factory(20)->create();
    }
}
