<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

    protected $fillable = [
        'name', 'email', 'password','nrmecanografico','admin'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function movimentos()
    {
        return $this->hasMany('App\Movimento');
    }

    public function utilizadorservicos(){
        return $this->hasMany('App\UtilizadorServicos');
    }

    public function movimento()
    {
        return $this->belongsTo('App\Movimento');
    }


    public function tipomovimentos()
    {
        return $this->hasMany('App\TipoMovimento');
    }

    public function unreadMail()
    {
        return Movimento::where('colaborador_destino', $this->id)->where('lido', 1)->get();
    }

}
