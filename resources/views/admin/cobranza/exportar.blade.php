@extends('layouts.admin.app')
@section('content')
<style>
    button > .infoPago{
        display: none;
    }

    #btnPago:hover{
        /*background-color: red;*/
    }

    #btnPago:hover  > .infoPago{
        display: block;
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor text-capitalize">
            Exportar contratos
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Exportar contratos
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-actions">
                    <button class="btn btn-dark btn-sm" id="btnReloadC">
                        <i class="fa fa-spin fa-refresh">
                        </i>
                    </button>
                    <button class="btn btn-info btn-sm" id="btnGenerarLayout">
                        Generar layout
                    </button>
                </div>
                Resultados
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover" id="tableContratos">
                    <thead>
                        <tr>
                            <th scope="col">
                                Folio
                            </th>
                            <th scope="col">
                                Clave Serfin
                            </th>
                            <th scope="col">
                                Fecha de compra
                            </th>
                            <th scope="col">
                                Propietario
                            </th>
                            <th scope="col">
                                Tarjeta asignada
                            </th>
                            <th scope="col">
                                Tarjetahabiente
                            </th>
                            <th scope="col">
                               Tipo
                            </th>
                            <th scope="col">
                                Banco
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        var table_contratos;

        table_contratos = $('#tableContratos').DataTable({
            'responsive': true,
            'searching': true,
            // "processing": true,
            'lengthMenu': [[10, 50, -1], [10, 50, "Todo"]],
            'pageLength': 10,
            // "order": [[ 0, "ASC" ]],
            "aoColumns": [{
                "mData": "0"
                }, {
                "mData": "1"
                }, {
                "mData": "7"
                },{
                "mData": "2"
                }, {
                "mData": "4"
                }, {
                "mData": "3"
                }, {
                "mData": "5"
                }, {
                "mData": "6"
                }
            ],
            "ajax": {
                url: baseadmin + "get-contratos-exportar",
                type: "get",
                dataType: "json",
                // beforeSend:function(){
                //     console.log('esperando');
                // },
                // success:function(res){
                //     console.log(res.iTotalRecords);
                //     toastr['info']('Hay un total de '+res.iTotalRecords+'  contratos nuevos que deberían ser integrados VIA Serfin.');
                // },
                error: function (xhr, error, code) {
                    table_contratos.ajax.reload();
                }
            },
        });

        $(document).on('click', '#btnReloadC', function(event) {
            event.preventDefault();
            table_contratos.ajax.reload();
            toastr['info']('Recargando datos...')
        });

        $(document).on('click', '#btnGenerarLayout', function(event) {
            event.preventDefault();
            $.ajax({
                url: baseadmin + 'generate-opt',
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                     $("#overlay").css("display", "block");
                }
            })
            .done(function(res) {
                if (res.success == true) {
                    toastr['info']('Se gan generado: ' + res.num_contratos + ' Opt´s a via serfin.');
                    table_contratos.ajax.reload();
                }else{
                    toastr['error']('Intentar mas tarde...');
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $("#overlay").css("display", "none");
                toastr['error'](errorThrown);
                toastr['error'](jqXHR.responseJSON.message);
            })
            .always(function() {
                 $("#overlay").css("display", "none");
            });
            
        });
    });
</script>
@stop
