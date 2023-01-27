<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoPostal extends Model
{
    protected $connection = 'hometravel';

    protected $table = 'codigos_postales';
}
