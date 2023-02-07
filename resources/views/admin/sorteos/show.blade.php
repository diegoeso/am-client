@extends('layouts.admin.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            <a href="{{ route('dashboard') }}">
                Dashboard
            </a>
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Sorteos
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-actions">
                    <a class="btn btn-info btn-sm" href="{{ route('sorteos.download', $sorteo->id) }}" id="btnDownload">
                        <span>
                            <i class="fas fa-file-excel-o">
                            </i>
                            Exportar datos
                        </span>
                    </a>
                </div>
                <h4 class="card-title m-b-0">
                    Registros del sorteo de {{ $sorteo->convenio }}
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover dataTable" id="table_registros" role="grid" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th aria-sort="ascending" class="sorting_asc">
                                    Folio
                                </th>
                                <th aria-controls="" aria-label="" aria-sort="ascending" class="sorting_asc" colspan="1" rowspan="1" tabindex="0">
                                    Nombre
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Correo Electrónico
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Teléfono
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Teléfono oficina o casa
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    No. Empleado
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0" width="80">
                                    Creado
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registros as $registro)
                            <tr>
                                <td>
                                    {{ $registro->id }}
                                </td>
                                <td>
                                    {{ $registro->nombre_completo . ' ' . $registro->apellidos }}
                                </td>
                                <td>
                                    {{ $registro->email }}
                                </td>
                                <td>
                                    {{ $registro->telefono_casa }}
                                </td>
                                <td>
                                    {{ $registro->telefono_celular }}
                                </td>
                                <td>
                                    {{ $registro->numero_empleado }}
                                </td>
                                <td>
                                    {{ $registro->created }}
                                </td>
                            </tr>
                            @endforeach
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
        $('#table_registros').DataTable();

        // $('#btnDownload').on('click', function(event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url: $(this).data('url'),
        //         type: 'GET',
        //         dataType: 'JSON',
        //     })
        //     .done(function() {
        //         console.log("success");
        //     })
        //     .fail(function() {
        //         console.log("error");
        //     })
        //     .always(function() {
        //         console.log("complete");
        //     });
            
        // });
    });
</script>
@endsection
