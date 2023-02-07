@extends('layouts.admin.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            {{ __('Administrativos') }}
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Usuarios administrativos
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover dataTable" id="table_usuarios" role="grid" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th>
                                    #
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Correo Electrónico
                                </th>
                                <th>
                                    Equipo
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Estatus
                                </th>
                                <th>
                                    Registrado
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
@endsection


@section('script')
<script>
    $(document).ready(function() {
        var tabla = $('#table_usuarios').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            order: [0, 'desc'],
            bInfo: true,
            ajax: baseadmin + "listar-administrativos",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nombre', name: 'nombre'},
                {data: 'username', name: 'username'},
                {data: 'equipo', name: 'equipo'},
                {data: 'role', name: 'role'},
                {data: 'activo', name: 'activo'},
                {data: 'created', name: 'activo'},
    
                {data: 'actions', name: 'actions'},
            ],
            "drawCallback": function() {
                if (this.fnSettings().fnRecordsTotal() < 11) {
                    $('.dataTables_paginate').hide();
                }
            },
        });

        $('body').on('click', '#activo', function(event) {
            event.preventDefault();
            var estatus = $(this).data('activo');
            var user_id = $(this).data('user_id');
            var url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'PUT',
                dataType: 'json',
                data: {estatus: estatus},
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    if (res.success==true) {
                        tabla.ajax.reload();
                        toastr["success"]("¡Registro exitoso!");
                    }else{
                        toastr["error"]("¡Intentar mas tarde!");
                    }
                }
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
            
        });
    });
</script>
@endsection
