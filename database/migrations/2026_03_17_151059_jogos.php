<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudio_id')->constrained('estudios_table')->onDelete('cascade');//apaga o jogo se apagar o estudio
            $table->string('nome_do_jogo');
            $table->string('imagem_capa')->nullable();
            $table->date('data_lancamento')->nullable();
            $table->string('plataforma')->nullable();
            $table->string('genero')->nullable();
            $table->integer('pegi')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};
