<div aria-hidden="true" aria-labelledby="modalShowPagos" class="modal fade" data-backdrop="static" id="modalShowPagos" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowPagosLabel">
                    <h4 class="card-title m-b-0">
                        {{ __('messages.cliente.historial_pagos') }}
                        <span id="folioContrato">
                        </span>
                    </h4>
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" id="btnCerrar1" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover data_pagos" id="table_pagos" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th width="60px">
                                            {{ __('messages.cliente.segmento') }}
                                        </th>
                                        <th>
                                            {{ __('messages.cliente.estatus') }}
                                        </th>
                                        <th>
                                            {{ __('messages.cliente.cantidad') }}
                                        </th>
                                        <th class="text-nowrap" width="90px">
                                            {{ __('messages.cliente.fecha_de_cobro') }}
                                        </th>
                                        <th class="text-nowrap" width="90px">
                                            {{ __('messages.cliente.fecha_de_pago') }}
                                        </th>
                                        <th class="text-nowrap">
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <tbody>
                            </tbody>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="btnCerrar" type="button">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
