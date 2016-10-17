<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtilizadorServicos extends Model
{
    protected $fillable = [
        'id_utilizador',
        'id_servico',
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function servico()
    {
        return $this->hasMany('App\Servico');
    }
}
