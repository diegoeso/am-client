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
            Cargar archivo Serfin
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item">
                Serfin
            </li>
            <li class="breadcrumb-item active">
                Cargar archivo
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item">
                    <a aria-expanded="true" class="nav-link active" data-toggle="tab" href="#subir_archivo" role="tab">
                        Subir archivo
                    </a>
                </li>
                <li class="nav-item">
                    <a aria-expanded="false" class="nav-link" data-toggle="tab" href="#archivo_cargado" role="tab">
                        Archivos cargados
                    </a>
                </li>
                <li class="nav-item">
                    <a aria-expanded="false" class="nav-link" data-toggle="tab" href="#validacion" role="tab">
                        Validaciones
                    </a>
                </li>
                <li class="nav-item">
                    <a aria-expanded="false" class="nav-link" data-toggle="tab" href="#respuesta" role="tab">
                        Respuestas
                    </a>
                </li>
            </ul>


            <!-- Tab panes -->
            <div class="tab-content">
                <div aria-expanded="true" class="tab-pane active" id="subir_archivo" role="tabpanel">
                    <div class="card-body">
                        <form action="javascript:;" enctype="multipart/form-data" id="subir_archivo" method="POST" role="form">
                            <input id="token" name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <legend>
                                Subir archivo
                            </legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input accept="application/vnd.ms-excel" class="form-control" id="file" name="file" placeholder="Archivo" type="file">
                                        </input>
                                        <br/>
                                        @error('file')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm" type="submit">
                                Enviar archivo
                            </button>
                        </form>
                    </div>
                </div>
                <!--second tab-->
                <div aria-expanded="false" class="tab-pane" id="archivo_cargado" role="tabpanel">
                    <div class="card-body">
                        @php
                        $files = Storage::disk('sftp')->files('Inbox')
                        @endphp
                        <div class="row text-center">
                            @foreach ($files as $f)
                            @if (substr($f, 13,8) == date('Ymd'))
                            <div class="card m-lg-5" style="width: 18rem; text-align: center; align-items: center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ substr($f, 6) }}
                                    </h5>
                                    <br/>
                                    <a class="btn btn-warning btn-block" href="{{ route('download_sftp_inbox', substr($f, 6)) }}">
                                        <span class="fa fa-download">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            @endif

                            @endforeach
                        </div>
                    </div>
                </div>
                <div aria-expanded="false" class="tab-pane" id="respuesta" role="tabpanel">
                    <div class="card-body">
                        @php
                        $files = Storage::disk('sftp')->allFiles('Outbox')
                        @endphp
                        <div class="row text-center">
                            @foreach ($files as $f)
                            @if (substr($f, 15,8) == date('Ymd') && preg_match("/[A-Z0-9]+C/", $f))
                            <div class="card m-lg-5" style="width: 20rem; text-align: center; align-items: center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ substr($f, 7) }}
                                    </h5>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a class="btn btn-warning btn-block" href="{{ route('downloadSFTP', substr($f, 7) ) }}">
                                                <i class="fas fa-text-width">
                                                </i>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-info btn-block" href="{{ route('download_excel', substr($f, 7) ) }}">
                                                <i class="fas fa-file-excel">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div aria-expanded="false" class="tab-pane" id="validacion" role="tabpanel">
                    <div class="card-body">
                        @php
                        $files = Storage::disk('sftp')->allFiles('Outbox')
                        @endphp
                        <div class="row text-center">
                            @foreach ($files as $f)
                            @if (substr($f, 15,8) == date('Ymd') && preg_match("/[A-Z0-9]+V/", $f))
                            <div class="card m-lg-5" style="width: 20rem; text-align: center; align-items: center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ substr($f, 7) }}
                                    </h5>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-warning btn-block" href="{{ route('downloadSFTP', substr($f, 7) ) }}">
                                                <i class="fas fa-download">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $("#subir_archivo").bind("submit",function(event){
            event.preventDefault();
            var token = $("#token").val();

            // var formData= new FormData;
            // formData.append("file", $("input[name=file]")[0].files[0]);
            var form = $("#subir_archivo");
            var data = new FormData(form[0]);
            // console.log(formData);
            $.ajax({
                url: '{{ route('cobranza.excel') }}',
                type:"POST",
                data:data,
                processData:false,
                contentType:false,
                cache:false,
                headers: {'X-CSRF-TOKEN': token},
                beforeSend:function(){
                    Swal.fire({
                        title: 'Cargando Archivo',
                        html: 'Se esta cargando el archivo...',
                        timerProgressBar: true,
                        allowOutsideClick:false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success:function(res){
                    if (res.estatus == true) {
                        Swal.DismissReason.close;
                        Swal.fire(
                            'Alerta',
                            'Se ha cargado un archivo con: '+res.registros+' registros',
                            'success'
                        );
                    }else{
                        Swal.DismissReason.close;
                    }
                }
            });


        });
    });
</script>
@stop
