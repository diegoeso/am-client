<script type="text/javascript">
    $(document).ready(function() {

        var ninos = 1;
        var juniors = 1;
        var endDays = 1;
        var cont_n = 1;
        var cont_j = 1;
        var cont_fild = 1;
        var flag = true;
        var habitacion = 1;
        var user_id = @json($user->id);
        var user_name = @json($user->fullName);
        $('.btnAddHabitacion').attr('data-num_row_hab', habitacion);
        $('#padre_id').select2({
            dropdownParent: $('#modalAsignarReservacion .modal-body')
        });
        
        /*=====================================
        =            Reservaciones            =
        =====================================*/
        var user_id = @json($user->id);
        var user_name = @json($user->fullName);
        var table_reservaciones;
        setTimeout(function(){
            table_reservaciones = $('#table_reservaciones').DataTable({
                'responsive': true,
                'searching': true,
                'lengthMenu': [[10, 20, -1], [10, 20, "Todo"]],
                'pageLength': 10,
                "aoColumns": [{
                    "mData": "1"
                    }, {
                    "mData": "2"
                    },{
                    "mData": "3"
                    }, {
                    "mData": "4"
                    },{
                    "mData": "5"
                    },{
                    "mData": "6"
                    }
                ],
                "ajax": {
                    url: baseuri + "admin/get-reservaciones/"+user_id,
                    type: "get",
                    dataType: "json",
                    error: function (xhr, error, code) {
                        // toastr['error'](xhr, code);
                        table_reservaciones.ajax.reload();
                    }
                },
            });
        }, 100);
        
        /*=====  End of Reservaciones  ======*/

        /**
         * Autor: ISW Diego Sanchez
         * Eliminar reservacion
         * 
         */
        $('body').on('click', '#btnDeleteR', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
             alertify.confirm('Confirmar', '¿Desea eliminar la reservacion con folio: '+id+ '?',function(){
                $.ajax({
                    url: baseadmin + 'reservations/'+ id,
                    type: 'DELETE',
                    dataType: 'JSON',
                    beforeSend:function(){
                        $("#overlay").css("display", "block");
                    },
                    success:function(res){
                        if (res.success == true) {
                            table_reservaciones.ajax.reload();
                            toastr['success']('Reservacion eliminada');
                        }
                    }
                })
                .fail(function() {
                    toastr['error']('Intentar mas tarde...');
                })
                .always(function() {
                    $("#overlay").css("display", "none");
                });

            }
            ,function(){});
        });


        /**
         * Recargar datos de la tabla en caso de no cargar automaticamente
         */
        $('body').on('click', '#btnReloadR', function(event) {
            event.preventDefault();
             toastr['info']('Recargando datos...');
            table_reservaciones.ajax.reload();  
        });

        /**
         * Mostramos el historial de la reservacion
         */
        $('body').on('click', '#btnLogReservacion', function(event) {
            event.preventDefault();
            var reservacion_id = $(this).data('reservacion_id');
            $.ajax({
                url: baseadmin + 'log-reservacion/'+reservacion_id,
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    $('#modalHistorial #modal-body').removeClass('historico')
                    $('#modalHistorial #modal-body').addClass('historical-log')
                    $('#modalHistorial #modalSearchLabel').html('Historial');
                    $('#modalHistorial #modal-body').html(res.historico);
                    $('#modalHistorial').modal('show');
                }
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
        });


        /**
         * Mostramos la informacion de la reservacion 
         * exportacion a pdf
         */
        $('body').on('click', '#btnShow', function(event) {
            event.preventDefault();
            var reservacion_id = $(this).attr('value');
            $.ajax({
                url: baseadmin + 'reservations/'+reservacion_id,
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    console.log(res);
                    // $('#modalHistorial #modal-body').removeClass('historico')
                    // $('#modalHistorial #modal-body').addClass('historical-log')
                    $('#modalGeneral #modal-body').html(res.view);
                    $('#modalGeneral .modal-dialog').addClass('modal-lg');
                    $('#modalGeneral').modal('show');
                }
            })
            .fail(function() {
                toastr['error']('Intentelo mas tarde');
                $("#overlay").css("display", "none");
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
            
        });


        /**
         * Autor: ISW Diego Sanchez
         * Creado: 2022-09-13
         * Editar reservacion
         */
        $('body').on('click', '#btnEditR', function(event) {
            event.preventDefault();
            var reservacion_id = $(this).attr('value');
            $.ajax({
                url: $(this).data('url'),
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                
                    $('#modalGeneral #modal-body').html(res.view);
                    $('#modalGeneral .modal-dialog').addClass('modal-lg');
                    $('#modalGeneral').modal('show');
                }
            })
            .fail(function() {
                toastr['error']('Intentelo mas tarde');
                $("#overlay").css("display", "none");
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
            
        });


        $(document).on('change', '#estancia_id', function(event) {
            event.preventDefault();
            $('#title').val($("#estancia_id option:selected").text());
        });

        /**
         * Autor: ISW Diego Sanchez
         * Creado: 2022-09-22
         * Pagos de reservacion
         */
        $('body').on('click', '#btnPagosR', function(event) {
            event.preventDefault();
            var reservacion_id = $(this).attr('value');
            $.ajax({
                url: $(this).data('url'),
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                
                    $('#modalGeneral #modal-body').html(res.view);
                    $('#modalGeneral .modal-dialog').addClass('modal-lg');
                    $('#modalGeneral').modal('show');
                }
            })
            .fail(function() {
                toastr['error']('Intentelo mas tarde');
                $("#overlay").css("display", "none");
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
            
        });

        /**
         * Modificacion de reservacion  
         */
        $('body').on('submit', '#form_reservaciones_edit', function(event) {
            event.preventDefault();
             $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                dataType: 'json',
                data: $(this).serialize(),
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    if (res.success == true) {
                        $('#modalGeneral').modal('hide');
                        $(this).trigger('reset');
                        table_reservaciones.ajax.reload();
                        toastr['success']('{{ __('messages.alerta.success') }}');
                    }else{
                        toastr['error'](res.errors);
                        toastr['error']('{{ __('messages.alerta.error') }}');
                    }
                }
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
        });

        $('body').on('click', '#modalAddReservacion #btnAddName', function(event) {
            event.preventDefault();
            $('#modalAddReservacion #formAddReservacion #titular').val(user_name);
        });



        /**
         * Autor: ISW Diego Sanchez
         * Creado: 2022-09-26
         * Cupon de confirmacion 
         */
        $('body').on('click', '#btnCuponCR', function(event) {
            event.preventDefault();
            var reservacion_id = $(this).attr('value');
            window.open($(this).data('url'), '_blank')
        });

        /**
         * Autor: ISW Diego Sanchez
         * Creado: 2022-09-27
         * Cupon de pago reservacion 
         */
        $('body').on('click', '#btnCuponPR', function(event) {
            event.preventDefault();
            var reservacion_id = $(this).attr('value');
            window.open($(this).data('url'), '_blank')
        });
        
        /**
         * Autor: ISW Diego Sanchez
         * Creado: 2022-09-28
         * Asociar folios con reservacion y habitaciones 
         */
        // $('body').on('click', '#btnConfig', function(event) {
        //  event.preventDefault();
        //  var reservacion_id = $(this).attr('value');
        //  window.open($(this).data('url'), '_blank')
        // });

        $('body').on('click', '#btnConfig', function(event) {
            event.preventDefault();
            var reservacion_id = $(this).attr('value');
            habitacion = 1;
            $.ajax({
                url: $(this).data('url'),
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    console.log(res);
                    $('#modalAddReservacion #divReservacion').html(res.view);
                    $('#modalAddReservacion .modal-dialog').addClass('modal-xl');
                    $('#modalAddReservacion .modal-title').html('Asociar folios y habitaciones');
                    $('#modalAddReservacion').modal('show');
                }
            })
            .fail(function() {
                toastr['error']('Intentelo mas tarde');
                $("#overlay").css("display", "none");
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
            
        });


        
        /**
          * agregar registros de menores dinamicos  
          */
        $('body').on('click', '.btnAdd', function(event) {
            event.preventDefault();
            var contenedor = $(this).data('field');
            var num_cont = $(this).data('num_row');
            var row_inicial = $(this).data('row');
            var row = $(this).attr('id');
            
            if (num_cont != null) {
                cont_n = num_cont +1 ;
            }
            console.log(contenedor, row_inicial, row);
            
            $('#'+contenedor+row_inicial).append('<tr id="row' + cont_n + '"><td><div class="input-group input-sm"><input type="text" id="edad_nino' + cont_n + '" min="1" name="edad_nino'+row_inicial+'[]" pattern="^[0-9]+" class="form-control required><div class="input-group-append"><button  data-field="'+contenedor+row_inicial+'"  name="remove" id="' + cont_n + '" class="btn btn-outline-danger btn_remove btn-sm" type="button"><span class="fa fa-trash"></span></button></div></div></td></tr>');
            cont_n++;
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            var contenedor_r = $(this).data('field');
            if ($('#form_reservaciones_edit').attr('method') == 'PUT') {
                var url = $(this).data('url_nino');                
                alertify.confirm('Eliminar menor', '¿Desea eliminar el menor seleccionado?', 
                    function(){ 
                        $.ajax({
                            url: url,
                            type: 'GET',
                            dataType: 'JSON',
                            beforeSend:function(){

                            },
                            success:function(res){
                                if (res.success == true) {
                                    toastr['success']('{{ __('messages.alerta.success') }}'); 
                                    cont_n = cont_n - 1;
                                    $('#'+contenedor_r+' #row' + button_id + '').remove();
                                    
                                    $('.btnAddHabitacion').attr('data-num_row_hab', habitacion);
                                }else{
                                     toastr['error']('{{ __('messages.alerta.error') }}');
                                }
                            }
                        })
                        .always(function() {
                            console.log("complete");
                        });
                    }, 
                    function(){});
            }else{
               
                cont_n = cont_n - 1;
                $('#'+contenedor_r+' #row' + button_id + '').remove();
            }
        });


        /** Agregar juniors a la habitacion seleccionada */
        $('body').on('click', '.btnAddJ', function(event) {
            event.preventDefault();
            var contenedor = $(this).data('field');
            var row_inicial = $(this).data('row');
            var row = $(this).attr('id');
            
            console.log(contenedor, row_inicial, row);
            
            $('#'+contenedor+row_inicial).append('<tr id="row' + cont_n + '"><td><div class="input-group input-sm"><input type="text" id="edad_junior' + cont_n + '" min="1" name="edad_junior'+row_inicial+'[]" pattern="^[0-9]+" class="form-control required><div class="input-group-append"><button  data-field="'+contenedor+row_inicial+'"  name="remove" id="' + cont_n + '" class="btn btn-outline-danger btn_remove_j btn-sm" type="button"><span class="fa fa-trash"></span></button></div></div></td></tr>');
            cont_n++;
        });

        $(document).on('click', '.btn_remove_j', function() {
            // var button_id = $(this).attr("id");
            // var contenedor_r = $(this).data('field');
            // cont_n = cont_n - 1;
            // $('#'+contenedor_r+' #row' + button_id + '').remove();


            var button_id = $(this).attr("id");
            var contenedor_r = $(this).data('field');
            if ($('#form_reservaciones_edit').attr('method') == 'PUT') {
                var url = $(this).data('url_jr');                
                alertify.confirm('Eliminar menor', '¿Desea eliminar el jr seleccionado?', 
                    function(){ 
                        $.ajax({
                            url: url,
                            type: 'GET',
                            dataType: 'JSON',
                            beforeSend:function(){

                            },
                            success:function(res){
                                if (res.success == true) {
                                    toastr['success']('{{ __('messages.alerta.success') }}'); 
                                    cont_n = cont_n - 1;
                                    $('#'+contenedor_r+' #row' + button_id + '').remove();
                                    
                                    $('.btnAddHabitacion').attr('data-num_row_hab', habitacion);
                                }else{
                                     toastr['error']('{{ __('messages.alerta.error') }}');
                                }
                            }
                        })
                        .always(function() {
                            console.log("complete");
                        });
                    }, 
                    function(){});
            }else{
               
                cont_n = cont_n - 1;
                $('#'+contenedor_r+' #row' + button_id + '').remove();
            }

        });
            
       
        $('#btnAddReservacion').on('click', function(event) {
            event.preventDefault();

            var user_id = $(this).data('user_id');
            $.ajax({
                url: baseadmin + 'agregar-reservacion/' + user_id,
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                }
            })
            .done(function(res) {
                $('#modalAddReservacion #divReservacion').html(res.view)
                $('#modalAddReservacion').modal('show');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                toastr['error'](errorThrown);
                toastr['error'](jqXHR.responseJSON.message);
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
        });

        $('body').on('submit','#formAddReservacion', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    if (res.success == true) {
                        $('#modalAddReservacion').modal('hide');
                        $('#formAddReservacion').trigger('reset');
                        toastr['success']('{{ __('messages.alerta.success') }}'); 
                        table_reservaciones.ajax.reload();
                    }else{
                        pintar_errores(res.errors);
                    }
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                toastr['error'](jqXHR.responseJSON.message);
                toastr['error'](errorThrown);
                $("#overlay").css("display", "none");
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
            
        });


        ///////////////////////////////////////
        //Agregar habitaciones a reservacion //
        ///////////////////////////////////////
        $(document).on('click', '.btnAddHabitacion', function(event) {
            event.preventDefault();
            if (($('#form_reservaciones_edit').attr('method')) == 'PUT') {    
                var num_row_hab = $(this).data('num_row_hab');
                if (num_row_hab) {
                    habitacion = num_row_hab;
                }
            }
            habitacion++;
            $('#divHabitacion').append(
                '<div class="row" id="rowHabitacion' + habitacion + '">'+
                    '<input name="num_habitacion[]" type="hidden" value="'+habitacion+'"/>'+
                    '<div class="col-md-12">'+
                    '<div class="row">'+
                        '<div class="col-md-6">'+
                        '    <p>'+
                        '        Habitacion '+ habitacion+
                        '    </p>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                        ' <div class="pull-right">'+
                        '    <button class="btn btn-xs btn-danger removeHabitacion"  data-id="'+habitacion+'"  type="button">'+
                        '        <i class="fas fa-trash">'+
                        '        </i>'+
                        '        Eliminar'+
                        '    </button>'+
                        '</div>'+
                        '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                    '    <label for="adultos">'+
                    '        Adultos'+
                    '    </label>'+
                    '    <input class="form-control" id="adultos" name="adultos[]" type="text" value="'+ $(this).data('adultos') +'">'+
                    '    </input>'+
                    '    <span class="text-danger error-adultos errors">'+
                    '    </span>'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                    '    <label for="noches">'+
                    '        Noches'+
                    '    </label>'+
                    '    <input class="form-control" id="noches" name="noches[]" type="text" value="'+ $(this).data('noches') +'">'+
                    '    </input>'+
                    '    <span class="text-danger error-noches errors">'+
                    '    </span>'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                    '    <label for="ninos">'+
                    '        Niños:'+
                    '    </label>'+
                    '    <br/>'+
                    '    <button class="btn btn-info btn-xs btnAdd" data-cantidad-row="" data-field="dynamic_field_"  data-row="'+habitacion+'" id="btnAdd" type="button">'+
                    '        <i class="fa fa-plus">'+
                    '        </i>'+
                    '        Agregar'+
                    '    </button>'+
                    '    <div class="row">'+
                    '        <div class="col-md-8">'+
                    '            <table class="table" id="dynamic_field_'+habitacion+'">'+
                    '            </table>'+
                    '        </div>'+
                    '    </div>'+
                    '    <span class="help-block text-muted">'+
                    '        <small>'+
                    '            {{ __('messages.cliente.menores_12') }}'+
                    '        </small>'+
                    '    </span>'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                    '    <label for="junior">'+
                    '        {{ __('messages.cliente.juniors') }}:'+
                    '    </label>'+
                    '    <br/>'+
                    '    <button class="btn btn-info btn-xs btnAddJ" data-field="dynamic_field_j_" data-row="'+habitacion+'" id="btnAddJ" type="button">'+
                    '        <i class="fa fa-plus">'+
                    '        </i>'+
                    '        {{ __('messages.cliente.agregar') }}'+
                    '    </button>'+
                    '    <div class="row">'+
                    '        <div class="col-md-8">'+
                    '            <table class="table" id="dynamic_field_j_'+habitacion+'">'+
                    '                <tbody>'+
                    '               </tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'
            );
        });

        $(document).on('click', '.removeHabitacion', function() {
            event.preventDefault();
            var id = $(this).data("id");
            if ($('#form_reservaciones_edit').attr('method') == 'PUT') {                   
                var hab_id = $(this).attr('value'); 
                alertify.confirm('Eliminar habitacion', '¿Desea eliminar la habitacion seleccionada?', 
                    function(){ 
                        $.ajax({
                            url: baseadmin + 'habitaciones/'+hab_id,
                            type: 'DELETE',
                            dataType: 'JSON',
                            beforeSend:function(){

                            },
                            success:function(res){
                                if (res.success == true) {
                                    toastr['success']('{{ __('messages.alerta.success') }}'); 
                                    $('#rowHabitacion' + id + '').remove();
                                    habitacion = habitacion - 1;
                                    $('.btnAddHabitacion').attr('data-num_row_hab', habitacion);
                                }else{
                                     toastr['error']('{{ __('messages.alerta.error') }}');
                                }
                            }
                        })
                        .always(function() {
                            console.log("complete");
                        });
                    }, 
                    function(){});
            }else{
                $('#rowHabitacion' + id + '').remove();
                habitacion = habitacion - 1;
                $('.btnAddHabitacion').attr('data-num_row_hab', habitacion);
            }

        });


        /**
         * Script para pagos de reservacion
         */

        $(document).on('submit', '#formPagosReservacion', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'PUT',
                dataType: 'JSON',
                data: $(this).serialize(),
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    if (res.success == true) {
                        $(this).trigger('reset');
                        table_reservaciones.ajax.reload();
                        toastr['success']('{{ __('messages.alerta.success') }}');
                        $('#modalGeneral').modal('hide');
                    }else{
                        toastr['error'](res.errores);
                        toastr['error']('{{ __('messages.alerta.error') }}');
                    }
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                toastr['error'](errorThrown);
                toastr['error'](jqXHR.responseJSON.message);
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
        });



        /**
         * Ajustes de reservacion
         */
        
        /**
         * Autor: ISW Diego Sanchez
         * Creado: 2022-12-06
         * Ajustes de reservacion, pagos e informacion de hotel
         */
        $(document).on('click', '#btnAjustesR', function(event) {
            event.preventDefault();
            var reservacion_id = $(this).attr('value');
            $.ajax({
                url: $(this).data('url'),
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                
                    $('#modalGeneral #modal-body').html(res.view);
                    $('#modalGeneral .modal-dialog').addClass('modal-lg');
                    $('#modalGeneral').modal('show');
                }
            })
            .fail(function() {
                toastr['error']('Intentelo mas tarde');
                $("#overlay").css("display", "none");
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
        });


        /**
         * Modificacion de reservacion  
         */
        $('body').on('submit', '#form_reservaciones_ajustes', function(event) {
            event.preventDefault();
             $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                dataType: 'json',
                data: $(this).serialize(),
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    if (res.success == true) {
                        $(this).trigger('reset');
                        table_reservaciones.ajax.reload();
                        toastr['success']('{{ __('messages.alerta.success') }}');
                        $('#modalGeneral').modal('hide');
                    }else{
                        pintar_errores(res.errors);
                        // toastr['error']('{{ __('messages.alerta.error') }}');
                    }
                }
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
        });

        $(document).on('click', '#btnAsignarReserva', function(event) {
            event.preventDefault();
            var id = $(this).data('reservacion_id');
            $('#reservacion_id').val(id);
            $('modalAsignarReservacion').modal('show');
            
        });
        $(document).on('submit', '#formAsignarReservacion', function(event) {
            event.preventDefault();
            $.ajax({
                url: baseadmin + 'asignar-reservacion',
                type: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    if (res.success == true) {
                        $('#modalAsignarReservacion').modal('hide');
                        table_reservaciones.ajax.reload();
                        toastr['success']('¡Registros exitoso!');
                    }else{
                        toastr['error']('Intentar mas tarde...')
                    }
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
            
        });

        /**
         * Autor: ISW Diego Enrique Sanchez
         * Creado: 2022-12-20
         * Elimina el menos registrado en la habitacion
         */
        // $(document).on('click', '.deleteNino', function(event) {
        //     event.preventDefault();
        //     var habitacion_id = $(this).data('habitacion_id');
        //     var nino_id = $(this).data('nino_id');
        //     Swal.fire({
        //       title: 'Confirmación',
        //       text: "¿Desea eliminar el menos seleccionado?",
        //       icon: 'warning',
        //       showCancelButton: true,
        //       confirmButtonColor: '#3085d6',
        //       cancelButtonColor: '#d33',
        //       confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //       if (result.isConfirmed) {
        //         Swal.fire(
        //           'Deleted!',
        //           'Your file has been deleted.',
        //           'success'
        //         )
        //       }
        //     })

        // });
    });


    function pintar_contratos(user_id) {
        tabla_contratos = $('#table_contratos').DataTable({
                'responsive': true,
                'searching': true,
                'lengthMenu': [[10, 20, -1], [10, 20, "Todo"]],
                'pageLength': 10,
                "aoColumns": [{
                    "mData": "0"
                    },{
                    "mData": "1"
                    }, {
                    "mData": "2"
                    },{
                    "mData": "3"
                    }, {
                    "mData": "4"
                    },
                    //  {
                    // "mData": "5"
                    // }, 
                    {
                    "mData": "6"
                    }, {
                    "mData": "7"
                    }
                ],
                "ajax": {
                    url: baseuri + "admin/listar-contratos/"+user_id,
                    type: "get",
                    dataType: "json",
                    error: function(e) {
                      console.log(e.responseText);
                    }
                },
            });
    }
</script>