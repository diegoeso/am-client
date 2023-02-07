<form action="{{ $url }}" id="formConcal" method="{{ $method }}">
    <input id="create_convenio" name="create_convenio" type="hidden" value="0"/>
    <div class="modal-body" id="modal-body">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputPassword4">
                    Empresa
                </label>
                <input class="form-control" id="empresa" name="empresa" placeholder="Nombre de la empresa" type="text">
                </input>
                <span class="text-danger error-empresa errors">
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">
                    Pagina web
                </label>
                <input class="form-control" id="pagina_web" name="pagina_web" placeholder="Sitio web" type="text">
                </input>
                <span class="text-danger error-pagina_web errors">
                </span>
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">
                    No. de empleados
                </label>
                <input class="form-control" id="no_empleados" name="no_empleados" placeholder="# Empleados" type="text">
                </input>
                <span class="text-danger error-no_empleados errors">
                </span>
            </div>
            <div class="form-group col-md-5">
                <label for="inputEmail4">
                    Estado
                </label>
                <input class="form-control" id="estado" name="estado" placeholder="Estado" type="text">
                </input>
                <span class="text-danger error-estado errors">
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail4">
                    Pais
                </label>
                <select class="form-control" id="paise_id" name="paise_id">
                    @foreach ($paises as $pais)
                    <option value="{{ $pais->id }}">
                        {{ $pais->title }}
                    </option>
                    @endforeach
                </select>
                <span class="text-danger error-paise_id errors">
                </span>
            </div>
        </div>
        <hr/>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputPassword4">
                    Siguiente llamada
                </label>
                <input autocomplete="off" class="form-control" id="siguiente_llamada" name="siguiente_llamada" type="text">
                </input>
                <span class="text-danger error-siguiente_llamada errors">
                </span>
            </div>
            <div class="form-group col-md-3">
                <label for="inputPassword4">
                    Estatus
                </label>
                <select class="form-control " id="estatus" name="estatus">
                    @foreach ($estatus_concal as $estatus => $key)
                    <option class="" value="{{ $estatus }}">
                        {{ $key }}
                    </option>
                    @endforeach
                </select>
                <span class="text-danger error-estatus errors">
                </span>
            </div>
            <div class="form-group col-md-2">
                <label for="inputPassword4">
                    Calificación
                </label>
                <select class="js-example-responsive js-states form-control " id="calificacion" name="calificacion">
                    @for ($i = 0; $i <=10 ; $i++)
                    <option value="{{ $i }}">
                        {{ $i }}
                    </option>
                    @endfor
                </select>
                <span class="text-danger error-calificacion errors">
                </span>
            </div>
            <div class="col-md-4">
                <label for="">
                    Redes sociales
                </label>
                <div class="switch">
                    <label>
                        NO
                        <input id="redes" name="redes" type="checkbox">
                            <span class="lever">
                            </span>
                            SI
                        </input>
                    </label>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="inputPassword4">
                    Conmutador
                </label>
                <input class="form-control" id="conmutador" name="conmutador" type="text">
                </input>
                <span class="text-danger error-conmutador errors">
                </span>
            </div>
        </div>
        <hr/>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputPassword4">
                    Contacto
                </label>
                <input class="form-control" id="contacto" name="contacto" placeholder="Nombre del contacto" type="text">
                </input>
                <span class="text-danger error-contacto errors">
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail4">
                    Telefonos
                </label>
                <input class="form-control" id="telefonos" name="telefonos" placeholder="" type="text">
                </input>
                <span class="text-danger error-telefonos errors">
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail4">
                    Correo electronico
                </label>
                <input class="form-control" id="email" name="email" placeholder="Correo electronico" type="text">
                </input>
                <span class="text-danger error-email errors">
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">
                    Asistente
                </label>
                <input class="form-control" id="asistente" name="asistente" placeholder="Nombre del asistente" type="text">
                </input>
                <span class="text-danger error-asistente errors">
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail4">
                    Telefono(s)
                </label>
                <input class="form-control" id="asistente_telefono" name="asistente_telefono" type="text">
                </input>
                <span class="text-danger error-asistente_telefono errors">
                </span>
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail4">
                    Correo Elecronico
                </label>
                <input class="form-control" id="asistente_email" name="asistente_email" placeholder="" type="email">
                </input>
                <span class="text-danger error-asistente_email errors">
                </span>
            </div>
            <div class="form-group col-md-12">
                <label for="inputEmail4">
                    Observaciones
                </label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="8" style="width:100%;">
                </textarea>
                <span class="text-danger error-asistente_email errors">
                </span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">
            Cerrar
        </button>
        @if ($method == 'POST' || Auth::id() == $concal->user_id || Auth::user()->role == 'admin')
        <button class="btn btn-primary btn-sm" type="submit">
            Guardar
        </button>
        @endif
    </div>
</form>
<script>
    $('#siguiente_llamada').datepicker({
        dateFormat: "yy-mm-dd",
        startDate: '-1d',
        autoclose:true,
        language: 'es'
    });
</script>
@isset ($concal)
<script>
    var concal = @json($concal);
    $.each(concal, function(index, val) {
        $('#'+index).val(val);
    });

    if (concal['redes'] == 2) {
        $('#redes').attr('checked', true);
    }

    $("#estatus option").each(function(){
        if ($(this).val() == concal.estatus){
            $(this).attr('selected', 'true');
        }
    });

    $("#paise_id option").each(function(){
        if ($(this).val() == concal.paise_id){
            $(this).attr('selected', 'true');
        }
    });
</script>
@endisset
