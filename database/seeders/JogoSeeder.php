<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gameFreakId = DB::table('estudios_table')->where('nome_do_estudio', 'Game Freak')->value('id');
        $nianticId = DB::table('estudios_table')->where('nome_do_estudio', 'Niantic')->value('id');
        $ilcaId = DB::table('estudios_table')->where('nome_do_estudio', 'ILCA')->value('id');
        $spikeId = DB::table('estudios_table')->where('nome_do_estudio', 'Spike Chunsoft')->value('id');

        
        DB::table('jogos')->insert([
            // Jogos da Game Freak
            [
                'estudio_id' => $gameFreakId,
                'nome_do_jogo' => 'Pokémon Emerald',
                'data_lancamento' => '2004-09-16',
                'plataforma' => 'Game Boy Advance',
                'genero' => 'RPG',
                'pegi' => 3,
            ],
            [
                'estudio_id' => $gameFreakId,
                'nome_do_jogo' => 'Pokémon Scarlet & Violet',
                'data_lancamento' => '2022-11-18',
                'plataforma' => 'Nintendo Switch',
                'genero' => 'RPG',
                'pegi' => 7,
            ],
            // Jogos da Niantic
            [
                'estudio_id' => $nianticId,
                'nome_do_jogo' => 'Pokémon GO',
                'data_lancamento' => '2016-07-06',
                'plataforma' => 'Mobile (iOS / Android)',
                'genero' => 'Realidade Aumentada',
                'pegi' => 3,
            ],
            // Jogos da ILCA
            [
                'estudio_id' => $ilcaId,
                'nome_do_jogo' => 'Pokémon Brilliant Diamond',
                'data_lancamento' => '2021-11-19',
                'plataforma' => 'Nintendo Switch',
                'genero' => 'RPG',
                'pegi' => 7,
            ],
            // Jogos da Spike Chunsoft
            [
                'estudio_id' => $spikeId,
                'nome_do_jogo' => 'Pokémon Mystery Dungeon: Rescue Team DX',
                'data_lancamento' => '2020-03-06',
                'plataforma' => 'Nintendo Switch',
                'genero' => 'Roguelike',
                'pegi' => 7,
            ]
        ]);
    }
}
