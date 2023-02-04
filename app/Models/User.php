<?php

namespace App\Models;

use App\Models\Contrato;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Date\Date;
use Uuid;

class User extends Authenticatable
{
    use Notifiable;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_hash = (string) Uuid::generate(4);
        });
    }

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'convenio_id',
        'padre_id',
        'salesgroup_id',
        'username',
        'password',
        'role',
        'manager',
        'created',
        'modified',
        'nombre',
        'apellidos',
        'referido_empresa',
        'RFC',
        'numero_de_empleado',
        'direccion',
        'direccion2',
        'ciudad',
        'pais',
        'telefono',
        'confirmado',
        'provincia',
        'user_hash',
        'usuario_comprador',
        'cumpleanos',
        'codigo_postal',
        'historico',
        'telefono_oficina',
        'telefono_casa',
        'via_contacto_preferida',
        'payment_id',
        'importado',
        'disponible',
        'permitir_login',
        'entrada_1',
        'entrada_2',
        'salida_1',
        'salida_2',
        'lu',
        'ma',
        'mi',
        'ju',
        'vi',
        'sa',
        'do',
        'vetarifah',
        'autreservas',
        'actividades',
        'concurso_dwn',
        'supervisor_convenios',
        'invitaciones',
        'estancia_paise_id',
        'carrera',
        'semestre_grado',
        'tipo_universitario',
        'como_se_entero',
        'consulta_ventas',
        // 'clave',
        'autorizo',
        'alerta_enviada',
        'redes_sociales',
        'system_register',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'clave', 'pass_hash',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->pass_hash;
    }

    // public function getAuthEmail()
    // {
    //     return $this->username;
    // }

    public function diffForhumans()
    {
        return Carbon::create($this->created)->diffForHumans();
    }

    public function creado()
    {
        return new Date($this->created);
    }

    //Convertir el atributo password a encriptacion de laravel
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

    public function getDireccionCompletaAttribute()
    {
        return $this->direccion . ', ' . 'CP: ' . $this->codigo_postal . ', ' . $this->ciudad . ', ' . $this->provincia;
    }
    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    /**
     * Quien fue el usuario que registro
     */
    public function padre()
    {
        return $this->belongsTo(Padre::class);
    }

    public function admin_padre()
    {
        // return $this->belongsTo(Padre::class, 'user_id');
        return $this->hasOne(Padre::class, 'user_id', 'id');
    }

    public function registrante()
    {
        return $this->belongsTo(Padre::class);
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class);
    }

    public function tarjetas()
    {
        return $this->hasMany(Tarjeta::class);
    }

    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Salesgroup::class, 'salesgroup_id', 'id');
    }

    public function empresas()
    {
        return $this->hasMany(Concal::class);
    }

    public function convenios()
    {
        return $this->hasMany(Convenio::class);
    }

    public function intentos()
    {
        return $this->hasMany(IntentoCompra::class, 'user_id');
    }

    public function getPerfilAttribute()
    {
        switch ($this->role) {
            case 'admin':
                $rol = 'Administrador';
                break;
            case 'collector':
                $rol = 'Cobranza';
                break;
            case 'control':
                $rol = 'Control';
                break;
            case 'conveniant':
                $rol = 'Conveniador';
                break;
            case 'quality':
                $rol = 'Calidad';
                break;
            case 'recepcionist':
                $rol = 'Recepcionista';
                break;
            case 'reserver':
                $rol = 'Reservaciones';
                break;
            case 'sales':
                $rol = 'Ejecutivo';
                break;
            case 'supervisor':
                $rol = 'Supervisor';
                break;

            default:
                $rol = 'Cliente';
                break;
        }

        return $rol;
    }

    public function getLoginAttribute()
    {
        if ($this->permitir_login == 1) {
            $res = __('messages.activo');
        } else {
            $res = __('messages.inactivo');
        }
        return $res;
    }

    /**
     * Equipo de ventas informacion
     */
    public function mis_clientes()
    {
        return $this->where(['padre_id' => $this->admin_padre->id, 'role' => 'client'])->count();
    }

    public function mis_contratos()
    {
        return Contrato::where(['padre_id' => $this->admin_padre->id])->whereIn('estatus', ['comprado', 'viajado', 'pagado'])->count();
    }

    public function comisiones_pagables()
    {
        return Comision::where(['user_id' => $this->id, 'pagable' => true])->sum('cantidad');

    }
    public function comisiones_generadas()
    {
        return Comision::where(['user_id' => $this->id])->sum('cantidad');
    }
}
