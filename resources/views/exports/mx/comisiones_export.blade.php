<div class="table-responsive">
    <table class="display nowrap table table-hover dataTable" id="table_comisiones" role="grid" style="width:100%">
        <thead>
            <tr role="row">
                <th>
                    Folio
                </th>
                <th>
                    Llamada
                </th>
                <th>
                    Fecha de venta
                </th>
                <th>
                    Primero pago
                </th>
                <th>
                    Comisionista
                </th>
                <th>
                    Equipo
                </th>
                <th>
                    Empresa
                </th>
                <th>
                    Vendedor
                </th>
                <th>
                    Cliente
                </th>
                <th>
                    Estatus
                </th>
                <th>
                    Motivo
                </th>
                <th>
                    Modificación
                </th>
                <th>
                    Cantidad
                </th>
                <th>
                    Campañas
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comisiones as $comision)
            <tr>
                <td>
                    {{ $comision->id }}
                </td>
                <td>
                    {{ $comision->tipo_llamada }}
                </td>
                <td>
                    {{ $comision->fecha_de_venta }}
                </td>
                <td>
                    {{ $comision->primer_pago }}
                </td>
                <td>
                    {{ $comision->comisionista }}
                </td>
                <td>
                    {{ $comision->equipo }}
                </td>
                <td>
                    {{ $comision->empresa_nombre }}
                </td>
                <td>
                    {{ $comision->vendedor }}
                </td>
                <td>
                    {{ $comision->cliente_nombre }}
                </td>
                <td>
                    {{ $comision->estatus }}
                </td>
                <td>
                    {{ $comision->motivo_rechazo }}
                </td>
                <td>
                    {{ $comision->modified }}
                </td>
                <td>
                    {{ $comision->cantidad }}
                </td>
                <td>
                    @if ($comision->campana_inicio)
                    {{ $comision->campana_inicio }} al {{ $comision->campana_fin }}
                    @else
                    N/A
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
