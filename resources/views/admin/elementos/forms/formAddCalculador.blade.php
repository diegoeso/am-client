<form action="" id="add_pagos_contrato">
    @csrf
    <input id="contrato_id" name="contrato_id" type="hidden" value="{{ (isset ($contrato_id)) ? $contrato_id : '' }}"/>
    <input id="modified_pay" name="modified_pay" type="hidden" value="nuevo"/>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-12">
                        <label for="metodo_pago">
                            Metodo de pago
                        </label>
                        <select class="form-control" id="metodo_pago" name="metodo_pago">
                            <option selected="" value="">
                                Selecciona una opción
                            </option>
                            <option value="semanal">
                                SEMANAL: Un día por semana
                            </option>
                            <option value="catorcenal">
                                CATORCENAL: Un día por semana intercalada
                            </option>
                            <option value="quincenal_preciso">
                                QUINCENAL PRECISO
                            </option>
                            <option value="quincenal_clasico">
                                QUINCENAL CLÁSICO: Cada siguiente dia 15 o último del mes
                            </option>
                            <option value="mensual">
                                MENSUAL: Cada cierto día del mes
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-lg-4 col-md-6">
                        <label for="inputPassword4">
                            Fecha del siguiente cobro
                        </label>
                        <input autocomplete="off" class="form-control fecha_primer_descuento input-limit-datepicker" id="fecha_primer_descuento" name="fecha_primer_descuento" type="date" value="{{ (isset($fecha_inicial)) ? $fecha_inicial->fecha_de_cobro : '' }}"/>
                    </div>
                    <div class="form-group col-lg-4 col-md-6">
                        <label for="inputPassword4">
                            Segmentos
                            <span id="rangeval">
                                {{ ($con->estancia) ? $con->estancia->cuotas : '1'  }}
                                {{-- {{ (isset($con->estancia) && ($con->estancia->est_especial == 1)) ? $con->estancia->cuotas : '24'  }} --}}
                            </span>
                        </label>
                        <input class="form-control-range mt-2" id="num_segmentos" max="80" min="1" name="num_segmentos" oninput="$('#rangeval').html($(this).val())" type="range" value="{{ $con->estancia->cuotas  }}"/>
                        {{--
                        <input class="form-control-range mt-2" id="num_segmentos" max="50" min="1" name="num_segmentos" oninput="$('#rangeval').html($(this).val())" type="range" value=" {{ (isset($con->estancia) && ($con->estancia->est_especial == 1)) ? $con->estancia->cuotas : '24'  }}"/>
                        --}}
                    </div>
                    <div class="col-md-12" id="fechas_xy" style="display: none">
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-4">
                                <label for="inputPassword4">
                                    Dia x del mes
                                </label>
                                {{--
                                <input class="form-control" id="dia_x" name="dia_x" type="date"/>
                                --}}
                                <select class="form-control" id="dia_x" name="dia_x">
                                    @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">
                                        {{ $i }}
                                    </option>
                                    @endfor
                                </select>
                                <span class="text-danger error-numero_tarjeta errors">
                                </span>
                            </div>
                            <div class="form-group col-lg-4 col-md-4">
                                <label for="inputPassword4">
                                    Dia y del mes
                                </label>
                                {{--
                                <input class="form-control" id="dia_y" name="dia_y" type="date"/>
                                --}}
                                <select class="form-control" id="dia_y" name="dia_y">
                                    @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">
                                        {{ $i }}
                                    </option>
                                    @endfor
                                </select>
                                <span class="text-danger error-numero_tarjeta errors">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mr-0">
                        <button class="btn btn-info btn-sm" id="btnCalcularPagos" type="button">
                            <i class="fas fa-calculator">
                            </i>
                            Calcular
                        </button>
                    </div>
                    <div class="col-md-12 table-responsive mt-3" id="listarPagos" style="height: 300px;">
                        <table class="table table-hover" id="tablePagos">
                            <tbody id="tableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">
            Cerrar
        </button>
        <button class="btn btn-primary btn-sm" type="submit">
            Generar
        </button>
    </div>
</form>
{{-- @section('script') --}}
    {{-- expr --}}
<script>
    var est = @json($con->estancia);
    $('#metodo_pago').change(function(event){
            event.preventDefault();
            $val = $(this).val();
            if($val == 'semanal'){
                $('#num_segmentos').val(est['cuotas']);
            }else if($val == 'mensual'){
                $('#num_segmentos').val(12);
            }else if (est['est_especial'] || est['estancia_especial'] == 1 ) {
                $('#num_segmentos').val(est['cuotas']);
                 
            }else{
                $('#num_segmentos').val(est['cuotas']);
            }
            
        })

        $('body #fecha_primer_descuento').datepicker({
            dateFormat: "yy-mm-dd",
            startDate: '-1d',
            endDate: '+2m',
            autoclose:true,
            language: 'es'
        });
        // 
        // $('body #fecha_primer_descuento').daterangepicker({
        //     singleDatePicker: true,
        //     dateFormat: "yy-mm-dd",
        //     // startDate: starrDate(),
        //     // minDate: starrDate(),
        //     // endDate: starrDate().add(noches * num_folios, 'days'),
        //     autoUpdateInput: false,
        //     buttonClasses: ['btn', 'btn-sm'],
        //     applyClass: 'btn-success',
        //     cancelClass: 'btn-inverse',
        //     dateLimit: {
        //         // days: noches * num_folios
        //     }
        // });
</script>
{{-- @endsection --}}
