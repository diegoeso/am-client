<?php

namespace App\Traits;

use App\Models\Pago;
use DB;
trait TerminalTrait
{
    public function get_data_terminal($request)
    {
        $unlock = session('unlock_cards');
        $pagos  = Pago::with([
            'contrato'          => function ($q) use ($request) {
                $q->select('id', 'user_id', 'tarjeta_id', 'via_serfin', 'pago_con_nomina', 'estatus');
            },
            'contrato.cliente'  => function ($query) {
                $query->select('id', 'nombre', 'apellidos', 'username')->groupBy('id');
            },
            'contrato.convenio' => function ($query) {
                $query->select('id', 'empresa_nombre', 'paise_id');
            },
        ])
            ->whereHas('contrato', function ($q) use ($request) {
                $q->whereIn('estatus', ['viajado', 'comprado', 'Comprado']);
                if (isset($request->nomina) && isset($request->terminal) && !isset($request->viaserfin)) {
                    $q->orwhere('pago_con_nomina', 1)->orwhere('via_serfin', 0);
                } elseif (isset($request->nomina) && !isset($request->terminal) && isset($request->viaserfin)) {
                    $q->orwhere('pago_con_nomina', 1)->orwhere('via_serfin', 1);
                } elseif (isset($request->nomina) && !isset($request->terminal) && !isset($request->viaserfin)) {
                    $q->where('pago_con_nomina', 1);
                } elseif (!isset($request->nomina) && !isset($request->terminal) && isset($request->viaserfin)) {
                    $q->where('via_serfin', 1)->where('sys_key', '<>', null);
                } elseif (!isset($request->nomina) && isset($request->terminal) && !isset($request->viaserfin)) {
                    $q->orwhere('pago_con_nomina', 0)->where('via_serfin', 0);
                } elseif (!isset($request->nomina) && isset($request->terminal) && isset($request->viaserfin)) {
                    $q->orwhere('pago_con_nomina', 0);
                } elseif (!isset($request->nomina) && !isset($request->terminal) && !isset($request->viaserfin)) {
                    $q->orwhere('pago_con_nomina', 1)->orwhere('via_serfin', 1);
                }
                $q->orderBy('id', 'ASC');
            })
            ->where('cantidad', '>', 0)
            ->where(DB::raw('date(fecha_de_cobro)'), '>=', ($request->fecha_inicio) ? $request->fecha_inicio : date('Y-m-d'))
            ->where(DB::raw('date(fecha_de_cobro)'), '<=', ($request->fecha_fin) ? $request->fecha_fin : date('Y-m-d'));
        $estatus = array();
        if (isset($request->pagosRechazados)) {
            $estatus[] = 'Rechazado';
        }
        if (isset($request->pagosPagados)) {
            $estatus[] = 'Pagado';
        }
        if (isset($request->pagosPendientes)) {
            $estatus[] = 'Por Pagar';
        }
        if (isset($request->pagosAnomalías)) {
            $estatus[] = 'Anomalia';
        }
        $pagos->whereIn('estatus', $estatus);

        $pagos->whereHas('contrato.tarjeta', function ($q) use ($request) {
            if ($request->tipoTarjeta != 0) {
                $q->where('tipo', $request->tipoTarjeta);
            }
            if ($request->red_bancaria != 0) {
                $q->where('banco', $request->red_bancaria);
            }
        });

        $res = $pagos->orderBy('segmento', 'ASC')
        // ->orderBy('estatus', 'ASC');
            ->orderBy('contrato_id', 'ASC');
        // ->get();
        // ->get()

        return $res;
    }
}
