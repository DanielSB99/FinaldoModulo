<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estudio extends Model
{
    protected $table = 'estudios_table';

    protected $fillable = [
        'nome_do_estudio',
        'logotipo',
        'descricao',
        'ano_fundacao',
    ];

    public function jogos(): HasMany
    {
        return $this->hasMany(Jogo::class, 'estudio_id');
    }
}
