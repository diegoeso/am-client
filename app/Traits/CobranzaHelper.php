<?php

namespace App\Traits;

use App\Models\ActualizarSerfin;
use App\Exports\ErroresExport;
use App\Exports\OrigenExport;
use App\Exports\RespuestaExcelExport;
use App\Imports\OrigenImport;
use App\Models\Origen;
use App\Models\Pago;
use DB;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
trait CobranzaHelper
{
    public function createDirectory()
    {
        $year   = date("y");
        $month  = date("m");
        $day    = date("d");
        $public = public_path() . "/files/cobranza/";

        if (!file_exists($public . $year)) {
            mkdir($public . $year);
        }

        if (!file_exists($public . $year . "/$month")) {
            mkdir($public . $year . "/$month");
        }

        if (!file_exists($public . $year . "/$month/$day")) {
            mkdir($public . $year . "/$month/$day");
        }

        return true;
    }

    //Procesar archivo excel que se sube, de este archivo generar archivo txt el cual se cargará al ftp del banco. (cobranza => banco)
    public function processExcelFile(Request $request)
    {
        $directory     = public_path() . "/files/cobranza/" . date('y/m/d');
        $date          = date('Ymd');
        $fileName      = "SE20273" . $date . ".TXT";
        $directoryFile = $directory . "/" . $fileName;

        $existe_file = 'Inbox/' . $fileName;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
        }

        $excel = Excel::toArray(new OrigenImport, $request->file('file'));

        $headers = $this->getHeader($date); //Obtenemos los headers del archivo, estos no cambiaran.

        $this->createDirectory();
        $myfile = fopen($directoryFile, "wr") or die("Unable to open file!");

        //Agrega el Header
        foreach ($headers as $header) //pintamos el header en el archivo
        {
            fwrite($myfile, $header);
        }

        //Agregamos los datos del archivo excel
        $secuencia = 2; //Numero de registros, lo iniciamos en 2 ya que se cargo l header y cuenta como 1
        $sum       = 0; //Almacenamos la cantidad total a cobrar.
        $count     = 0;

        foreach ($excel[0] as $row) {
            $client = $this->getClientData($secuencia, $date, $row);
            foreach ($client as $data) {
                fwrite($myfile, $data);
            }

            fwrite($myfile, "\n");
            $secuencia++;
        }
        $sum += count($excel[0]);
        // $sum += $row[0];
        fwrite($myfile, "\n");

        //Agregamos footer
        $footer = $this->getFooter($secuencia, $sum);
        foreach ($footer as $data) {
            fwrite($myfile, $data);
        }

        fwrite($myfile, "\n");
        $estatus = fclose($myfile);

        if ($estatus == true) {
            Storage::disk('sftp')->put('Inbox/' . $fileName, fopen($directoryFile, 'r+'));
            return response()->json(['estatus' => true, 'registros' => count($excel[0])]);
        }
        return response()->json(['estatus' => false]);
    }

    //Header (cobranza => banco)
    public function getHeader($fecha)
    {
        /* $headers = array(
        str_pad(1, 2, "0", STR_PAD_LEFT),
        str_pad(1, 7, "0", STR_PAD_LEFT),
        30,
        str_pad(12, 3, "0", STR_PAD_LEFT),
        'E',
        2,
        str_pad(1, 7, "0", STR_PAD_LEFT),
        $fecha,
        str_pad(1, 2, "0", STR_PAD_LEFT),
        str_pad(0, 27, "0", STR_PAD_LEFT),
        substr("OPERADORA TURISTICA PACIFIC TRAVEL SA DE CV", 0, 40),
        str_pad("OTP150727QP6", 18),
        str_pad(0, 182, "0"),
        );*/

        $headers = array(
            str_pad('01', 2),
            str_pad('1', 7, '0', STR_PAD_LEFT),
            str_pad('30', 2),
            str_pad('014', 3),
            str_pad('E', 1),
            str_pad('2', 1),
            str_pad('1', 7, '0', STR_PAD_LEFT),
            str_pad(date('Ymd'), 8),
            str_pad('01', 2),
            str_pad('0', 27, '0'),
            substr('OPTU TRAVEL BENEFITS', 0, 40),
            str_pad('OTB201104EU3', 18, ' '),
            str_pad('0', 182, '0') . "\n",

        );

        return $headers;
    }

    //Datos del cliente (cobranza => banco)
    public function getClientData($secuencia, $fecha, $array)
    {
        $cant   = (string) number_format((float) $array[0], 2, '', '');
        $client = array(
            str_pad(2, 2, "0", STR_PAD_LEFT),
            str_pad($secuencia, 7, "0", STR_PAD_LEFT),
            30,
            str_pad(1, 2, "0", STR_PAD_LEFT),
            str_pad($cant, 15, "0", STR_PAD_LEFT), //importe de ventas
            str_pad(0, 32, "0", STR_PAD_LEFT),
            51,
            $fecha,
            str_pad((string) $array[1], 3, "0", STR_PAD_LEFT),
            $array[2],
            $array[3],
            str_pad($array[4], 40),
            str_pad($array[5], 40),
            str_pad($array[4], 40),
            str_pad(0, 15, "0"),
            $array[8],
            $array[9],
            str_pad(0, 23, "0", STR_PAD_LEFT),
        );

        return $client;
    }

    public function getFooter($secuencia, $cantidad)
    {
        $cant   = (string) number_format((float) $cantidad, 2, '', '');
        $cant   = str_replace(".", "", $cant);
        $footer = array(
            str_pad(9, 2, "0", STR_PAD_LEFT),
            str_pad($secuencia, 7, "0", STR_PAD_LEFT),
            30,
            str_pad(1, 7, "0", STR_PAD_LEFT),
            str_pad($secuencia - 2, 7, "0", STR_PAD_LEFT), //importe de ventas
            str_pad($cant, 18, "0", STR_PAD_LEFT),
            str_pad(0, 257, "0", STR_PAD_LEFT),
        );
        return $footer;
    }

    public function showActualizarSerfin()
    {
        return view('admin.cobranza.serfin.actualizar_serfin');
    }

    //Archivo que llega del banco (respuesta diaria). Se procesa, se inserta en tabla origen y se crea archivo excel
    // (banco => cobranza)
    public function daily_response()
    {
        $directory        = "/files/cobranza/" . date('y/m/d');
        $cobranzadev      = date('Y/m/d');
        $date             = date('Ymd');
        $fileName         = "SE20273C" . $date . ".TXT";
        $directoryFile    = $directory . "/" . $fileName;
        $directoryFileDev = $cobranzadev . "/" . $fileName;
        $fileSftp         = 'Outbox/' . $fileName;
        $dir              = $this->createDirectory();
        if ($dir == true) {
            //obtenemos el archivo del buzon
            $archivo = Storage::disk('sftp')->get($fileSftp);
            //grabamos el archivo del buzon en nuestro nuevo directorio
            $path = Storage::disk('public_cobra')->put($directoryFile, $archivo);
            // Copia el archivo a cobranzadev
            if (env('APP_DEBUG') == false) {
                Storage::disk('cobranzadev')->put($directoryFileDev, $archivo);
            }

            if ($path == true) {
                // $count = $this->origen($date, $fileName, $directoryFile, $directory);
                $count = $this->origen_doble($date, $fileName, $directoryFile, $directory);
                return response()->json(['estatus' => true, 'registros' => $count]);
            }
        }
        return response()->json(['estatus' => false]);
    }
    public function origen($date, $file, $directoryFile, $directory)
    {

        $file = "SE20273C" . $date . ".xls";
        $fp   = fopen(public_path() . $directoryFile, 'r+');
        while (!feof($fp)) {
            $linea[] = fgets($fp);
        }
        fclose($fp);
        $pacific   = [];
        $home      = [];
        $registros = array_splice($linea, 1, -2);

        if (isset($registros) && is_array($registros)) {
            foreach ($registros as $k => $v) {

                $sys = explode('_', substr($v, 135, 40));
                $res = substr($sys[0], 0, 3);

                if ($res == 'opt') {
                    if (count($sys) != 1) {
                        $pacific[] = [
                            // 'importe'       => (float) substr($v, 14, 12) . "." . substr($v, 26, 2),
                            'importe'       => (float) (substr($v, 13, 15) * 0.01),
                            'fecha'         => $date,
                            'banco'         => (int) substr($v, 70, 3),
                            'tarjeta'       => substr($v, 79, 16),
                            'sys_key'       => $sys[0],
                            'pago_id'       => $sys[2],
                            'pago_segmento' => $sys[3],
                            'cliente'       => substr($v, 95, 40), //NOMBRE DEL TITULAR
                            'clave'         => (int) substr($v, 277, 2),
                            'archivo'       => $file,
                        ];
                    } else {
                        $pacific_sin_segmento[] = [
                            'importe'       => (float) substr($v, 13, 13) . "." . substr($v, 26, 2),
                            'fecha'         => $date,
                            'banco'         => (int) substr($v, 70, 3),
                            'tarjeta'       => substr($v, 79, 16),
                            'sys_key'       => $sys[0],
                            'pago_id'       => '',
                            'pago_segmento' => '',
                            'cliente'       => substr($v, 95, 40), //NOMBRE DEL TITULAR
                            'clave'         => (int) substr($v, 277, 2),
                            'archivo'       => $file,
                        ];
                    }
                } else if ($res == 'hmt' || $res == 'hmi') {
                    $home[] = [
                        'importe'       => (float) substr($v, 13, 13) . "." . substr($v, 26, 2),
                        'fecha'         => $date,
                        'banco'         => (int) substr($v, 70, 3),
                        'tarjeta'       => substr($v, 79, 16),
                        'sys_key'       => $sys[0],
                        'pago_id'       => $sys[2],
                        'pago_segmento' => $sys[3],
                        'cliente'       => substr($v, 95, 40), //NOMBRE DEL TITULAR
                        'clave'         => (int) substr($v, 277, 2),
                        'archivo'       => $file,
                    ];
                } else {
                    $folios_libres[] = [
                        'importe'       => (float) substr($v, 13, 13) . "." . substr($v, 26, 2),
                        'fecha'         => $date,
                        'banco'         => (int) substr($v, 70, 3),
                        'tarjeta'       => substr($v, 79, 16),
                        'sys_key'       => $sys[0],
                        'pago_id'       => '',
                        'pago_segmento' => '',
                        'cliente'       => substr($v, 95, 40), //NOMBRE DEL TITULAR
                        'clave'         => (int) substr($v, 277, 2),
                        'archivo'       => $file,
                    ];
                }
            }

            // dd($pacific,$pacific_sin_segmento);
            if (isset($folios_libres)) {
                \Cookie::queue('folios_libres', count($folios_libres), env('TIME_COOKIE'));
            }

            if (isset($pacific_sin_segmento)) {
                \Cookie::queue('pacific_sin_segmento', count($pacific_sin_segmento), env('TIME_COOKIE'));
            }

            \Cookie::queue('origen_home', count($home), env('TIME_COOKIE'));

            $as = ActualizarSerfin::create([
                'origen_home' => count($home),
            ]);
            session()->put(['asp' => $as->id]);

            if (count($home) > 7000) {
                foreach (array_chunk($home, 3000) as $insertData) {
                    $res_home = DB::connection('hometravel')->table('origen')->insert($insertData);
                }
            } else {
                $res_home = DB::connection('hometravel')->table('origen')->insert($home);
            }
            $res_hmi = DB::connection('hometravel')->table('origen')->where('archivo', $file)->where('sys_key', 'like', '%hmi%')->get();
            if (count($res_hmi) > 0) {

                ActualizarSerfin::where('id', session('asp'))
                    ->update(['origen_i' => 1]);

                \Cookie::queue('origen_i', true, env('TIME_COOKIE'));
            }

            ActualizarSerfin::where('id', session('asp'))
                ->update(['origen_pacific' => count($pacific)]);

            \Cookie::queue('origen_pacific', count($pacific), env('TIME_COOKIE'));
            foreach (array_chunk($pacific, count($pacific) / 4) as $insertData) {
                $res_pacific = DB::connection('mysql')->table('origen')->insert($insertData);
            }
            $res = ['home' => count($home), 'pacific' => count($pacific)];
            return $res;
        } else {
            return false;
        }
    }

    public function origen_doble($date, $file, $directoryFile, $directory)
    {

        $mb   = [];
        $file = "SE20273C" . $date . ".xls";
        $fp   = fopen(public_path() . $directoryFile, 'r+');
        while (!feof($fp)) {
            $linea[] = fgets($fp);
        }
        fclose($fp);
        $registros = array_splice($linea, 1, -2);
        if (isset($registros) && is_array($registros)) {
            foreach ($registros as $k => $v) {

                $opt = preg_split('/__/', substr($v, 135, 40));
                $res = substr($opt[0], 0, 3);
                if (isset($opt[1])) {
                    // if ($res == 'opt') {
                    if (isset($opt[2])) {
                        $aux = 1;
                        do {
                            $opt_ = explode('_', $opt[$aux]); //NUMERO DE REFERENCIA
                            $mb[] = [
                                'importe'       => (substr($v, 13, 15) * 0.01) / 2,
                                // 'fecha'         => substr($v, 62, 8), //FECHA DE COBRO TIENE QUE SER UN DIA ANTERIOR //$date,
                                'fecha'         => $date,
                                'banco'         => (int) substr($v, 70, 3),
                                'tarjeta'       => substr($v, 79, 16),
                                'sys_key'       => $opt[0],
                                'pago_id'       => $opt_[0],
                                'pago_segmento' => $opt_[1],
                                'cliente'       => substr($v, 95, 40),
                                'clave'         => (int) substr($v, 277, 2),
                                'archivo'       => $file,
                            ];
                            $aux++;

                        } while ($aux <= 2);
                    } else {
                        $opt_ = explode('_', $opt[1]); //NUMERO DE REFERENCIA
                        $mb[] = [
                            'importe'       => (substr($v, 13, 15) * 0.01),
                            // 'fecha'         => substr($v, 62, 8), //FECHA DE COBRO TIENE QUE SER UN DIA ANTERIOR,
                            'fecha'         => $date,
                            'banco'         => (int) substr($v, 70, 3),
                            'tarjeta'       => substr($v, 79, 16),
                            'sys_key'       => $opt[0],
                            'pago_id'       => $opt_[0],
                            'pago_segmento' => $opt_[1],
                            'cliente'       => substr($v, 95, 40),
                            'clave'         => (int) substr($v, 277, 2),
                            'archivo'       => $file,
                        ];

                    }
                } else {
                    $syskey[] = [
                        'importe'       => (substr($v, 13, 15) * 0.01),
                        // 'fecha'         => substr($v, 62, 8), //FECHA DE COBRO TIENE QUE SER UN DIA ANTERIOR,
                        'fecha'         => $date,
                        'banco'         => (int) substr($v, 70, 3),
                        'tarjeta'       => substr($v, 79, 16),
                        'sys_key'       => $opt[0],
                        'pago_id'       => '',
                        'pago_segmento' => '',
                        'cliente'       => substr($v, 95, 40),
                        'clave'         => (int) substr($v, 277, 2),
                        'archivo'       => $file,
                    ];
                }
            }

            \Cookie::queue('origen_mb', count($mb), env('TIME_COOKIE'));
            foreach (array_chunk($mb, count($mb) / 4) as $insertData) {
                $res_mb = DB::connection('mysql')->table('origen')->insert($insertData);
            }
            $res = ['mb' => count($mb)];

            $flight = ActualizarSerfin::updateOrCreate(
                ['created_at' => date('Y-m-d')],
                ['origen_pacific' => count($mb)]
            );

            return $res;
        } else {
            return false;
        }
    }

    public function getDataOrigen($dato, $date, $file)
    {

        $sys = explode('_', substr($dato, 135, 30));
        if (!isset($sys[1])) {
            return 0;
        }
        $dato = [
            'importe'       => (float) substr($dato, 13, 13) . "." . substr($dato, 26, 2),
            'fecha'         => $date,
            'banco'         => (int) substr($dato, 70, 3),
            'tarjeta'       => substr($dato, 79, 16),
            'sys_key'       => $sys[0],
            'pago_id'       => $sys[2],
            'pago_segmento' => $sys[3],
            'cliente'       => substr($dato, 95, 40), //NOMBRE DEL TITULAR
            'clave'         => (int) substr($dato, 277, 2),
            'archivo'       => $file,
        ];

        return $dato;
    }

    public function getExcel($datos, $file, $directory)
    {
        $directory = "/files/cobranza/" . date('y/m/d');
        $file      = str_replace(".TXT", "", $file);
        $date      = date('Ymd');
        $file2     = "SE20273C" . $date . '.xlsx';
        return Excel::store(new OrigenExport($datos), $file2, 'excel');
    }

    public function historial(Request $request)
    {
        return view('historial');
    }

    public function get_historial($fecha)
    {

        $anio = substr($fecha, 2, 2);
        $mes  = substr($fecha, 4, 2);
        $dia  = substr($fecha, 6, 2);
        // $files = Storage::disk('public')->exists('SE20273C20191227.TXT');
        $files = file_exists(public_path() . '/storage/files/cobranza/' . $anio . '/' . $mes . '/' . $dia . '/SE20273C' . $fecha . '.TXT');
        if ($files != true) {

            return response()->json(false);
        }
        $data['res']     = true;
        $data['archivo'] = 'SE20273C' . $fecha . '.TXT';
        return response()->json($data);
        // return response()->download(public_path() . '/storage/files/19/12/26/SE20273C20191226.TXT');

    }

    public function download_file(Request $request)
    {
        $fecha = $request->file;

        $anio = substr($fecha, 2, 2);
        $mes  = substr($fecha, 4, 2);
        $dia  = substr($fecha, 6, 2);

        $files = file_exists(public_path() . '/storage/files/cobranza' . $anio . '/' . $mes . '/' . $dia . '/SE20273C' . $fecha . '.TXT');

        if ($files != true) {
            return response()->json(false);
        }

        return response()->download(public_path() . '/storage/files/cobranza' . $anio . '/' . $mes . '/' . $dia . '/SE20273C' . $fecha . '.TXT');
    }

    public function download_sftp($archivo)
    {
        $file = 'Outbox/' . $archivo;
        return Storage::disk('sftp')->download($file);
    }

    public function download_sftp_inbox($archivo)
    {
        $file = 'Inbox/' . $archivo;
        return Storage::disk('sftp')->download($file);
    }

    public function respuesta_serfin()
    {
        return view('respuesta-serfin');
    }

    public function consultar_errores()
    {
        $date  = date('Ymd');
        $file2 = "SE20273C" . $date . '.xls';

        $res = DB::connection('mysql')->table('origen')
            ->select('pagos.contrato_id', 'origen.pago_id', 'origen.pago_segmento as segmento_archivo', 'origen.cliente', 'origen.importe as importe_cobrado_santander', 'origen.clave as clave_archivo_santander', DB::raw('CONCAT("CANTIDAD COBRADA EN EL ARCHIVO: ", serfinrespuestas.motivo_del_rechazo, " POR ", serfinrespuestas.cantidad) AS cobrado_en_archivo'), 'serfinrespuestas.resultado')
            ->join('pagos', 'origen.pago_id', '=', 'pagos.id')
            ->join('serfinrespuestas', 'origen.pago_id', '=', 'serfinrespuestas.pago_id')
            ->where('archivo', $file2)
            ->whereIn('pagos.estatus', ['Pagado'])
            ->groupBy('origen.pago_id')
            ->orderBy('pagos.estatus', 'ASC')
            ->get();

        //DB::connection('mysql')->table('actualizacion_serfin')->insert(['errores_pacific' => count($res)]);
        \Cookie::queue('errores_pacific', count($res), env('TIME_COOKIE'));

        return $res;
    }

    public function errores()
    {
        $res = $this->consultar_errores();
        // dd($res);
        if (count($res) > 0) {
            return response()->json(['estatus' => true, 'registros' => $res]);
        }
        return response()->json(['estatus' => false]);
    }

    public function download_errores()
    {
        $res = $this->consultar_errores();
        return Excel::download(new ErroresExport($res), 'Errores-' . date('Ymd') . '.xls');
    }

    public function insert_serfin()
    {
        $date  = date('Ymd');
        $file2 = "SE20273C" . $date . '.xls';
        $datos = DB::connection('mysql')->table('pagos')
            ->select(
                'pagos.contrato_id',
                'origen.pago_id',
                DB::raw('case origen.clave when 0 then "Pagado" else "Rechazado" end as resultado'),
                'origen.importe as cantidad',
                DB::raw('now() as created'),
                DB::raw('STR_TO_DATE(origen.fecha, "%Y%m%d") as fecha_de_respuesta'),
                DB::raw('concat(" ", origen.archivo, ":", stdr_respuestas.rest_1) as motivo_del_rechazo')
            )
            ->join('origen', 'pagos.id', '=', 'origen.pago_id')
            ->join('stdr_respuestas', 'origen.clave', '=', 'stdr_respuestas.clave')
            ->where('origen.archivo', $file2)
            ->where('pagos.estatus', '<>', 'Pagado')
            ->get();

        if (count($datos) > 0) {
            $cont = 0;
            foreach ($datos as $key) {
                $serfin[] = [
                    'contrato_id'        => $key->contrato_id,
                    'pago_id'            => $key->pago_id,
                    'resultado'          => $key->resultado,
                    'cantidad'           => $key->cantidad,
                    'created'            => $key->created,
                    'fecha_de_respuesta' => $key->fecha_de_respuesta,
                    'motivo_del_rechazo' => $key->motivo_del_rechazo,
                ];
                $cont += 1;
            }

            foreach (array_chunk($serfin, 5000) as $res) {
                $result = DB::connection('mysql')->table('serfinrespuestas')->insert($res);
            }

            ActualizarSerfin::where('id', session('asp'))
                ->update(['srf_pacific' => $cont]);

            // DB::connection('mysql')
            //     ->table('actualizacion_serfin')
            //     ->update(['srf_pacific' => $cont])
            //     ->where('id', session()->get('as'));

            \Cookie::queue('srf_pacific', $cont, env('TIME_COOKIE'));
            return response()->json(['estatus' => true, 'registros' => $cont]);
        } else {
            return response()->json(['estatus' => false, 'mensaje' => 'No se ha descargado la respuesta del buzon. (Paso 1)']);
        }
    }

    public function update_serfin()
    {
        $date  = date('Ymd');
        $file2 = "SE20273C" . $date . '.xls';
        $datos = DB::connection('mysql')->table('pagos')
            ->join('origen', 'pagos.id', '=', 'origen.pago_id')
            ->join('stdr_respuestas', 'origen.clave', '=', 'stdr_respuestas.clave')
            ->where('origen.archivo', $file2)
            ->where('pagos.estatus', '<>', 'Pagado')
            ->update(
                [
                    'pagos.estatus'                => DB::raw('case origen.clave when 0 then "Pagado" else "Rechazado" end'),
                    'pagos.cantidad'               => DB::raw('origen.importe'),
                    'pagos.fecha_de_pago'          => DB::raw('STR_TO_DATE(origen.fecha, "%Y%m%d")'),
                    'pagos.pagado_desde_santander' => DB::raw('case origen.clave when 1 then 0 else 1 end'),
                    'pagos.modified'               => DB::raw('now()'),
                ]
            );

        // DB::connection('mysql')->table('actualizacion_serfin')->insert(['srf_pacific_update' => $datos, 'res1' => 1]);

        ActualizarSerfin::where('id', session('asp'))
            ->update(['srf_pacific_update' => $datos, 'res1' => 1]);

        \Cookie::queue('srf_pacific_update', $datos, env('TIME_COOKIE'));
        \Cookie::queue('res1', true, env('TIME_COOKIE'));
        return response()->json(['estatus' => true, 'registros' => $datos]);
    }

    public function delete_origen()
    {
        $date  = date('Ymd');
        $file2 = "SE20273C" . $date . '.xls';
        $res   = DB::connection('mysql')->delete('delete from origen where archivo = ?', [$file2]);
        if ($res > 0) {
            return response()->json(['estatus' => true, 'registros' => $res]);
        }

        return response()->json(['estatus' => false]);
    }

    // Solo pagados
    public function insert_serfin_pagados()
    {
        $date  = date('Ymd');
        $file2 = "SE20273C" . $date . '.xls';
        $datos = DB::connection('mysql')->table('pagos')
            ->select(
                'pagos.contrato_id',
                'origen.pago_id',
                DB::raw('case origen.clave when 0 then "Pagado" else "Rechazado" end as resultado'),
                'origen.importe as cantidad',
                DB::raw('now() as created'),
                DB::raw('STR_TO_DATE(origen.fecha, "%Y%m%d") as fecha_de_respuesta'),
                DB::raw('concat(" ", origen.archivo, ":", stdr_respuestas.rest_1) as motivo_del_rechazo')
            )
            ->join('origen', 'pagos.id', '=', 'origen.pago_id')
            ->join('stdr_respuestas', 'origen.clave', '=', 'stdr_respuestas.clave')
            ->where('origen.archivo', $file2)
            ->where('pagos.estatus', '<>', 'Pagado')
            ->where('origen.clave', 0)
            ->get();

        if (count($datos) > 0) {
            $cont = 0;
            foreach ($datos as $key) {
                $serfin[] = [
                    'contrato_id'        => $key->contrato_id,
                    'pago_id'            => $key->pago_id,
                    'resultado'          => $key->resultado,
                    'cantidad'           => $key->cantidad,
                    'created'            => $key->created,
                    'fecha_de_respuesta' => $key->fecha_de_respuesta,
                    'motivo_del_rechazo' => $key->motivo_del_rechazo,
                ];
                $cont += 1;
            }

            foreach (array_chunk($serfin, 5000) as $res) {
                $result = DB::connection('mysql')->table('serfinrespuestas')->insert($res);
            }

            // DB::connection('mysql')->table('actualizacion_serfin')->insert();

            ActualizarSerfin::where('id', session('asp'))
                ->update(['srf_pacific' => $count]);

            \Cookie::queue('srf_pacific', $cont, env('TIME_COOKIE'));
            return response()->json(['estatus' => true, 'registros' => $cont]);
        } else {
            return response()->json(['estatus' => false, 'mensaje' => 'No se ha descargado la respuesta del buzon. (Paso 1)']);
        }
    }

    public function update_serfin_pagados()
    {
        $date  = date('Ymd');
        $file2 = "SE20273C" . $date . '.xls';
        $datos = DB::connection('mysql')->table('pagos')
            ->join('origen', 'pagos.id', '=', 'origen.pago_id')
            ->join('stdr_respuestas', 'origen.clave', '=', 'stdr_respuestas.clave')
            ->where('origen.archivo', $file2)
            ->where('pagos.estatus', '<>', 'Pagado')
            ->where('origen.clave', 0)
            ->update(
                [
                    'pagos.estatus'                => DB::raw('case origen.clave when 0 then "Pagado" else "Rechazado" end'),
                    'pagos.cantidad'               => DB::raw('origen.importe'),
                    'pagos.fecha_de_pago'          => DB::raw('STR_TO_DATE(origen.fecha, "%Y%m%d")'),
                    'pagos.pagado_desde_santander' => DB::raw('case origen.clave when 1 then 0 else 1 end'),
                    'pagos.modified'               => DB::raw('now()'),
                ]
            );

        // DB::connection('mysql')->table('actualizacion_serfin')->insert(['srf_pacific_update' => $datos, 'res1' => 1]);

        ActualizarSerfin::where('id', session('asp'))
            ->update(['srf_pacific_update' => $datos, 'res1' => 1]);

        \Cookie::queue('srf_pacific_update', $datos, env('TIME_COOKIE'));
        \Cookie::queue('res1', true, env('TIME_COOKIE'));
        return response()->json(['estatus' => true, 'registros' => $datos]);
    }

    public function download_excel($archivo = '')
    {

        $directory     = "/files/cobranza/" . date('y/m/d');
        $date          = date('Ymd');
        $fileName      = "SE20273C" . $date . ".TXT";
        $directoryFile = $directory . "/" . $fileName;
        $fileSftp      = 'Outbox/' . $fileName;
        $dir           = $this->createDirectory();

        if ($dir == true) {
            //obtenemos el archivo del buzon
            $archivo = Storage::disk('sftp')->get($fileSftp);
            //grabamos el archivo del buzon en nuestro nuevo directorio
            $path = Storage::disk('public_cobra')->put($directoryFile, $archivo);
            // dd($path);

            if ($path == true) {

                $file = "SE20273C" . $date . ".xls";
                $fp   = fopen(public_path() . $directoryFile, 'r+');
                // $fp = fopen(Storage::disk('public_cobra') . $directoryFile, 'r+');

                while (!feof($fp)) {
                    $linea[] = fgets($fp);
                }
                fclose($fp);

                $pacific = [];

                $registros = array_splice($linea, 1, -2);

                if (isset($registros) && is_array($registros)) {
                    foreach ($registros as $k => $v) {
                        $opt = preg_split('/__/', substr($v, 135, 40));
                        if (isset($opt[1])) {
                            if (isset($opt[2])) {
                                $aux = 1;
                                $res = 0;
                                do {
                                    $opt_      = explode('_', $opt[$aux]); //NUMERO DE REFERENCIA
                                    $cantidad  = substr($v, 13, 15);
                                    $pacific[] = [
                                        'importe'    => floatval((($cantidad) * 0.01) / 2),
                                        'fecha'      => substr($v, 62, 8), //FECHA DE COBRO TIENE QUE SER UN DIA ANTERIOR
                                        'fecha2'     => date('Ymd'),
                                        'banco'      => (string) substr($v, 70, 3),
                                        'clave'      => (string) substr($v, 73, 2),
                                        'tarjeta'    => substr($v, 75, 20),
                                        'cliente'    => substr($v, 95, 40), //NOMBRE DEL TITULAR
                                        'referencia' => $opt[0] . '__' . $opt_[0] . '_' . $opt_[1],
                                        'cliente2'   => substr($v, 95, 40),
                                        'ceros'      => substr($v, 215, 15),
                                        'code'       => substr($v, 230, 7),
                                        'agencia'    => substr($v, 237, 40),
                                        'clave2'     => substr($v, 277, 2), // CLAVE DEL PAGO
                                    ];
                                    $aux++;
                                    $res++;
                                } while ($aux <= 2);
                            } else {
                                // Toma en cuenta Pacific y Home travel
                                $opt_      = explode('_', $opt[1]); //NUMERO DE REFERENCIA
                                $cantidad  = substr($v, 13, 15);
                                $pacific[] = [
                                    'importe'    => floatval(($cantidad) * 0.01),
                                    'fecha'      => substr($v, 62, 8), //FECHA DE COBRO TIENE QUE SER UN DIA ANTERIOR
                                    'fecha2'     => date('Ymd'),
                                    'banco'      => (string) substr($v, 70, 3),
                                    'clave'      => (string) substr($v, 73, 2),
                                    'tarjeta'    => substr($v, 75, 20),
                                    'cliente'    => substr($v, 95, 40), //NOMBRE DEL TITULAR
                                    'referencia' => $opt[0] . '__' . $opt_[0] . '_' . $opt_[1],
                                    'cliente2'   => substr($v, 95, 40),
                                    'ceros'      => substr($v, 215, 15),
                                    'code'       => substr($v, 230, 7),
                                    'agencia'    => substr($v, 237, 40),
                                    'clave2'     => substr($v, 277, 2), // CLAVE DEL PAGO
                                ];
                            }
                        } else {
                            $cantidad  = substr($v, 13, 15);
                            $pacific[] = [
                                'importe'    => floatval(($cantidad) * 0.01),
                                'fecha'      => substr($v, 62, 8), //FECHA DE COBRO TIENE QUE SER UN DIA ANTERIOR
                                'fecha2'     => date('Ymd'),
                                'banco'      => (string) substr($v, 70, 3),
                                'clave'      => (string) substr($v, 73, 2),
                                'tarjeta'    => substr($v, 75, 20),
                                'cliente'    => substr($v, 95, 40), //NOMBRE DEL TITULAR
                                'referencia' => $opt[0],
                                'cliente2'   => substr($v, 95, 40),
                                'ceros'      => substr($v, 215, 15),
                                'code'       => substr($v, 230, 7),
                                'agencia'    => substr($v, 237, 40),
                                'clave2'     => substr($v, 277, 2), // CLAVE DEL PAGO
                            ];
                        }
                    }
                    return Excel::download(new RespuestaExcelExport($pacific), $file);
                } else {
                    return false;
                }
            }
        }
    }

    public function ingresos_del_dia()
    {
        $pagado = Pago::where('estatus', 'Pagado')
            ->where('fecha_de_pago', date('Y-m-d'))
            ->sum('cantidad');

        return response()->json(number_format($pagado, 2));
    }

}
