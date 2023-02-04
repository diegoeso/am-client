<?php

/**
 * Autor: Isw. Diego Enrique Sanchez
 * Controlamos los accesos a paneles de cada rol asi como funciones que se usan en mas de un rol
 */
namespace App\Http\Controllers;

use App\Models\Actividades;
use App\Models\Comision;
use App\Models\Concal;
use App\Models\Contrato;
use App\Models\Convenio;
use App\Exports\ExportVentas;
use App\Models\Padre;
use App\Models\Pago;
use App\Models\Pais;
use App\Models\Salesgroup;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use Excel;
use Illuminate\Http\Request;
use Log;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('profile')->only('dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'client') {
            return view('cliente.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $contratos = Contrato::whereHas('convenio', function ($q) {
            $q->where('paise_id', env('APP_PAIS_ID'));
        });
        $users = User::whereHas('convenio', function ($q) {
            $q->where('paise_id', env('APP_PAIS_ID'));
        });

        $grafica = DB::table('contratos as c')
            ->select(DB::raw('count(c.id) as ventas'), DB::raw('date(c.created) as fecha'))
            ->join('convenios as con', 'c.convenio_id', 'con.id')
            ->whereIn('c.estatus', ['por_autorizar', 'comprado'])
            ->whereYear('c.created', date('Y'))
            ->whereMonth('c.created', date('m'))
            ->groupBy('fecha')
            ->get();

        $ventas_equipo = DB::table('contratos as c')
            ->select(DB::raw('count(c.id) as ventas'), DB::raw('e.title as equipo'))
            ->join('convenios as con', 'c.convenio_id', 'con.id')
            ->join('padres as p', 'c.padre_id', 'p.id')
            ->join('users as u', 'p.user_id', 'u.id')
            ->join('salesgroups as e', 'u.salesgroup_id', 'e.id')
            ->whereIn('c.estatus', ['por_autorizar', 'comprado'])
            ->where(DB::raw('date(c.created)'), date('Y-m-d'))
            ->groupBy('equipo')
            ->get();

        $pagado = Pago::where('estatus', 'Pagado')
            ->where('fecha_de_pago', date('Y-m-d'))
            ->sum('cantidad');

        $panel = array(
            'por_autorizar' => $contratos->where('estatus', 'por_autorizar')->count(),
            'contratos_hoy' => $contratos->where('created', '>=', date('Y-m-d'))->count(),
            'clientes'      => $users->where('created', '>=', date('Y-m-d'))->where('role', 'client')->count(),
            'pagado'        => number_format($pagado, 2),
        );

        return view('admin.dashboard', compact('grafica', 'panel', 'ventas_equipo'));
    }

    public function dashboard_ventas()
    {

        $padre_id   = Padre::where('user_id', Auth::id())->first()->id;
        $users      = User::where('padre_id', $padre_id)->count();
        $contratos  = Contrato::where('padre_id', $padre_id)->count();
        $comisiones = Comision::where('user_id', Auth::id())->count();

        $ventas_equipo = DB::table('contratos as c')
            ->select(DB::raw('count(c.id) as ventas'), DB::raw('concat(u.nombre," ", u.apellidos) as vendedor'))
            ->join('convenios as con', 'c.convenio_id', 'con.id')
            ->join('padres as p', 'c.padre_id', 'p.id')
            ->join('users as u', 'p.user_id', 'u.id')
            ->join('salesgroups as e', 'u.salesgroup_id', 'e.id')
            ->whereIn('c.estatus', ['por_autorizar', 'comprado'])
            ->where(DB::raw('date(c.created)'), date('Y-m-d'))
            ->where('u.salesgroup_id', Auth::user()->salesgroup_id)
            ->groupBy('c.padre_id', 'vendedor')
            ->get();

        $mis_ventas = DB::table('contratos as c')
            ->select(DB::raw('count(c.id) as ventas'), DB::raw('date(c.created) as fecha'))
            ->join('convenios as con', 'c.convenio_id', 'con.id')
            ->join('padres as p', 'c.padre_id', 'p.id')
            ->join('users as u', 'p.user_id', 'u.id')
            ->join('salesgroups as e', 'u.salesgroup_id', 'e.id')
            ->whereIn('c.estatus', ['por_autorizar', 'comprado'])
            ->where('c.padre_id', $padre_id)
            ->whereYear('c.created', date('Y'))
            ->groupBy('fecha')
            ->get();

        return view('admin.dashboard_ventas', compact('users', 'contratos', 'comisiones', 'ventas_equipo', 'mis_ventas'));
    }

    public function dashboard_cobranza()
    {
        return view('admin.dashboard_cobranza');
    }

    public function dashboard_reservaciones()
    {
        $data = DB::select("SELECT paises.id, paises.title as paise_title, regiones.id, regiones.title
        , SUM(case reservaciones.estatus when 'Nuevo' then 1 else 0 end) as NC
        , SUM(case reservaciones.estatus when 'Ingresada' then 1 else 0 end) as NR
        , SUM(case reservaciones.estatus when 'Enproceso' then 1 else 0 end) as EP
        , SUM(case reservaciones.estatus when 'CuponEnviado' then 1 else 0 end) as CE
        , SUM(case reservaciones.estatus when 'Cancelada' then 1 else 0 end) as CA
        , SUM(case reservaciones.estatus when 'Penalizada' then 1 else 0 end) as PN
        , SUM(case reservaciones.estatus when 'Revision' then 1 else 0 end) as RE
        , SUM(case reservaciones.estatus when 'Autorizada' then 1 else 0 end) as OK
        , SUM(case reservaciones.estatus when 'Seguimiento' then 1 else 0 end) as SG -- nuevo estatus DE seguimiento
        FROM paises
        INNER JOIN regiones on paises.id = regiones.paise_id
        INNER JOIN reservaciones on regiones.id = reservaciones.regione_id
        group by paises.id, regiones.title
        order by paises.id, regiones.title;");

        $ejecutivos = User::whereRole('reserver')->get();

        return view('admin.dashboard_reservas', compact('data', 'ejecutivos'));
    }

    public function dashboard_convenios()
    {
        $convenios              = Convenio::where('user_id', Auth::id())->get();
        $panel['num_convenios'] = $convenios->count();
        $sum                    = 0;
        foreach ($convenios as $con) {
            $sum += count($con->contratos);
        }
        $panel['ventas_total'] = $sum;
        $panel['actividades']  = Actividades::where('user_id', Auth::id())->count();
        $panel['seguimientos'] = Concal::where('user_id', Auth::id())->count();
        $panel['comisiones']   = Comision::where('user_id', Auth::id())->count();

        // dd($panel);
        return view('admin.dashboard_convenios', compact('panel'));
    }

    public function dashboard_control()
    {
        $contratos = Contrato::whereHas('convenio', function ($q) {
            $q->where('paise_id', env('APP_PAIS_ID'));
        });
        $users = User::whereHas('convenio', function ($q) {
            $q->where('paise_id', env('APP_PAIS_ID'));
        });

        $grafica = DB::table('contratos as c')
            ->select(DB::raw('count(c.id) as ventas'), DB::raw('date(c.created) as fecha'))
            ->join('convenios as con', 'c.convenio_id', 'con.id')
            ->whereYear('c.created', date('Y'))
            ->whereMonth('c.created', date('m'))
            ->groupBy('fecha')
            ->get();

        $panel = array(
            'por_autorizar' => $contratos->where('estatus', 'por_autorizar')->count(),
            'contratos_hoy' => $contratos->where('created', '>=', date('Y-m-d'))->count(),
            'clientes'      => $users->where('created', '>=', date('Y-m-d'))->count(),
        );

        // dd($panel);

        return view('admin.dashboard_control', compact('panel', 'grafica'));
    }

    public function dashboard_quality()
    {
        return view('admin.dashboard_cobranza');
    }

    public function dashboard_reserver()
    {
        return view('admin.dashboard_cobranza');
    }

    public function dashboard_conveniant()
    {
        return view('admin.dashboard_cobranza');
    }

    public function buscar_usuario($data)
    {
        $users = User::with(['convenio', 'contratos'])
            ->where(DB::raw('LTRIM(nombre)'), 'LIKE', "%{$data}%")
            ->orWhere(DB::raw('LTRIM(apellidos)'), 'LIKE', "%{$data}%")
            ->orWhere('username', 'LIKE', "%{$data}%")
            ->orWhere('telefono', 'LIKE', "%{$data}%")
            ->orWhere('telefono_casa', 'LIKE', "%{$data}%")
            ->orWhere('telefono_oficina', 'LIKE', "%{$data}%")
            ->orWhere(DB::raw('concat(LTRIM(nombre)," ", LTRIM(apellidos))'), 'LIKE', "%{$data}%")
            ->orwhereHas('contratos', function ($query) use ($data) {
                $query->where('id', $data)
                // ->orWhere('sys_key', 'LIKE', "%{$data}%")
                    ->orWhere('sys_key', $data)
                    ->limit(1);
            })
            ->orwhereHas('reservaciones', function ($query) use ($data) {
                $query->where('nombre_de_quien_sera_la_reservacion', 'like', "%{$data}%");
            })
            ->get();

        $data = array();
        $i    = 1;
        $btn  = '';
        foreach ($users as $val) {
            $data[] = array(
                "convenio" => ($val->convenio) ? $val->convenio->empresa_nombre : 'Sin convenio',
                "usuario"  => $val->fullName,
                "username" => $val->username,
                'btn'      => '<a href="' . route('users.show', $val->id) . '" type="button" class="btn btn-info btn-xs">Ver</a>',
            );
            $btn = '';
        }

        //DEVUELVE LOS DATOS EN UN JSON
        $results = array(
            "sEcho"                => 1,
            "iTotalRecords"        => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData"               => $data,
        );
        return response()->json($results);
    }

    /**
     * Autor: Isw. Diego Enrique Sanchez
     * Cambial color de sistema administrativo
     * @param  [int] $color
     * @return [json] $data
     */
    public function cambiar_color($color)
    {
        setcookie('color_system', $color, time() + 60 * 60 * 24 * 60, '/');
        Log::debug('Usuario: ' . Auth::user()->username . ' (' . Auth::user()->fullName . ') ' . 'cambio de color a: ' . $color);
        $data['success'] = true;
        return response()->json($data);
    }

    /**
     * Autor: Isw. Diego Sanchez
     * Creado: 2022-06-09
     * Lanzamos la vista y los convenios para poder realizar la busqueda bajo convenios seleccionados
     * @return $convenios
     */
    public function viewVentas()
    {
        $convenios = Convenio::where('paise_id', env('APP_PAIS_ID', 1))->get(['empresa_nombre', 'id']);
        $equipos   = Salesgroup::all();
        $paises    = Pais::all();
        // dd($convenios);
        return view('admin.elementos.views.ventas', compact('convenios', 'equipos', 'paises'));
    }

    /**
     * Autor: Isw Diego Sanchez
     * Creado: 2022-06-10
     * Listado de ventas dentro de la vista ventas datatables
     * @param  Request $request
     * @return response json
     */
    public function filtrarVentas(Request $request)
    {
        $total_ventas = $this->getDataFiltrado($request);
        // dd($total_ventas);
        $data = array();
        $i    = 1;
        $btn  = '';

        foreach ($total_ventas as $venta) {
            if ($venta->pagos_realizados != 0) {
                $colorPagos = 'info';
            } else {
                $colorPagos = 'danger';
            }

            $data[] = array(
                "0"  => '<a class="btn btn-dark btn-xs" href="' . route('users.show', $venta->user_id) . '" role="button">' . $venta->id . '</a>',
                "1"  => ($venta->cliente) ? $venta->cliente->fullName : 'N/A',
                "2"  => $venta->paquete,
                "3"  => '<span class="label" style="background: ' . $venta->color_estatus() . '">' . $venta->estatus . '</span>',
                "4"  => $venta->padre->vendedor->fullName,
                "5"  => ($venta->padre->vendedor->equipo) ? $venta->padre->vendedor->equipo->title : 'Sin registro',
                "6"  => '<span class="label label-info">' . $venta->cuotas_pagos . '</span>',
                "7"  => '<span class="label label-' . $colorPagos . '">' . $venta->pagos_realizados . '</span>',
                "8"  => $venta->diffForhumans(),
                "9"  => $venta->convenio->empresa_nombre,
                "10" => $venta->tipo_llamada,
                "11" => $venta->ComoSeEntero,
            );
            $btn = '';
        }

        //DEVUELVE LOS DATOS EN UN JSON
        $results = array(
            "sEcho"                => 1,
            "iTotalRecords"        => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData"               => $data,
        );
        return response()->json($results);
    }

    /**
     * Autor: Isw. Diego Sanchez
     * Creado: 2022-06-13
     * Llamamos la clade "ExportVentas" para generar el archivo excel con el filtrado de ventas solicitadas por el usuario
     * @param  Request $request
     * @return response json
     */
    public function exportFiltrado(Request $request)
    {
        $ventas          = $this->getDataFiltrado($request);
        $data['name']    = 'Ventas-' . Carbon::now()->format('Y-m-d') . '.xlsx';
        $data['success'] = true;
        $data['url']     = route('ventas.download', $data['name']);
        $excel           = Excel::store(new ExportVentas($ventas), $data['name'], 'filtrados');

        return response()->json($data);

    }

    /**
     * Autor: Isw. Diego Sanchez
     * Creado: 2022-06-13
     * Retornamos la descarga para procesarla por ajax y no recargar ni redireccionar al usuario
     * @param  string $name nombre del archivo a descargar
     * @return response download
     */
    public function downloadFiltrado($name)
    {
        return response()->download(public_path() . "/files/filtrados/" . $name);
    }

    /**
     * Autor: Isw. Diego Sanchez
     * Creado: 2022-06-13
     * Consilta para obtener el filtrado de las ventas solicitadas por el usuario
     * se usa en mas de un metodo, revisar la modificacion en metodo @exportFiltrado y @downloadFiltrado
     * @param  Request $request
     * @return array data
     */
    public function getDataFiltrado($request)
    {

        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin    = $request->fecha_fin;
        $ventas       = Contrato::whereBetween(DB::raw('date(created)'), [$fecha_inicio, $fecha_fin])
            ->with(['cliente', 'tarjeta', 'padre', 'tarjeta.r_banco', 'padre.vendedor'])
            ->whereHas('convenio', function ($q) {
                $q->where('paise_id', env('APP_PAIS_ID'));
            })
            ->withCount(['pagos as cuotas_pagos'])
            ->withCount(['pagos as pagos_realizados' => function ($query) {
                $query->where('estatus', 'Pagado');
            }]);

        if ($request->convenio_id) {
            $ventas->whereHas('convenio', function ($q) use ($request) {
                $q->where('id', $request->convenio_id);
            });
        }
        // if ($request->pais_id) {
        //     $ventas->whereHas('convenio', function ($q) use ($request) {
        //         $q->where('paise_id', $request->pais_id);
        //     });
        // }
        if ($request->estatus) {
            $ventas->whereIn('estatus', $request->estatus);
        }

        if ($request->tipo_llamada) {
            $ventas->whereIn('tipo_llamada', $request->tipo_llamada);
        }

        if ($request->como_se_entero) {
            $ventas->whereHas('cliente', function ($q) use ($request) {
                $q->whereIn('como_se_entero', $request->como_se_entero);
            });
        }

        if ($request->equipo) {
            $ventas->whereHas('padre.vendedor', function ($q) use ($request) {
                $q->whereIn('salesgroup_id', $request->equipo);
            });
        }

        $ventas_total = $ventas->groupBy('id')->orderBy('id')->get();
        return $ventas_total;
    }
}
