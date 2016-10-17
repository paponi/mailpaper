<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    protected $table = 'movimento';
    //public $timestamps = false;

    protected $fillable = [
        'correio_id',
        'tipomovimento_id',
        'observacoes',
        'colaborador_origem',
        'servico_origem',
        'colaborador_destino',
        'servico_destino',
        'recebido_por',
        'inserido_por',
        'alterado_por',
        'lido',
    ];

    public function tipomovimento()
    {
        return $this->belongsTo('App\TipoMovimento');
    }

    public function utilizador()
    {
        return $this->belongsTo('App\User');
    }

    public function correio()
    {
        return $this->belongsTo('App\Correio');
    }

}
