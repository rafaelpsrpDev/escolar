<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'curso_id'
    ];

    protected $table = 'usuarios';

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

}
