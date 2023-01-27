<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    protected $table    = 'actividades';
    public $timestamps  = false;
    protected $fillable = [
        'user_id',
        'title',
        'notas',
        'created',
        'modified',
    ];
}
