<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serfinrespuestas extends Model
{
    protected $table   = 'serfinrespuestas';
    public $timestamps = false;

    protected $fillable = [
        'contrato_id',
        'pago_id',
        'resultado',
        'cantidad',
        'created',
        'fecha_de_respuesta',
        'motivo_del_rechazo',
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }
}
