<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <small class="text-muted">
                Folio
            </small>
            <h5>
                {{ $reservacion->id }}
            </h5>
        </div>
        <div class="col-md-6">
            <small class="text-muted">
                Titulo
            </small>
            <h6>
                {{ $reservacion->title }}
            </h6>
        </div>
        <div class="col-md-6">
            <small class="text-muted">
                Cliente
            </small>
            <h6>
                {{ $reservacion->cliente->fullName }}
            </h6>
        </div>
        <div class="col-md-6">
            <small class="text-muted">
                Reservado a nombre de
            </small>
            <h6>
                {{ $reservacion->nombre_de_quien_sera_la_reservacion }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Email
            </small>
            <h6>
                {{ ($reservacion->email) ? $reservacion->email : $reservacion->cliente->username  }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Telefono
            </small>
            <h6>
                {{ $reservacion->telefono }}
            </h6>
        </div>
        <div class="col-md-6">
            <small class="text-muted">
                Fecha de check-in y check-out
            </small>
            <h6>
                {{ $reservacion->fecha_de_ingreso . " " . $reservacion->entrada . " - " . $reservacion->fecha_de_salida  . " " . $reservacion->salida }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Destino
            </small>
            <h6>
                {{ $reservacion->destino }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Estatus
            </small>
            <h6>
                {{ $reservacion->estatus }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Creado
            </small>
            <h6>
                {{ $reservacion->created }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Hotel
            </small>
            <h6>
                {{ $reservacion->hotel }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Habitaciones
            </small>
            <h6>
                {{ $reservacion->habitaciones }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Clave
            </small>
            <h6>
                {{ $reservacion->clave }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Contratos asociados
            </small>
            <h6>
                <ul>
                    @foreach ($reservacion->contratos as $con)
                    <li>
                        {{ $con->contrato_id }}
                    </li>
                    @endforeach
                </ul>
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Detalles
            </small>
            <h6>
                {{ $reservacion->detalle }}
            </h6>
        </div>
    </div>
    @if ($reservacion->fecha_de_pago != null)
    <div class="row">
        <div class="col-md-4">
            <small class="text-muted">
                Fecha de pago
            </small>
            <h6>
                {{ $reservacion->fecha_de_pago }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Cantidad $
            </small>
            <h6>
                {{ $reservacion->cantidad_pago }}
            </h6>
        </div>
    </div>
    @endif
     @if ($reservacion->fecha_de_pago_1 != null)
    <div class="row">
        <div class="col-md-4">
            <small class="text-muted">
                Fecha de pago 1
            </small>
            <h6>
                {{ $reservacion->fecha_de_pago_1 }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Cantidad $
            </small>
            <h6>
                {{ $reservacion->cantidad_pago_1 }}
            </h6>
        </div>
    </div>
    @endif
     @if ($reservacion->fecha_de_pago_2 != null)
    <div class="row">
        <div class="col-md-4">
            <small class="text-muted">
                Fecha de pago 2
            </small>
            <h6>
                {{ $reservacion->fecha_de_pago_2 }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Cantidad $
            </small>
            <h6>
                {{ $reservacion->cantidad_pago_2 }}
            </h6>
        </div>
    </div>
    @endif
     @if ($reservacion->fecha_de_pago != null)
    <div class="row">
        <div class="col-md-4">
            <small class="text-muted">
                Fecha de pago 3
            </small>
            <h6>
                {{ $reservacion->fecha_de_pago_3 }}
            </h6>
        </div>
        <div class="col-md-4">
            <small class="text-muted">
                Cantidad $
            </small>
            <h6>
                {{ $reservacion->cantidad_pago_3 }}
            </h6>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-dark btn-sm" href="{{ route('pdf_reserver', $reservacion->id) }}" target="_blank">
                Descargar
            </a>
        </div>
    </div>
</div>