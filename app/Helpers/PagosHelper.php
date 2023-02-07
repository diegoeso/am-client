<?php

namespace App\Helpers;

use App\Models\Contrato;
use App\Models\Estancia;
use App\Models\Pago;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class PagosHelper
{
    public $pagos_por_contrato = 24;

    /**
     * Listado de pagos por contrato
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-08-29
     * @param  int $contrato_id
     * @return objeto Datatable
     */
    public function get_pagos_contrato($contrato_id = null)
    {
        $pagos = Pago::where('contrato_id', $contrato_id)
            ->where('cantidad', '!=', 0.00)
            ->get();

        return Datatables::of($pagos)
            ->editColumn('cantidad', function ($pagos) {
                return '$' . number_format($pagos->cantidad, 2) . ' ' . $pagos->contrato->divisa;
            })
            ->setRowClass(function ($pagos) {
                switch ($pagos->estatus) {
                    case 'Por Pagar':
                        $class = 'alert-warning';
                        break;
                    case 'Pagado':
                        $class = 'alert-info';
                        break;
                    default:
                        $class = 'alert-danger';
                        break;
                }
                return $class;
            })
            ->make(true);
    }

    /**
     * Seleccionador del metodo de calcular los pagos
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-09-16
     * @param  int $contrato_id
     * @param  string $tipo
     * @param  date $fecha_de_inicio
     * @param  date $diaX
     * @param  date $diaY
     * @return array $pagos
     */
    public function calcular_pagos($contrato_id, $tipo, $fecha_de_inicio, $num_segmentos = null, $diaX = null, $diaY = null)
    {

        // var_dump($contrato_id, $tipo, $fecha_de_inicio, $num_segmentos, $diaX, $diaY);
        $pagos_por_contrato = $num_segmentos;
        $contratoData       = Contrato::findOrFail($contrato_id);

        // if (!empty($contratoData->estancia->cuotas)) {
        //     $pagos_por_contrato = $contratoData->estancia->cuotas;
        // } else {
        //     $pagos_por_contrato = $this->pagos_por_contrato;
        // }

        switch ($tipo) {
            case 'semanal':
                return $this->calcular_semanalmente($contratoData, $pagos_por_contrato, $fecha_de_inicio);
                break;

            case 'catorcenal':
                return $this->calcular_catorcenalmente($contratoData, $pagos_por_contrato, $fecha_de_inicio);
                break;

            case 'quincenal_preciso':
                return $this->calcular_quincenalmente_estricto($contratoData, $pagos_por_contrato, $fecha_de_inicio, $diaX, $diaY);
                break;

            case 'quincenal_clasico':
                return $this->calcular_quincenalmente_clasico($contratoData, $pagos_por_contrato, $fecha_de_inicio);
                break;

            case 'mensual':
                return $this->calcular_mensualmente($contratoData, $pagos_por_contrato, $fecha_de_inicio);
                break;
        }
    }

    /**
     * Calcular pagos quincenalmente cada 15 y 31 0 30 de cada mes
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-09-16
     * @param  objeto $contratoData
     * @param  int $pagos_por_contrato
     * @param  date $fecha_primer_cobro
     * @return array $pagos
     */
    public function calcular_quincenalmente_clasico($contratoData, $pagos_por_contrato, $fecha_de_inicio = null) //codigo correcto

    {

        // dd($contratoData, $pagos_por_contrato, $fecha_de_inicio);
        $loop = intval($pagos_por_contrato);

        $cantidad = ($contratoData->precio_de_compra / $pagos_por_contrato);

        $inicio_pago = Pago::where('contrato_id', $contratoData->id)->where('estatus', 'Por Pagar')->where('segmento', 1)->orderBy('id', 'ASC')->first();
        $inicio      = ($inicio_pago != null) ? $inicio_pago->segmento : 1;
        $dt          = Carbon::create($fecha_de_inicio);
        $cont        = 0;
        $pagos       = [];

        for ($i = $inicio; $i <= $loop; $i++) {
            if ($i == $inicio) {
                if ($contratoData->estancia->estancia_especial === 1 && $contratoData->num_segmentos() == 0) {
                    $pagos[] = [
                        'contrato_id'    => $contratoData->contrato_id,
                        'segmento'       => 0,
                        'estatus'        => "Por Pagar",
                        'fecha_de_cobro' => Carbon::now()->format('Y-m-d'),
                        'cantidad'       => $contratoData->estancia->enganche_especial,
                    ];

                    /*
                    Old
                     */
                    // $pagos[] = [
                    //     'contrato_id'    => $contratoData->contrato_id,
                    //     'segmento'       => $i,
                    //     'estatus'        => "Por Pagar",
                    //     'fecha_de_cobro' => Carbon::now()->format('Y-m-d'),
                    //     'cantidad'       => $contratoData->estancia->enganche_especial,
                    // ];
                    // $i++;
                }
                $fecha   = $dt->format('Y-m-d');
                $pagos[] = [
                    'contrato_id'    => $contratoData->id,
                    'segmento'       => $i,
                    'estatus'        => "Por Pagar",
                    'fecha_de_cobro' => $fecha,
                    'cantidad'       => $cantidad,
                ];

                if ($dt->format('d') >= 18 && $dt->format('d') <= 31) {
                    $dt   = $dt->addDay(14);
                    $cont = 1;
                } else if ($dt->format('d') >= 4 && $dt->format('d') <= 13) {
                    $dt   = $dt->addDay(14);
                    $cont = 2;
                } else if ($dt->format('d') >= 17) {
                    $cont = 2;
                } else if ($dt->format('d') <= 14) {
                    $cont = 1;
                }
                $i++;
            }

            if ($cont == 1) {
                $fecha = $dt->startOfMonth()->add(14, 'days')->format('Y-m-d');
                $cont  = 2;
            } else {
                $fecha = $dt->endOfMonth()->format('Y-m-d');
                $cont  = 1;
            }

            if ($dt->format('d') >= 30 || $dt->format('d') <= 31) {
                $dt = $dt->addDay(2);
            } else {
                $dt = $dt->addMonth();
            }

            $pagos[] = [
                'contrato_id'    => $contratoData->id,
                'segmento'       => $i,
                'estatus'        => "Por Pagar",
                'fecha_de_cobro' => $fecha,
                'cantidad'       => $cantidad,
            ];
        }
        return $pagos;
    }

    /**
     * Calcular pagos semanales seleccionando un dia el cual se le cobrara
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-09-16
     * @param  objeto $contratoData
     * @param  int $pagos_por_contrato
     * @param  date $fecha_de_inicio
     * @return array $pagos
     */
    public function calcular_semanalmente($contratoData, $pagos_por_contrato, $fecha_de_inicio) //codigo correcto

    {
        $loop     = intval($pagos_por_contrato);
        $cantidad = ($contratoData->precio_de_compra / $pagos_por_contrato);

        $inicio_pago     = Pago::where('contrato_id', $contratoData->id)->where('estatus', 'Por Pagar')->where('segmento', 1)->orderBy('id', 'ASC')->first();
        $inicio          = ($inicio_pago != null) ? $inicio_pago->segmento : 1;
        $fecha_de_inicio = Carbon::create($fecha_de_inicio);
        $cont            = 0;
        $pagos           = [];

        for ($i = $inicio; $i <= $loop; $i++) {
            if ($i == $inicio) {
                if ($contratoData->estancia->estancia_especial === 1 && $contratoData->num_segmentos() == 0) {
                    $pagos[] = [
                        'contrato_id'    => $contratoData->contrato_id,
                        'segmento'       => 0,
                        'estatus'        => "Por Pagar",
                        'fecha_de_cobro' => Carbon::now()->format('Y-m-d'),
                        'cantidad'       => $contratoData->estancia->enganche_especial,
                    ];
                }
                $fecha   = $fecha_de_inicio->format('Y-m-d');
                $pagos[] = [
                    'contrato_id'    => $contratoData->id,
                    'segmento'       => $i,
                    'estatus'        => "Por Pagar",
                    'fecha_de_cobro' => $fecha,
                    'cantidad'       => ($contratoData->precio_de_compra / $pagos_por_contrato),
                ];
                // $i++;
            } else {
                $pagos[] = [
                    'contrato_id'    => $contratoData->id,
                    'segmento'       => $i,
                    'estatus'        => "Por Pagar",
                    'fecha_de_cobro' => $fecha_de_inicio->addWeek()->format('Y-m-d'),
                    'cantidad'       => $cantidad,
                ];
            }
        }

        // dd($pagos);

        return $pagos;
    }

    /**
     * Calcular pagos catorcenales, seleccionando fecha de cobro + 14 dias continuos
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-09-16
     * @param  [objeto] $contratoData
     * @param  [int] $pagos_por_contrato
     * @param  [date] $fecha_de_inicio
     * @return [array] $pagos
     */
    public function calcular_catorcenalmente($contratoData, $pagos_por_contrato, $fecha_de_inicio) //Codigo correcto

    {
        $loop     = $pagos_por_contrato;
        $cantidad = ($contratoData->precio_de_compra / $pagos_por_contrato);

        // if ($contratoData->estancia->estancia_especial === 1) {
        //     $cantidad = (($contratoData->precio_de_compra - $contratoData->estancia->enganche_especial) / $pagos_por_contrato);
        //     $loop     = $pagos_por_contrato + 1;
        // }

        // $inicio_pago = Pago::where('contrato_id', $contratoData->id)->where('estatus', 'Por Pagar')->orderBy('id', 'ASC')->first();
        $inicio_pago = Pago::where('contrato_id', $contratoData->id)->where('estatus', 'Por Pagar')->where('segmento', 1)->orderBy('id', 'ASC')->first();

        $inicio = ($inicio_pago != null) ? $inicio_pago->segmento : 1;

        $fecha_de_inicio = Carbon::create($fecha_de_inicio);
        $cuotas          = $pagos_por_contrato;
        $pagos           = [];

        for ($i = $inicio; $i <= $loop; $i++) {
            if ($i == $inicio) {
                if ($contratoData->estancia->estancia_especial === 1 && $contratoData->num_segmentos() == 0) {
                    $pagos[] = [
                        'contrato_id'    => $contratoData->contrato_id,
                        'segmento'       => 0,
                        'estatus'        => "Por Pagar",
                        'fecha_de_cobro' => Carbon::now()->format('Y-m-d'),
                        'cantidad'       => $contratoData->estancia->enganche_especial,
                    ];
                }
                $fecha   = $fecha_de_inicio->format('Y-m-d');
                $pagos[] = [
                    'contrato_id'    => $contratoData->id,
                    'segmento'       => $i,
                    'estatus'        => "Por Pagar",
                    'fecha_de_cobro' => $fecha,
                    'cantidad'       => ($contratoData->precio_de_compra / $pagos_por_contrato),
                ];
                // $i++;
            } else {

                $pagos[] = [
                    'contrato_id'    => $contratoData->id,
                    'segmento'       => $i,
                    'estatus'        => "Por Pagar",
                    'fecha_de_cobro' => $fecha_de_inicio->addDays(14)->format('Y-m-d'),
                    'cantidad'       => ($contratoData->precio_de_compra / $cuotas),
                ];
            }
        }

        return $pagos;
    }

    /**
     * Calcular pagos mensualemente
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-09-16
     * @param  [objeto] $contratoData
     * @param  [int] $pagos_por_contrato
     * @param  [date] $fecha_de_inicio
     * @return [array] $pagos
     */
    public function calcular_mensualmente($contratoData, $pagos_por_contrato, $fecha_de_inicio) //codigo correcto

    {

        $loop     = $pagos_por_contrato;
        $cantidad = ($contratoData->precio_de_compra / $pagos_por_contrato);

        // if ($contratoData->estancia->estancia_especial === 1) {
        //     $cantidad = (($contratoData->precio_de_compra - $contratoData->estancia->enganche_especial) / $pagos_por_contrato);
        //     $loop     = $pagos_por_contrato + 1;
        // }

        // $inicio_pago = Pago::where('contrato_id', $contratoData->id)->where('estatus', 'Por Pagar')->orderBy('id', 'ASC')->first();
        $inicio_pago = Pago::where('contrato_id', $contratoData->id)->where('estatus', 'Por Pagar')->where('segmento', 1)->orderBy('id', 'ASC')->first();
        $inicio      = ($inicio_pago != null) ? $inicio_pago->segmento : 1;

        $fecha_de_inicio = Carbon::create($fecha_de_inicio);
        $cuotas          = $pagos_por_contrato;
        $pagos           = [];

        for ($i = $inicio; $i <= $pagos_por_contrato; $i++) {

            if ($i == $inicio) {

                if ($contratoData->estancia->estancia_especial === 1 && $contratoData->num_segmentos() == 0) {

                    $pagos[] = [
                        'contrato_id'    => $contratoData->contrato_id,
                        'segmento'       => 0,
                        'estatus'        => "Por Pagar",
                        'fecha_de_cobro' => Carbon::now()->format('Y-m-d'),
                        'cantidad'       => $contratoData->estancia->enganche_especial,
                    ];

                    /**
                     * Old
                     */
                    // $pagos[] = [
                    //     'contrato_id'    => $contratoData->contrato_id,
                    //     'segmento'       => $i,
                    //     'estatus'        => "Por Pagar",
                    //     'fecha_de_cobro' => Carbon::now()->format('Y-m-d'),
                    //     'cantidad'       => $contratoData->estancia->enganche_especial,
                    // ];
                    // $i++;
                }

                $fecha   = $fecha_de_inicio->format('Y-m-d');
                $pagos[] = [
                    'contrato_id'    => $contratoData->id,
                    'segmento'       => $i,
                    'estatus'        => "Por Pagar",
                    'fecha_de_cobro' => $fecha,
                    'cantidad'       => ($contratoData->precio_de_compra / $pagos_por_contrato),
                ];
                $i++;
            }
            // else {

            $pagos[] = [
                'contrato_id'    => $contratoData->id,
                'segmento'       => $i,
                'estatus'        => "Por Pagar",
                'fecha_de_cobro' => $fecha_de_inicio->addMonth()->format('Y-m-d'),
                'cantidad'       => ($contratoData->precio_de_compra / $cuotas),
            ];
            // }
        }

        return $pagos;
    }

    /**
     * Calcular pagos iniciando de la fecha inicial y calculando cada dia exactos datos por el usuario
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-09-16
     * @param  [objeto] $contratoData
     * @param  [int] $pagos_por_contrato
     * @param  [date] $fecha_de_inicio
     * @param  [date] $diax
     * @param  [date] $diay
     * @return [array] $pagos
     */
    public function calcular_quincenalmente_estricto($contratoData, $pagos_por_contrato, $fecha_de_inicio, $diax, $diay) //codigo correcto

    {

        $loop     = $pagos_por_contrato;
        $cantidad = ($contratoData->precio_de_compra / $pagos_por_contrato);

        // if ($contratoData->estancia->estancia_especial === 1) {
        //     $cantidad = (($contratoData->precio_de_compra - $contratoData->estancia->enganche_especial) / $pagos_por_contrato);
        //     $loop     = $pagos_por_contrato + 1;
        // }

        // $inicio_pago = Pago::where('contrato_id', $contratoData->id)->where('estatus', 'Por Pagar')->orderBy('id', 'ASC')->first();
        $inicio_pago = Pago::where('contrato_id', $contratoData->id)->where('estatus', 'Por Pagar')->where('segmento', 1)->orderBy('id', 'ASC')->first();
        $inicio      = ($inicio_pago != null) ? $inicio_pago->segmento : 1;

        $fecha_de_inicio = Carbon::create($fecha_de_inicio);

        $cuotas = $pagos_por_contrato;
        $pagos  = [];

        // Ordenamos los días pasados al controlador,
        // para comenzar basándonos en cuentas de meses compltos.
        $dias = array(
            0 => $diax,
            1 => $diay,
        );

        sort($dias);

        for ($i = $inicio; $i <= $loop; $i++) {

            if ($i == $inicio) {
                /*
                se crea pago de enganche en caso de que la estancia sea especial y requiera enganche
                 */
                $pagos[] = [
                    'contrato_id'    => $contratoData->contrato_id,
                    'segmento'       => 0,
                    'estatus'        => "Por Pagar",
                    'fecha_de_cobro' => Carbon::now()->format('Y-m-d'),
                    'cantidad'       => $contratoData->estancia->enganche_especial,
                ];
                /**
                 * Old
                 */
                // if ($contratoData->estancia->estancia_especial === 1) {
                //     $pagos[] = [
                //         'contrato_id'    => $contratoData->contrato_id,
                //         'segmento'       => $i,
                //         'estatus'        => "Por Pagar",
                //         'fecha_de_cobro' => Carbon::now()->format('Y-m-d'),
                //         'cantidad'       => $contratoData->estancia->enganche_especial,
                //     ];
                //     $i++;
                // }
            }

            $pagos[] = [
                'contrato_id'    => $contratoData->id,
                'segmento'       => $i,
                'estatus'        => "Por Pagar",
                'fecha_de_cobro' => $fecha_de_inicio->format('Y-m-d'),
                'cantidad'       => ($contratoData->precio_de_compra / $cuotas),
                'cuotas'         => $cuotas,
            ];

            if ($fecha_de_inicio->format('d') < $dias[0]) {
                // Si esta en cierto dia menor al primer día de cobro del mes.
                $dif = $dias[0] - $fecha_de_inicio->format('d');
                $fecha_de_inicio->addDays($dif);
            } elseif ($fecha_de_inicio->format('d') > $dias[0] && $fecha_de_inicio->format('d') < $dias[1]) {
                // Si esta en cierto dia mayor al primer día de cobro del mes
                // y
                // Si está en cierto día menor al segundo dia de cobro del mes.
                $dif = $dias[1] - $fecha_de_inicio->format('d');
                $fecha_de_inicio->addDays($dif);
            } elseif ($fecha_de_inicio->format('d') > $dias[1]) {
                // Si está en cierto día mayo al segundo dia de cobro del mes.
                // Agregamos un mes
                $fecha_de_inicio->addMonth();

                // Mandamos al dia del primer cobro del mes.
                $fecha_de_inicio->setDate($fecha_de_inicio->format('Y'), $fecha_de_inicio->format('m'), $dias[0]);
            } elseif ($fecha_de_inicio->format('d') == $dias[0]) {
                // Si la fecha de inicio coincide con la primera fecha del mes

                // Mandamos en automático a la segunda fecha del mes
                $fecha_de_inicio->setDate($fecha_de_inicio->format('Y'), $fecha_de_inicio->format('m'), $dias[1]);
            } elseif ($fecha_de_inicio->format('d') == $dias[1]) {
                // Si concide perfecto con la segunda fecha del mese

                // Mandamos al siguiente mes
                $fecha_de_inicio->addMonth();

                // Establecemos el día del primer cobro de dicho mes.
                $fecha_de_inicio->setDate($fecha_de_inicio->format('Y'), $fecha_de_inicio->format('m'), $dias[0]);
            }
        }

        return $pagos;
    }

    /**
     * Creacion del primer cobro de enganche pagina USA
     * Autor: Isw. Diego  Enrique Sanchez Ordoñez
     * Creado: 2021-09-13
     * @param  objeto $contrato
     * @return objeto $pago
     */
    public function generar_pago_engache($contrato)
    {
        $fecha = Carbon::now();

        $pago                 = new Pago;
        $pago->contrato_id    = $contrato->id;
        $pago->tarjeta_id     = $contrato->tarjeta_id;
        $pago->segmento       = '0';
        $pago->estatus        = 'Por Pagar';
        $pago->cantidad       = ($contrato->estancia->enganche_especial != null) ? $contrato->estancia->enganche_especial : env('ENGANCHE');
        $pago->fecha_de_cobro = $fecha;
        // $pago->fecha_de_pago  = $fecha;
        $pago->created_by = 'automated system converge payment';
        $pago->save();
        return $pago;
    }

    //Generar pagos USA//

    /**
     * Calcular pagos quincenalmente cada 15 y 31 0 30 de cada mes
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-09-16
     * @param  objeto $contratoData
     * @param  int $pagos_por_contrato
     * @param  date $fecha_primer_cobro
     * @return array $pagos
     */
    public function generar_pagos_quincenales($contrato_id, $pagos_por_contrato = null, $fecha_primer_cobro = null)
    {
        if ($pagos_por_contrato == null) {
            $pagos_por_contrato = 36;
        }

        // dd($pagos_por_contrato, $fecha_primer_cobro);
        $contratoData = Contrato::findOrFail($contrato_id);
        $estancia     = Estancia::findOrFail($contratoData->estancia_id);
        // $pagos_por_contrato = (isset($segmentos)) ? $segmentos : $estancia->cuotas;

        if (!empty($fecha_primer_cobro) || isset($fecha_primer_cobro)) {
            $dt = Carbon::create($fecha_primer_cobro);
        } else {
            $dt = Carbon::now();
            if (date('d') <= 10) {
                $fecha_primer_cobro = $dt->startOfMonth()->add(14, 'days')->format('Y-m-d');
            } else {
                $fecha_primer_cobro = $dt->endOfMonth()->format('Y-m-d');
            }
        }

        // dd($dt->format('Y-m-d'));
        $cont  = 0;
        $pagos = [];

        for ($i = 1; $i <= $pagos_por_contrato; $i++) {
            if ($i == 1) {
                if ($dt->format('d') <= 15) {
                    $fecha = $dt->format('Y-m-d');
                    Pago::create([
                        'contrato_id'    => $contrato_id,
                        'segmento'       => $i,
                        'estatus'        => "Por Pagar",
                        'fecha_de_cobro' => $fecha,
                        'cantidad'       => ($contratoData->precio_de_compra / $pagos_por_contrato),
                    ]);
                    $i++;
                }
            }
            if ($cont == 1) {
                $fecha = $dt->startOfMonth()->add(14, 'days')->format('Y-m-d');
                $cont  = 2;
            } else {
                $fecha = $dt->endOfMonth()->format('Y-m-d');
                $cont  = 1;
            }

            if ($dt->format('d') >= 30 || $dt->format('d') <= 31) {
                $dt = $dt->addDay(2);
            } else {
                $dt = $dt->addMonth();
            }

            Pago::create([
                'contrato_id'    => $contrato_id,
                'segmento'       => $i,
                'estatus'        => "Por Pagar",
                'fecha_de_cobro' => $fecha,
                'cantidad'       => ($contratoData->precio_de_compra / $pagos_por_contrato),
            ]);
        }

        return true;
    }
    /**
     * Calcular pagos mensualemente
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-09-16
     * @param  [objeto] $contratoData
     * @param  [int] $pagos_por_contrato
     * @param  [date] $fecha_de_inicio
     * @return [array] $pagos
     */
    public function generar_pagos_mensual($contrato_id, $fecha_de_inicio = null, $pagos_por_contrato = 12) //codigo correcto

    {

        $contratoData = Contrato::findOrFail($contrato_id);
        if (!empty($fecha_de_inicio) || isset($fecha_de_inicio)) {
            $dt = Carbon::create($fecha_de_inicio);
        } else {
            $dt = Carbon::now();
            // if (date('d') <= 10) {
            //     $fecha_de_inicio = $dt->startOfMonth()->add(14, 'days')->format('Y-m-d');
            // } else {
            $fecha_de_inicio = $dt;
            // }
        }

        $inicio_pago = Pago::where('contrato_id', $contratoData->id)->where('estatus', 'Por Pagar')->orderBy('id', 'ASC')->first();
        $inicio      = ($inicio_pago != null) ? ($inicio_pago->segmento == 0 ? $inicio_pago->segmento + 1 : 0) : 1;

        // $fecha_de_inicio = Carbon::create($fecha_de_inicio);
        $cuotas = $pagos_por_contrato;
        $pagos  = [];

        for ($i = 1; $i <= $pagos_por_contrato; $i++) {

            if ($i == 1) {
                // if ($contratoData->estancia->estancia_especial === 1) {
                //     Pago::create([
                //         'contrato_id'    => $contrato_id,
                //         'segmento'       => $i,
                //         'estatus'        => "Por Pagar",
                //         'fecha_de_cobro' => Carbon::now()->format('Y-m-d'),
                //         'cantidad'       => ($contratoData->precio_de_compra / $pagos_por_contrato),
                //     ]);
                //     $i++;
                // }

                Pago::create([
                    'contrato_id'    => $contrato_id,
                    'segmento'       => $i,
                    'estatus'        => "Por Pagar",
                    'fecha_de_cobro' => $fecha_de_inicio->format('Y-m-d'),
                    'cantidad'       => ($contratoData->precio_de_compra / $pagos_por_contrato),
                ]);
                // $i++;
            } else {

                Pago::create([
                    'contrato_id'    => $contrato_id,
                    'segmento'       => $i,
                    'estatus'        => "Por Pagar",
                    'fecha_de_cobro' => $fecha_de_inicio->addMonth()->format('Y-m-d'),
                    'cantidad'       => ($contratoData->precio_de_compra / $pagos_por_contrato),
                ]);
            }

        }

        return $pagos;
    }

    /**
     * Creacion del primer cobro de enganche pagina USA
     * Autor: Isw. Diego  Enrique Sanchez Ordoñez
     * Creado: 2021-09-13
     * @param  objeto $contrato
     * @return objeto $pago
     */
    public function cobro_pago_engache($contrato, $estatus)
    {
        $fecha = Carbon::now();

        $pago                 = new Pago;
        $pago->contrato_id    = $contrato->id;
        $pago->tarjeta_id     = $contrato->tarjeta_id;
        $pago->segmento       = '0';
        $pago->estatus        = $estatus;
        $pago->cantidad       = ($contrato->estancia->enganche_especial != null) ? $contrato->estancia->enganche_especial : env('ENGANCHE');
        $pago->fecha_de_cobro = $fecha;
        $pago->fecha_de_pago  = ($estatus == 'Pagado') ? $fecha : null;
        $pago->created_by     = 'Cobro automatico OpenPay System';
        $pago->save();
        return $pago;
    }

}
