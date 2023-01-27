<?php

namespace App\Models;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table    = 'pagos';
    public $timestamps  = false;
    protected $fillable = [
        'contrato_id',
        'tarjeta_id',
        'segmento',
        'estatus',
        'cantidad',
        'fecha_de_cobro',
        'fecha_de_pago',
        'cobrador',
        'notas',
        'manual',
        'concepto',
        'bloqueo_via_serfin',
        'via_serfin_exported',
        'collector_added',
        'created_by',
        'importado',
        'pagado_desde_santander',
        'modified',
    ];

    // public function contrato()
    // {
    //     return $this->belongsTo(Contrato::class);
    // }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function tarjeta()
    {
        return $this->belongsTo(Tarjeta::class);
    }

    public function historial()
    {
        return $this->hasMany(Serfinrespuestas::class);
    }

    public function historial_desc()
    {
        return $this->hasMany(Serfinrespuestas::class)->orderBy('id', 'DESC')->limit(1);
    }

    public function historial_limit()
    {
        return $this->hasMany(Serfinrespuestas::class)->orderBy('id', 'DESC')->limit(3);
    }

    public function log()
    {
        return $this->hasOne(PagoLog::class, 'pago_id');
    }

    public function getLogPagoAttribute()
    {
        if ($this->log != null) {
            return Markdown::convertToHtml($this->log->notas); // <p>foo</p>
        } else {
            return '';
        }
    }

    public function total_pagos($tipo)
    {
        switch ($tipo) {
            case 'pagados':
                $total = $this->where('id', $this->id)->where('estatus', 'Pagado')->sum('cantidad');
                break;
            case 'rechazados':
                $total = $this->where('id', $this->id)->where('estatus', 'Rechazado')->sum('cantidad');
                break;

            case 'por_pagar':
                $total = $this->where('id', $this->id)->where('estatus', 'Por Pagar')->sum('cantidad');
                break;
        }

        return $total;
    }

    public function total_pagos_contrato($contrato_id, $tipo)
    {
        switch ($tipo) {
            case 'pagados':
                $total = $this->where('contrato_id', $contrato_id)->where('estatus', 'Pagado')->sum('cantidad');
                break;
            case 'rechazados':
                $total = $this->where('contrato_id', $contrato_id)->where('estatus', 'Rechazado')->sum('cantidad');
                break;

            case 'por_pagar':
                $total = $this->where('contrato_id', $contrato_id)->where('estatus', 'Por Pagar')->sum('cantidad');
                break;

            default:
                $total = '';
                break;
        }

        return $total;
    }

}
