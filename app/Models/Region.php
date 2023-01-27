<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table   = 'regiones';
    public $timestamps = false;

    protected $fillable = [
        'paise_id',
        'title',
        'created',
        'modified',
    ];

    public function r_pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class, 'id', 'regione_id');
    }

    public function reservacion()
    {
        return $this->hasOne(Reservacion::class);
    }
}
