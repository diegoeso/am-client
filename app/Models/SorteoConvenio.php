<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SorteoConvenio extends Model
{
    protected $table   = 'concursoconvenios';
    public $timestamps = false;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_completo',
        'apellidos',
        'email',
        'empresa',
        'telefono_casa',
        'telefono_oficina',
        'telefono_celular',
        'puesto',
        'publicidad',
        'numero_empleado',
        'campus',
        'departamento',
        'turno',
        'padre_id',
        'terminos',
        'folioNo',
        'verification',
        'created',
        'modified',
    ];
}
