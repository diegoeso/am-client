<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{

    protected $table = 'tarjetas';

    protected $fillable = [
        'user_id',
        'banco_id',
        'name',
        'banco',
        'numero',
        'mes',
        'ano',
        'cvv2',
        'estatus',
        'historico_de_pagos',
        'tipo',
        'created',
        'importado',
        'padre_id',
        'tipocuenta',
        'autorizo',
        'agreeterms',
        'firstpaymentdeducted',
        'payment_id',
    ];

    public $timestamps = false;

    public function getVenceAttribute()
    {

        if ($this->mes < 10) {
            $mes = '0' . $this->mes . '/' . $this->ano;
        } else {
            $mes = $this->mes . '/' . $this->ano;
        }

        return $mes;
    }
    public function getNumeroTarjetaAttribute()
    {
        return '****-****-****-*' . substr($this->numero, -3);
        // $unlock = session('unlock_cards');

        // if ($unlock == true) {
        //     $tarjeta = $this->numero;
        // } else {
        //     $tarjeta = '****-****-****-*' . substr($this->numero, -3);
        // }

    }

    public function unlockCard()
    {
        $unlock = session('unlock_cards');

        if ($unlock == false) {
            $tarjeta = '****-****-****-*' . substr($this->numero, -3);
        } else {
            $tarjeta = $this->numero;
        }

        return $tarjeta;
        // return '****-****-****-*' . substr($this->numero, -3);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'contrato_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'tarjeta_id');
    }

    public function r_banco()
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }
}
