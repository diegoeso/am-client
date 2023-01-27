<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class ContratosReservaciones extends Model
{
    protected $table   = 'contratos_reservaciones';
    public $timestamps = false;

    public function r_contratos()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'id');
    }

    public function r_reservacion()
    {
        return $this->belongsTo(Reservacion::class, 'reservacione_id', 'id');
    }

    public function creado()
    {
        return new Date($this->created);
    }
    //

    // public function reservacion()
    // {
    //     return $this->belongsTo(Reservacion::class);
    // }

    // public function contratos()
    // {
    //     return $this->hasMany(Contrato::class);
    // }
}
