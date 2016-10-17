<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correio extends Model
{
    protected $fillable = [
        'assunto',
        'observacoes',
        'inserido_por'
    ];

    public function movimentos()
    {
        return $this->hasMany('App\Movimento');
    }


    public function allMail()
    {
        return Movimento::all();
    }

}
