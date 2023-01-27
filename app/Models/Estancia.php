<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    protected $fillable = [

    ];
    protected $table   = 'estancias';
    public $timestamps = false;

    public function contrato()
    {
        return $this->hasMany(Contrato::class);
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class);
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }

    public function reservaciones()
    {
        return $this->hasMany(Comment::class, 'estancia_id', 'id');
    }
}
