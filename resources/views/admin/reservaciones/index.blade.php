@extends('layouts.admin.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor text-capitalize">
            Benvenid@: {{ Auth::user()->fullName }}
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Dashboard
            </li>
        </ol>
    </div>
</div>
{{--
<dashboard>
</dashboard>
--}}
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                @foreach ($data as $d)
                <div class="card">
                    <div class="card-header">
                        {{ $d->paise_title }}
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $d->title }}
                        </h4>
                        <a class="btn btn-dark btn-sm m-2" href="#">
                            {{ $d->NC }} NC
                        </a>
                        <a class="btn btn-dark btn-sm" href="#">
                            {{ $d->NR }} NR
                        </a>
                        <a class="btn btn-dark btn-sm" href="#">
                            {{ $d->EP }} EP
                        </a>
                        <a class="btn btn-dark btn-sm" href="#">
                            {{ $d->CE }} CE
                        </a>
                        <a class="btn btn-dark btn-sm" href="#">
                            {{ $d->CA }} CA
                        </a>
                        <a class="btn btn-dark btn-sm" href="#">
                            {{ $d->PN }} PN
                        </a>
                        <a class="btn btn-dark btn-sm" href="#">
                            {{ $d->RE }} RE
                        </a>
                        <a class="btn btn-dark btn-sm" href="#">
                            {{ $d->OK }} OK
                        </a>
                        <a class="btn btn-dark btn-sm" href="#">
                            {{ $d->SG }} SG
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title">
                    Mis asignaciones
                </h4>
                <table class="table table-hover" id="mis_asignaciones">
                    <thead>
                        <th>
                            <tr>
                            </tr>
                        </th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
         var asignadas = $('#mis_asignaciones').DataTable({
            'responsive': true,
            'searching': true,
            'lengthMenu': [[10, 50, -1], [10, 50, "Todo"]],
            'pageLength': 10,
            'order': [0,'DESC'],
            "aoColumns": [{
                "mData": "1"
                }
            ],
            "ajax": {
                url: baseadmin + "mis-reservaciones-asignadas",
                type: "get",
                dataType: "json",
                error: function(e) {
                  console.log(e.responseText);
                }
            },
        });

        var asignadas = $('#mis_asignaciones').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            order: [0, 'desc'],
            // bInfo: false,
            ajax: baseadmin + "mis-reservaciones-asignadas",
            columns: [
                {data: 'info_reserva', name: 'info_reserva'},
            ],
            "drawCallback": function() {
                if (this.fnSettings().fnRecordsTotal() < 11) {
                    $('.dataTables_paginate').hide();
                }
            },
        });

    });
</script>
@stop
