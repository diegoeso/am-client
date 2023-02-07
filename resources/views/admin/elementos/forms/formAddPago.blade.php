<form action="{{ route('pagos.add_pago') }}" id="form_add_pago" method="post">
    @csrf
    <input id="contrato_id" name="contrato_id" type="hidden" value=""/>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-row">
                    <div class="form-group col-lg-6 col-md-6">
                        <label for="inputPassword4">
                            Cantidad
                        </label>
                        <input class="form-control" id="cantidad" name="cantidad" type="text"/>
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label for="inputPassword4">
                            Fecha de cobro
                        </label>
                        <input autocomplete="off" class="form-control datepicker" id="fecha_de_cobro" name="fecha_de_cobro"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">
            {{ __('messages.cerrar') }}
        </button>
        <button class="btn btn-primary btn-sm" type="submit">
            {{ __('messages.guardar') }}
        </button>
    </div>
</form>
<script>
    $('#fecha_de_cobro').datepicker({
        dateFormat: "yy-mm-dd",
        autoUpdateInput: true,
    });
</script>
