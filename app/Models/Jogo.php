<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jogo extends Model
{
    protected $fillable = [
        'estudio_id',
        'nome_do_jogo',
        'imagem_capa',
        'data_lancamento',
        'plataforma',
        'genero',
        'pegi'
    ];

    public function estudio(): BelongsTo
    {
        return $this->belongsTo(Estudio::class, 'estudio_id');
    }
}
