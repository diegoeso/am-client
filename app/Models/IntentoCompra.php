<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntentoCompra extends Model
{
    use HasFactory;
    protected $table    = 'intento_compra';
    protected $fillable = [
        'user_id',
        'estancia_id',
        'convenio_id',
        'fecha',
        'estatus',
        'intento',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class);
    }

}
