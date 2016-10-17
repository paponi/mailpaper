<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMovimento extends Model
{

    protected $table = 'tipomovimento';
    protected $fillable = [
        'descricao',
        'inserido_por',
        'alterado_por',
    ];


    public function movimento()
    {
        return $this->hasMany('App\Movimento');
    }
}
