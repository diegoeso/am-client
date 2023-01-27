<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salesgroup extends Model
{
    protected $table   = 'salesgroups';
    public $timestamps = false;

    public function ejecutivo()
    {
        return $this->hasMany(User::class);
    }
}
