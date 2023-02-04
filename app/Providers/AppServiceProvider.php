<?php

namespace App\Providers;

use App\Models\Banco;
use App\Models\Convenio;
use App\Models\Destino;
use App\Models\Estancia;
use App\Models\Pais;
use App\Models\Region;
use App\Models\Reservacion;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Cargar variable globales en session para optimizar la carga de datos
         */
        Carbon::setUTF8(true);
        setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
        Carbon::setLocale('es');
        ini_set('max_execution_time', 360000);
        session(['unlock_cards' => false]);
        $this->register_mx();
        view()->composer('*', function ($view) {
            $info_grupo = $this->get_grupos();
            $view->with([
                'info_grupo' => $info_grupo,
            ]);
        });

        view()->composer('admin.*', function ($view) {
            /**
             * Carga de datos
             */
            $register         = $this->register_mx();
            $bancos_mx        = $this->bancos_mx();
            $estancias_global = $this->estancias();
            $regiones         = $this->regiones();
            $destinos         = $this->destinos();
            $paises           = $this->paises();
            $convenios_mx     = $this->convenios_mx();
            // $info_grupo       = $this->get_grupos();

            /**
             * carga de datos estatitos para el funcionamiento de algunas funciones de
             */

            $roles = array(
                'admin'        => 'Administrador',
                'client'       => 'Cliente',
                'recepcionist' => 'Recepcionista',
                'supervisor'   => 'Supervisor de Ventas',
                'sales'        => 'Ejecutivo de Ventas',
                'collector'    => 'Ejecutivo de Cobranza',
                'reserver'     => 'Ejecutivo de Reservaciones',
                'conveniant'   => 'Generador de Convenios',
                'quality'      => 'Control de Calidad',
                'control'      => 'Control de Ventas',

            );

            $como_se_entero = array(
                // 1  => 'redes sociales',
                // 2  => 'correo electronico',
                3  => 'Búsqueda WEb',
                4  => 'Flyer promocional',
                5  => 'Recomendación',
                6  => 'Otros',
                7  => 'Llamada telemarketing',
                8  => 'Venta directa',
                // 9  => 'whatsapp',
                10 => 'Gopacific',
                11 => 'Transporte publico',
                12 => 'IMSS - CLM',
                13 => 'Redes Sociales',
                20 => 'Amando a México',
            );

            $cuotas = array(
                1  => '1',
                12 => '12',
                24 => '24',
                48 => '48',
                36 => '36',
                72 => '72',
            );

            $divisas = array(
                'MXN' => 'MXN',
                'USD' => 'USD',
            );

            $estatus_tarjetas = array(
                'Cancelada'        => 'Cancelada',
                'No Aprobada'      => 'No Aprobada',
                'Confirmada'       => 'Confirmada',
                'Extraviada'       => 'Extraviada',
                'Denegada'         => 'Denegada',
                'Al Dia'           => 'Al Día',
                'Rechazada'        => 'Rechazada',
                'Inexistente'      => 'Inexistente',
                'Erronea'          => 'Errónea',
                'Retener'          => 'Retener',
                'Emisor Invalido'  => 'Emisor Invalido',
                'Bloqueada'        => 'Bloqueada',
                'Tarjeta Vencida'  => 'Tarjeta Vencida',
                'Tarjeta Invalida' => 'Tarjeta Invalida',
                'Declinada'        => 'Declinada',
            );

            $estatus_pagos = array(
                'Por Pagar'  => 'Por Pagar',
                'Pagado'     => 'Pagado',
                'Rechazado'  => 'Rechazado',
                'Cancelado'  => 'Cancelado',
                'Bonificado' => 'Bonificado',
                'Anomalia'   => 'Anomalía',
                'pagado_fdt' => 'Pago fuera de tiempo',
                'Simulador'  => 'Simulador',
            );

            $estatus_concal = array(
                'enviada'       => 'Enviada',
                'por_cerrar'    => 'Por cerrar',
                'no_contactado' => 'No contactado',
                'cerrado'       => 'Cerrado',
                'rechazada'     => 'Rechazada',
                'seguimiento'   => 'Seguimiento',
                'retomar'       => 'Retomar',
                'interesado'    => 'Interesado',
                'ellos_llaman'  => 'Ellos llaman',
            );

            /**
             * Reservaciones
             */
            $tipo_reservacion = array(
                'venta'          => 'Venta',
                'referido'       => 'Cortesía referidos',
                'campana'        => 'Cortesía campaña',
                'reconocimiento' => 'Cortesía reconocimiento',
                'vuelo'          => 'Vuelo',
                'traslado'       => 'Traslado',
                'tour'           => 'Tour',
                'autobus'        => 'Autobús',
            );

            $estatus_reservacion = array(
                'Nuevo'         => 'Nuevo - NC',
                'Ingresada'     => 'Ingresada - NR',
                'En proceso'    => 'En proceso - EP',
                'Cupon Enviado' => 'Cupón Enviado - CE',
                'Cancelada'     => 'Cancelada - CA',
                'Penalizada'    => 'Penalizada - PN',
                'Revision'      => 'Revisión - RE',
                'Autorizada'    => 'Autorizada - OK',
                'Seguimiento'   => 'Seguimiento - SG',
            );

            $estatus_pago = array(
                '0' => 'Pendientes',
                '1' => 'Pagadas',
            );

            $garantia_reservacion = array(
                '0' => 'Sin garantia',
                '1' => 'Garantizada',
            );

            $tipo_garantia = array(
                'Carta'   => 'Carta',
                'Dinero'  => 'Dinero',
                'Tarjeta' => 'Tarjeta',
            );

            $filtros_fecha = array(
                0 => 'Ingreso',
                1 => 'Alta',
                2 => 'Pago Hotel',
                3 => 'Pago Cliente',
            );

            $view->with([
                'estancias_global'     => $estancias_global,
                'bancos_mx'            => $bancos_mx,
                'register'             => $register,
                'roles'                => $roles,
                'como_se_entero'       => $como_se_entero,
                'cuotas'               => $cuotas,
                'divisas'              => $divisas,
                'estatus_tarjetas'     => $estatus_tarjetas,
                'estatus_pagos'        => $estatus_pagos,
                'estatus_concal'       => $estatus_concal,
                'destinos'             => $destinos,
                'regiones'             => $regiones,
                'paises'               => $paises,
                'tipo_reservacion'     => $tipo_reservacion,
                'estatus_reservacion'  => $estatus_reservacion,
                'estatus_pago'         => $estatus_pago,
                'garantia_reservacion' => $garantia_reservacion,
                'filtros_fecha'        => $filtros_fecha,
                'tipo_garantia'        => $tipo_garantia,
                'convenios'            => $convenios_mx,
                // 'info_grupo'           => $info_grupo,
            ]);
        });
    }

    /**
     * Autor: ISW. Diego Enrique Sanchez
     * Creado: 2022-12-26
     * Cargamos las estancias del pais ingresado en el evn
     * Almacenandolos en cache para la carga optimizada
     * @return estancias
     */
    public function estancias()
    {
        if (session()->exists('estancias_g') && session('estancias_g') != null) {
            $estancias_global = session('estancias_g');
        } else {
            $estancias_global = Estancia::where(['habilitada' => 1, 'estancia_paise_id' => env('APP_PAIS_ID', 1)])->select('id', 'title', 'precio', 'habilitada', 'descripcion', 'noches', 'adultos', 'ninos', 'divisa', 'cuotas')->orderBy('id', 'DESC')->get();
            session(['estancias_g' => $estancias_global]);
        }

        return $estancias_global;
    }

    /**
     * Autor: ISW. Diego Enrique Sanchez
     * Creado: 2022-12-26
     * cookie de validacion de pre registro de usuario en la pagina web
     * Almacenandolos en cache para la carga optimizada
     * @return register
     */
    public function register_mx()
    {
        if (env('APP_ENV') == 'production') {
            view()->composer('*', function ($view) {
                $register    = (isset($_COOKIE['preregister'])) ? $_COOKIE['preregister'] : false;
                $register_mx = (isset($_COOKIE['preregister_mx'])) ? $_COOKIE['preregister_mx'] : false;
                $view->with(['register' => $register, 'register_mx' => $register_mx]);
            });
        } else {
            view()->composer('*', function ($view) {
                $view->with(['register' => true, 'register_mx' => true]);
            });
        }
    }

    /**
     * Autor: ISW. Diego Enrique Sanchez
     * Creado: 2022-12-26
     * Cargamos los bancos del pais ingresao en el env
     * Almacenandolos en cache para la carga optimizada
     * @return estancias
     */
    public function bancos_mx()
    {

        if (session()->exists('bancos_mx')) {
            $bancos_global = session('bancos_mx');
            // $estancias_usa    = session('estancias_usa');
        } else {
            $bancos_global = Banco::where('paise_id', env('APP_PAIS_ID'))->get(['id', 'title']);
            session(['bancos_mx' => $bancos_global]);
        }

        return $bancos_global;
    }

    /**
     * Autor: ISW. Diego Enrique Sanchez
     * Creado: 2022-12-26
     * Cargamos los convenios del pais ingresao en el env
     * Almacenandolos en cache para la carga optimizada
     * @return estancias
     */
    public function convenios_mx()
    {
        if (session()->exists('convenios_g')) {
            $convenios_g = session('convenios_g');
            // $estancias_usa    = session('estancias_usa');
        } else {
            $convenios_g = Convenio::where('paise_id', env('APP_PAIS_ID'))->get(['id', 'empresa_nombre', 'llave']);

            session(['convenios_g' => $convenios_g]);
        }

        return $convenios_g;
    }

    /**
     * Autor: ISW. Diego Enrique Sanchez
     * Creado: 2022-12-26
     * Cargamos los destinos
     * Almacenandolos en cache para la carga optimizada
     * @return estancias
     */
    public function destinos()
    {
        if (session()->exists('destinos')) {
            $destinos_g = session('destinos');
            // $estancias_usa    = session('estancias_usa');
        } else {
            $destinos_g = Destino::pluck('id', 'titulo');
            session(['destinos' => $destinos_g]);
        }
        return $destinos_g;
    }
    /**
     * Autor: ISW. Diego Enrique Sanchez
     * Creado: 2022-12-26
     * Cargamos las regiones
     * Almacenandolos en cache para la carga optimizada
     * @return estancias
     */
    public function regiones()
    {

        if (session()->exists('regiones')) {
            $regiones_g = session('regiones');
            // $estancias_usa    = session('estancias_usa');
        } else {
            $regiones_g = Region::pluck('id', 'title');
            session(['regiones' => $regiones_g]);
        }
        return $regiones_g;
    }

    /**
     * Autor: ISW. Diego Enrique Sanchez
     * Creado: 2022-12-26
     * Cargamos las regiones
     * Almacenandolos en cache para la carga optimizada
     * @return estancias
     */
    public function paises()
    {

        if (session()->exists('paises')) {
            $paises_g = session('paises');
            // $estancias_usa    = session('estancias_usa');
        } else {
            $paises_g = Pais::get(['id', 'title']);
            session(['paises' => $paises_g]);
        }
        return $paises_g;
    }

    public function get_grupos()
    {
        $info_grupo = array(
            '37742' => array(
                'infante' => 1280,
                'menor'   => 3570,
                'adulto'  => 6970,
            ),
        );

        return $info_grupo;
    }
}
