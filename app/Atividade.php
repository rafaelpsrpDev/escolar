<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $fillable = [
        'nome',
        'valor',
        'curso_id'
    ];

    protected $table = 'atividades';

    public function cursos() {
        return $this->belongsToMany(Curso::class);
    }
}
