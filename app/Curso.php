<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nome',
        'setor',
        'duracao'
    ];

    protected $table = 'cursos';

    public function client() {
        return $this->hasOne(Client::class);
    }

    public function atividade() {
        return $this->hasMany(Atividade::class);
    }

}
