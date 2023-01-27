<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table   = 'comisiones';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'contrato_id',
        'cantidad',
        'pagable',
        'pagado',
        'concepto',
        'convenio_id',
        'cliente_nombre',
        'cliente_username',
        'motivo_rechazo',
        'estatus',
        'created',
        'modified',
        'campana_inicio',
        'campana_fin',
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
