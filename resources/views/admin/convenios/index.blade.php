@extends('layouts.admin.app')
@section('content')
<style>
    #convenios_table_processing{
        color: red;
        font-size: 1.5em;
        align-items: center;
        align-content: center;
        left: 50%;
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            Convenio
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Convenios
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table aria-describedby="example2_info" class="table table-hover dataTable" id="convenios_table" role="grid" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th>
                                    ID
                                </th>
                                <th>
                                    Pais
                                </th>
                                <th>
                                    Llave
                                </th>
                                <th>
                                    Empresa
                                </th>
                                <th>
                                    Liga
                                </th>
                                <th>
                                    # Contratos
                                </th>
                                <th>
                                    Conveniador
                                </th>
                                <th>
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalReasignar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReasignarLabel">
                    Re asignar convenio
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() { 
        var convenios_table = $('#convenios_table').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            order: [0, 'desc'],
            // bInfo: false,
            ajax: baseadmin + "convenios-listar",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'pais', name: 'pais'},
                {data: 'llave', name: 'llave'},
                {data: 'convenio', name: 'convenio'},
                {data: 'liga', name: 'liga'},
                {data: 'contratos_vendidos', name: 'contratos_vendidos'},
                {data: 'conveniador', name: 'conveniador'},
    
                {data: 'actions', name: 'actions'},
            ],
            "drawCallback": function() {
                if (this.fnSettings().fnRecordsTotal() < 11) {
                    $('.dataTables_paginate').hide();
                }
            },
        });

        $('body').on('click', '#btnAsignar', function(event) {
            event.preventDefault();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    $('#modalReasignar #modal-body').html(res.view);
                    $('#modalReasignar').modal('show');
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
        });

        $('body').on('submit', '#formReasignar', function(event) {
            event.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            $.ajax({
                url: url,
                type: method,
                dataType: 'json',
                data: $(this).serialize(),
                success:function(res){
                    if (res.success == true) {
                        $('#modalReasignar').modal('hide');
                        convenios_table.ajax.reload();
                        toasrt['success']('¡Convenio reasignado correctamente!');
                    }
                    toasrt['error']('¡Error, intenta mas tarde!');

                }
            })
            .fail(function() {
                toasrt['error']('¡Error, intenta mas tarde!');
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
        });
    });
</script>
@endsection
