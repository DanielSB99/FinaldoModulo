<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('estudios_table')->insert([
            [
                'nome_do_estudio' => 'Game Freak',
                'descricao' => 'Os criadores originais e principais da franquia Pokémon. Responsáveis por todos os jogos da série principal.',
                'ano_fundacao' => 1989,

            ],
            [
                'nome_do_estudio' => 'Niantic',
                'descricao' => 'Especialistas em realidade aumentada, responsáveis pelo fenómeno mundial Pokémon GO.',
                'ano_fundacao' => 2010,

            ],
            [
                'nome_do_estudio' => 'ILCA',
                'descricao' => 'Desenvolvedores responsáveis pelos remakes Pokémon Brilliant Diamond e Shining Pearl.',
                'ano_fundacao' => 2010,

            ],
            [
                'nome_do_estudio' => 'Spike Chunsoft',
                'descricao' => 'Criadores da famosa e adorada série spin-off Pokémon Mystery Dungeon.',
                'ano_fundacao' => 1984,

            ]
        ]);
    }
}
