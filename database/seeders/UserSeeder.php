<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Professor Oak (Admin)',
                'email' => 'admin@pokemon.com',
                'password' => Hash::make('password123'), // O Hash::make encripta a palavra-passe
                'tipo' => 1, // 1 = Administrador
            ],
            [
                'name' => 'Ash Ketchum',
                'email' => 'ash@pokemon.com',
                'password' => Hash::make('password123'),
                'tipo' => 0, // 0 = Utilizador normal
            ]
        ]);
    }
}
