<?php

namespace App\Http\Controllers;

use App;
use App\Models\CodigoPostal as CP;
use App\Models\Convenio;
use App\Models\Destino;
use App\Models\Estancia;
use App\Models\Sorteo;
use App\Models\User;
use DB;

class PaginaController extends Controller
{
    public function fraude()
    {
        return view('pagina.mx.fraude');
    }

    public function mision()
    {
        return view('pagina.mx.mision');
    }

    public function privacidad()
    {
        return view('pagina.mx.privacidad');
    }

    public function bolsa_trabajo()
    {
        return view('pagina.mx.bolsa_trabajo');
    }

    public function empresas_afiliadas()
    {
        return view('pagina.mx.empresas_afiliadas');
    }

    public function beneficios_empresa()
    {
        return view('pagina.mx.beneficios_empresa');
    }

    public function beneficios_trabajadores()
    {
        return view('pagina.mx.beneficios_trabajadores');
    }

    public function productos($convenio = null, $producto = null, $producto2 = null)
    {

        if ($convenio == null) {
            $convenio = 'mxreferido';
        } else {
            if ($convenio != null) {
                $convenio = $convenio;
            } else {
                $convenio = session('llave');
            }
        }

        $convenio = Convenio::where('llave', $convenio)->first();

        // dd($convenio);
        session([
            'convenio_nombre' => $convenio->empresa_nombre,
            'convenio_id'     => $convenio->id,
            'welcome'         => $convenio->welcome,
            'llave'           => $convenio->llave,
        ]);

        // dd(session()->all());
        if (!$producto == 'destinos-nacionales') {
            return view('pagina.mx.productos', compact('convenio'));
        } else {
            return redirect()->route('nacionales', $convenio->id);
        }
    }


    public function acapulco($convenio = null, $producto = null, $producto2 = null)
    {

        if ($convenio == null) {
            $convenio = 'mxreferido';
        } else {
            if ($convenio != null) {
                $convenio = $convenio;
            } else {
                $convenio = session('llave');
            }
        }

        $convenio = Convenio::where('llave', $convenio)->first();

        // dd($convenio);
        session([
            'convenio_nombre' => $convenio->empresa_nombre,
            'convenio_id'     => $convenio->id,
            'welcome'         => $convenio->welcome,
            'llave'           => $convenio->llave,
        ]);

        // dd(session()->all());
        if (!$producto == 'destinos-nacionales') {
            return view('pagina.mx.acapulco', compact('convenio'));
        } else {
            return redirect()->route('nacionales', $convenio->id);
        }
    }

    public function nacionales($convenio = null)
    {

        // dd(session()->all());

        if (session()->exists('llave')) {
            $convenio = session('llave');
        } else {
            $convenio = 'mxreferido';
        }

        // if ($convenio == null) {
        //     $convenio = 'mxreferido';
        // } else {
        //     if ($convenio != null) {
        //         $convenio = $convenio;
        //     } else {
        //         $convenio = session('llave');
        //     }
        // }

        $convenio = Convenio::where('llave', $convenio)->select('id', 'llave', 'empresa_nombre', 'welcome')->first();

        // dd($convenio);

        session([
            'convenio_nombre' => $convenio->empresa_nombre,
            'convenio_id'     => $convenio->id,
            'welcome'         => $convenio->welcome,
            'llave'           => $convenio->llave,
        ]);

        $estancias = Estancia::where('caducidad', env('EST_VIGENCIA'))->where('solosistema', 0)->where('estancia_paise_id', 1)->get();

        return view('pagina.mx.nacionales', compact('estancias', 'convenio'));
    }

    public function internacionales($convenio = null)
    {

        if (session()->exists('llave')) {
            $convenio = session('llave');
        } else {
            $convenio = 'mxreferido';
        }

        $convenio = Convenio::where('llave', $convenio)->select('id', 'llave', 'empresa_nombre', 'welcome')->first();
        session([
            'convenio_nombre' => $convenio->empresa_nombre,
            'convenio_id'     => $convenio->id,
            'welcome'         => $convenio->welcome,
            'llave'           => $convenio->llave,
        ]);

        $destinos_caribe = Destino::where('top_id', 'caribe')->get();
        $destinos_europa = Destino::where('top_id', 'europa')->get();
        $destinos_usa    = Destino::where('top_id', 'eu')->whereNotIn('slug', ['disney-world'])->get();

        return view('pagina.mx.internacionales', compact('convenio', 'destinos_usa', 'destinos_europa', 'destinos_caribe'));
    }
    public function cruceros()
    {
        return view('pagina.mx.cruceros');
    }
    public function cotizador()
    {
        return view('pagina.mx.cotizador');
    }

    /**
     * Proceso de compra detalles de estancia seleccionada
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function detalle_estancia($id)
    {
        $estancia = Estancia::findOrFail($id);
        return view('pagina.mx.detalle_estancia', compact('estancia'));
    }

    public function detalle_estancia_int($slug)
    {
        $destino   = Destino::whereSlug($slug)->first();
        $estancias = Estancia::where('destino_id', $destino->id)
            ->whereDate('caducidad', '2021-12-31')
            ->where('estancia_paise_id', 1)
            ->get();
        return view('pagina.mx.detalle_estancias_int', compact('estancias', 'destino'));
    }

    public function buscar_cp($cp, $asenta = null)
    {
        $info = CP::select('id', 'id_municipio', 'id_estado')
            ->where('id_codigo', $cp)
            ->groupBy('id', 'id_municipio', 'id_estado')
            ->limit(1)
            ->get();
        $colonia = CP::select(DB::raw("id,id_asenta AS colonia"))
            ->where('id_codigo', $cp)
            ->get();

        if ($asenta != null) {
            $direccion = CP::select(DB::raw("id,id_asenta AS colonia"))
                ->where('id', $id)
                ->get();
            $rs['direccion'] = $direccion;
        }
        $rs['info']    = $info;
        $rs['colonia'] = $colonia;

        return $rs;
    }

    public function sorteo($convenio)
    {

        $convenio = Convenio::where('llave', $convenio)->first();
        $sorteo   = Sorteo::where('llave', $convenio->llave)->first();

        $fechaInicio = $sorteo->fecha_inicio;
        $fechaFin    = $sorteo->fecha_fin;

        // dd($fechaInicio, $fechaFin);

        return view('pagina.mx.sorteo', compact('convenio', 'sorteo'));
    }

    public function hoteles_amigos()
    {
        return view('pagina.mx.hoteles_amigos');
    }

    public function nosotros()
    {
        return view('pagina.mx.nosotros');
    }

    public function preguntas()
    {
        return view('pagina.mx.preguntas_frecuentes');
    }

    public function encuesta($id, $user_hash)
    {

        $user = User::where('id', $id)->where('user_hash', $user_hash)->first();
        // dd($user);
        return view('pagina.mx.encuesta', compact('user'));
    }

    /**
     * Autor: ISW. Diego Enrique Sanchez
     * Creado: 2022-02-08
     * Mostrar la pagina para eñ tutorial de como realizar la reservacion
     * @return [type] [description]
     */
    public function tuto_reservas()
    {
        return view('pagina.mx.tuto_reservas');
    }

    public function beneficios()
    {
        return view('pagina.mx.beneficios');
    }
    public function doc_legales()
    {
        return view('pagina.mx.doc_legales');
    }

    public function demo_flyer($tipo)
    {
        if ($tipo == 'modulo_3') {
            $tipo = 'modulo_3.jpg';
        } else {
            $tipo = 'modulo_7.jpg';
        }
        return view('pagina.mx.demo_flyer', compact('tipo'));
    }
}
