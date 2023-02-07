<?php

namespace App\Helpers;

use App\Models\Comision;
use App\Models\Contrato;
use App\Models\Convenio;
use App\Models\Salesgroup;
use Carbon\Carbon;
use DB;

class ComisionesHelper
{
    public function generar_comisiones($contrato_id = null, $convenio_id = null)
    {
        // dd($contrato_id, $convenio_id);
        $contrato = Contrato::findOrFail($contrato_id);
        $convenio = Convenio::findOrFail($contrato->convenio_id);
        $fecha    = Carbon::now();
        Comision::create([
            'contrato_id'      => $contrato->id,
            'pagable'          => 0,
            'pagado'           => 0,
            'estatus'          => 'Pendiente',
            'convenio_id'      => $convenio->id,
            'cliente_nombre'   => $contrato->cliente->fullName,
            'cliente_username' => $contrato->cliente->username,
            'cantidad'         => $convenio->comision_conveniador,
            'user_id'          => $convenio->user_id, // Estatico al creador por asignación del convenio.
            'concepto'         => 'Venta de contrato a conveniador',
            'campana_inicio'   => $convenio->campana_inicio,
            'campana_fin'      => $convenio->campana_fin,
            'created'          => $fecha,
            'modified'         => $fecha,

        ]);

        Comision::create([
            'contrato_id'      => $contrato->id,
            'pagable'          => 0,
            'pagado'           => 0,
            'estatus'          => 'Pendiente',
            'convenio_id'      => $convenio->id,
            'cliente_nombre'   => $contrato->cliente->fullName,
            'cliente_username' => $contrato->cliente->username,
            'cantidad'         => 100.0,
            'user_id'          => $contrato->padre->user_id, // Estatico al creador por asignación del convenio.
            'concepto'         => 'Venta de contrato a ejecutivo',
            'created'          => $fecha,
            'modified'         => $fecha,

        ]);

        Comision::create([
            'contrato_id'      => $contrato->id,
            'pagable'          => 0,
            'pagado'           => 0,
            'estatus'          => 'Pendiente',
            'convenio_id'      => $convenio->id,
            'cliente_nombre'   => $contrato->cliente->fullName,
            'cliente_username' => $contrato->cliente->username,
            'cantidad'         => 15.0,
            'user_id'          => $contrato->padre->user_id, // Estatico al creador por asignación del convenio.
            'concepto'         => 'Venta de contrato a supervisor',
            'created'          => $fecha,
            'modified'         => $fecha,
        ]);

        return true;

        // return $this->supervisor($contrato->padre_id);
    }

    public function supervisor($id)
    {
        $sup = Salesgroup::where('id', $id)->get();
    }

    /**
     * Autor: ISW. Diego Enrique Sanchez
     * Creado: 2022-11-07
     * Consulta de comisiones para los ejecutivos seleccionados
     * @param  [date] $fecha_inicio
     * @param  [date] $fecha_fin
     * @param  [array] $users
     * @return [array] $datos
     */
    public function getComisiones($fecha_inicio, $fecha_fin, $users)
    {
        $datos = DB::select("
                select
                    contratos.id, contratos.tipo_llamada,
                    contratos.created as 'fecha_de_venta',
                    min(pagos.fecha_de_pago) as 'primer_pago',
                    min(pagos.estatus) as 'estatus_pago',
                    min(pagos.segmento) as 'segmento_pago',
                    concat('[', upper(users.role), '] ', users.nombre, ' ', users.apellidos) as comisionista,
                    case
                    when salesgroups.title is null then 'Sin asignación'
                    else salesgroups.title end as 'equipo',
                    convenios.empresa_nombre,
                    vendedor.title as vendedor,
                    comisiones.cliente_nombre,
                    comisiones.estatus,
                    comisiones.motivo_rechazo,
                    comisiones.modified,
                    comisiones.cantidad,
                    comisiones.campana_inicio,
                    comisiones.campana_fin,
                    contratos.user_id as user_id
                from
                    comisiones
                    inner join
                    users ON comisiones.user_id = users.id
                    left outer join
                    salesgroups ON users.salesgroup_id = salesgroups.id
                    inner join
                    contratos ON comisiones.contrato_id = contratos.id
                    inner join
                    convenios ON comisiones.convenio_id = convenios.id
                    inner join
                    pagos ON comisiones.contrato_id = pagos.contrato_id
                    LEFT JOIN
                    padres AS vendedor ON vendedor.id = contratos.padre_id
                where
                comisiones.estatus NOT IN ( 'Finiquitadas')
                    and pagos.estatus = 'Pagado'
                    and users.username in ({$users})
                group by contratos.id , contratos.created , users.role , users.nombre , users.apellidos , salesgroups.title
                having min(pagos.fecha_de_pago) between '{$fecha_inicio}' and '{$fecha_fin}'
            UNION
                select
                   contratos.id, contratos.tipo_llamada,
                    contratos.created as 'fecha_de_venta',
                    min(pagos.fecha_de_pago) as 'primer_pago',
                    min(pagos.estatus) as 'estatus_pago',
                    min(pagos.segmento) as 'segmento_pago',
                    concat('[', upper(users.role), '] ', users.nombre, ' ', users.apellidos) as comisionista,
                    case
                    when salesgroups.title is null then 'Sin asignación'
                    else salesgroups.title end as 'equipo',
                    convenios.empresa_nombre,
                    vendedor.title as vendedor,
                    comisiones.cliente_nombre,
                    comisiones.estatus,
                    comisiones.motivo_rechazo,
                    comisiones.modified,
                    comisiones.cantidad,
                    comisiones.campana_inicio,
                    comisiones.campana_fin,
                    contratos.user_id as user_id
                from
                    comisiones
                    inner join
                    users ON comisiones.user_id = users.id
                    left outer join
                    salesgroups ON users.salesgroup_id = salesgroups.id
                    inner join
                    contratos ON comisiones.contrato_id = contratos.id
                    inner join
                    convenios ON comisiones.convenio_id = convenios.id
                    inner join
                    pagos ON comisiones.contrato_id = pagos.contrato_id
                    LEFT JOIN
                    padres AS vendedor ON vendedor.id = contratos.padre_id
                where
                comisiones.estatus NOT IN ( 'Finiquitadas', 'Pagable' )
                    and pagos.estatus IN ('Rechazado')
                    and users.username in ({$users})
                group by contratos.id , contratos.created , users.role , users.nombre , users.apellidos , salesgroups.title
                having min(pagos.fecha_de_pago)  BETWEEN '{$fecha_inicio}' and '{$fecha_fin}'
            UNION
                select
                     contratos.id, contratos.tipo_llamada,
                    contratos.created as 'fecha_de_venta',
                    min(pagos.fecha_de_pago) as 'primer_pago',
                    min(pagos.estatus) as 'estatus_pago',
                    min(pagos.segmento) as 'segmento_pago',
                    concat('[', upper(users.role), '] ', users.nombre, ' ', users.apellidos) as comisionista,
                    case
                    when salesgroups.title is null then 'Sin asignación'
                    else salesgroups.title end as 'equipo',
                    convenios.empresa_nombre,
                    vendedor.title as vendedor,
                    comisiones.cliente_nombre,
                    comisiones.estatus,
                    comisiones.motivo_rechazo,
                    comisiones.modified,
                    comisiones.cantidad,
                    comisiones.campana_inicio,
                    comisiones.campana_fin,
                    contratos.user_id as user_id
                from
                    comisiones
                    inner join
                    users ON comisiones.user_id = users.id
                    left outer join
                    salesgroups ON users.salesgroup_id = salesgroups.id
                    inner join
                    contratos ON comisiones.contrato_id = contratos.id
                    inner join
                    convenios ON comisiones.convenio_id = convenios.id
                    inner join
                    pagos ON comisiones.contrato_id = pagos.contrato_id
                    LEFT JOIN
                    padres AS vendedor ON vendedor.id = contratos.padre_id
                where
                comisiones.estatus NOT IN ( 'Finiquitadas', 'Pagable', 'Pendiente' )
                    and pagos.estatus IN ('Por Pagar')
                    and users.username in ({$users})
                group by contratos.id , contratos.created , users.role , users.nombre , users.apellidos , salesgroups.title
                having min(pagos.fecha_de_pago) between '{$fecha_inicio}' and '{$fecha_fin}'
            order by COMISIONISTA , empresa_nombre");

        return $datos;
    }
}
