<?php

namespace App\Models;

use App\Pago;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Contrato extends Model
{
    public function __construct()
    {
        setlocale(LC_ALL, 'es_ES');
    }
    protected $table   = 'contratos';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'convenio_id',
        'invitacion_id',
        'estancia_id',
        'tarjeta_id',
        'paquete',
        'estatus',
        'precio_de_compra',
        'pago_con_nomina',
        'pago_con_otras_tarjetas',
        'estatus_de_pagos',
        'padre_id',
        'noches',
        'adultos',
        'ninos',
        'juniors',
        'divisa',
        'created',
        'modified',
        'edad_max_ninos',
        'edad_max_juniors',
        'sys_key',
        'layout_processed',
        'via_serfin',
        'estatus_comisiones',
        'comisiones_actualizadas',
        'reservacion_en_proceso',
        'importado',
        'log',
        'pagos_log',
        'tipo_llamada',
        'usd_mxp',
        'autorizo',
        'agreeterms',
        'numero_de_empleado',
        'alerta_user_enviada',
        'alerta_compra',
        'alerta_compra_fecha',
        'alerta_compra_enviada_a',
        'fecha_primer_segmento',
        'fecha_primer_descuento_contrato',
        'pagos',
        'cantidad_pagos_hechos',
        'destino_hotel_id',
        'fecha_viaje',
        'motivo_cancelacion',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estancia()
    {
        return $this->belongsTo(Estancia::class, 'estancia_id');
    }

    public function padre()
    {
        return $this->belongsTo(Padre::class);
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'convenio_id');
    }

    public function pagos_contrato()
    {
        return $this->hasMany(Pago::class, 'contrato_id', 'id')->where('cantidad', '!=', 0)->orderBy('segmento', 'ASC');
    }

    public function tarjeta()
    {
        return $this->belongsTo(Tarjeta::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'contrato_id', 'id');
    }

    // public function reservacion()
    // {
    //     return $this->belongsToMany(Reservacion::class, 'contratos_reservaciones', 'reservacione_id', 'id');
    //     // return $this->belongsToMany(Reservacion::class, 'contratos_reservaciones', 'contrato_id');
    // }

    public function reservacion()
    {
        return $this->hasMany(ContratosReservaciones::class, 'contrato_id');
    }

    // public function p_reservacion()
    // {
    //     return $this->belongsTo(ContratosReservaciones::class, 'contrato_id');
    // }
    //
    //
    public function r_reservacion()
    {
        return $this->belongsToMany(Reservacion::class, 'contratos_reservaciones', 'contrato_id', 'reservacione_id');
    }

    public function comision()
    {
        return $this->hasOne(Comision::class);
    }

    public function metodoPago()
    {
        if ($this->via_serfin == 1) {
            $metodo = 'Tarjeta credito/debito';
        } else if ($this->pago_con_nomina == 1) {
            $metodo = 'Nomina';
        } else if ($this->pago_con_nomina == 0 && $this->via_serfin == 0) {
            $metodo = 'Corbros por terminal';
        } else {
            $metodo = 'Sin definir';
        }

        return $metodo;
    }

    public function diffForhumans()
    {
        return Carbon::create($this->created)->diffForHumans();
    }

    public function creado()
    {
        return new Date($this->created);
    }

    public function tipo_plan()
    {
        $cadena  = strpos($this->estancia->title, 'EUROPEO');
        $cadena2 = strpos($this->estancia->title, 'TODO INCLUIDO');
        if ($cadena) {
            $res = 'EUROPEO';
        } else if ($cadena2) {
            $res = 'TODO INCLUIDO';
        } else {
            $res = '';
        }

        return $res;

    }

    public function tipo_temporada()
    {
        $cadena = strpos($this->estancia->title, 'ALTA');
        if ($cadena) {
            $res = 'ALTA'; /* 60 */
        } else if (strpos($this->estancia->title, 'BAJA')) {
            $res = 'BAJA'; /* 30 */
        } else {
            $res = "MEDIA"; /* 60 */
        }
        return $res;
    }

    public function color_estatus()
    {
        switch ($this->estatus) {
            case 'suspendido':
                $color = '#5C5C5C';
                break;
            case 'sin_aprobar':
                $color = '#53007D';
                break;
            case 'por_autorizar':
                $color = '#F59B00';
                break;
            case 'nuevo':
                $color = '#165e6c';
                break;
            case 'por_cancelar':
                $color = '#dc3545';
                break;
            case 'cancelado':
                $color = '#8E0000';
                break;
            case 'Tarjeta con problemas':
                $color = '#fd7e14';
                break;
            case 'viajado':
                $color = '#000';
                break;
            default:
                $color = '#007bff';
                break;
        }
        return $color;
    }

    public function pagos_concretados()
    {
        $pagos_concretados = Pago::where('contrato_id', $this->id)->where('estatus', 'Pagado')->count();
        return $pagos_concretados;
    }

    public function num_segmentos()
    {
        $num_segmentos = Pago::where('contrato_id', $this->id)->where('segmento', '!=', '0')->count();
        return $num_segmentos;
    }

    public function sum_pagos_concretados()
    {
        $pagos_concretados = Pago::where('contrato_id', $this->id)->where('estatus', 'Pagado')->sum('cantidad');
        return $pagos_concretados;
    }

    public function fecha_primer_descuento()
    {
        $pago = Pago::where(['contrato_id' => $this->id, 'segmento' => 1])->first();
        if ($pago) {
            $date = $pago->fecha_de_cobro;
        } else {
            $date = false;
        }

        return $date;
    }

    public function getLogContratoAttribute()
    {
        if ($this->log != null) {
            return Markdown::convertToHtml($this->log); // <p>foo</p>
        } else {
            return '';
        }
    }

    public function metodo_de_pago()
    {
        if ($this->pago_con_nomina == 1 && $this->via_serfin == 0) {
            $metodo = 'nomina';
        } elseif ($this->pago_con_nomina == 0 && $this->via_serfin == 0) {
            $metodo = 'terminal';
        } elseif ($this->pago_con_nomina == 0 && $this->via_serfin == 1) {
            $metodo = 'serfin';
        }

        return $metodo;
    }

    public function metodo_de_pago_show()
    {
        if ($this->pago_con_nomina == 1 && $this->via_serfin == 0) {
            $metodo = 'Descuento por nomina';
        } elseif ($this->pago_con_nomina == 0 && $this->via_serfin == 0) {
            $metodo = 'Descuento por terminal';
        } elseif ($this->pago_con_nomina == 0 && $this->via_serfin == 1) {
            $metodo = 'Tarjeta / Banca electrónica';
        } else {
            $metodo = 'Sin definir';
        }

        return $metodo;
    }

    public function getComoSeEnteroAttribute()
    {
        if (isset($this->cliente)) {

            switch ($this->cliente->como_se_entero) {
                case '3':
                    $label = 'Búsqueda WEb';
                    break;
                case '4':
                    $label = 'Flyer promocional';
                    break;
                case '5':
                    $label = 'Recomendación';
                    break;
                case '6':
                    $label = 'Otros';
                    break;
                case '7':
                    $label = 'Llamada telemarketing';
                    break;
                case '8':
                    $label = 'Venta directa';
                    break;
                case '10':
                    $label = 'Gopacific';
                    break;
                case '11':
                    $label = 'Transporte publico';
                    break;
                case '12':
                    $label = 'IMSS - CLM';
                    break;
                case '13':
                    $label = 'Redes Sociales';
                    break;

                default:
                    $label = 'S/R';
                    break;
            }

        } else {
            $label = 'S/R';
        }
        return $label;
    }
}
