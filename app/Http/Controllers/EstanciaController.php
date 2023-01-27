<?php

namespace App\Http\Controllers;

use App\Estancia;
// use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EstanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('entra al metodo');
        return view('admin.estancias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estancia  $estancia
     * @return \Illuminate\Http\Response
     */
    public function show(Estancia $estancia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estancia  $estancia
     * @return \Illuminate\Http\Response
     */
    public function edit(Estancia $estancia)
    {
        return view('admin.estancias.edit', compact('estancia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estancia  $estancia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estancia $estancia)
    {
        //
    }

    /**
     * Autor: Isw. Diego Enrique Sanchez
     * Creado: 2021-11-26
     * Actualizacion del contrato de la estancia seleccionada
     * @param  Request  $request
     * @param  Estancia $estancia
     * @return json response
     */
    public function update_contrato($id, Request $request)
    {
        $data['success']              = false;
        $estancia                     = Estancia::findOrFail($id);
        $estancia->descripcion_formal = $request->descripcion_formal;
        if ($estancia->save()) {
            $data['success'] = true;
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estancia  $estancia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estancia $estancia)
    {
        //
    }

    public function get_estancia($id)
    {
        $estancia = Estancia::findOrFail($id);
        return response()->json(['success' => true, 'estancia' => $estancia]);
    }

    public function listar_estancias()
    {
        $estancias = Estancia::where('estancia_paise_id', env('APP_PAIS_ID'))->whereYear('caducidad', '>=', (date('Y') - 4))->select(['id', 'title', 'precio', 'habilitada', 'noches', 'cuotas', 'caducidad', 'divisa'])->orderBy('id', 'DESC');
        $data      = array();
        $i         = 1;
        $btn       = '';

        return DataTables::eloquent($estancias)
            ->editColumn('id', function ($estancias) {
                return ucwords($estancias->id);
            })

            ->editColumn('title', function ($estancias) {
                return $estancias->title;
            })
            ->editColumn('precio', function ($estancias) {
                return $estancias->divisa . ' ' . number_format($estancias->precio);
            })
            ->addColumn('estatus', function ($estancias) {
                $class      = ($estancias->habilitada == 1) ? 'btn-success' : 'btn-danger';
                $btnEstatus = '<button type="button" class="btn ' . $class . ' btn-xs btnHabilitada" data-url="' . route('estancias.activar', $estancias->id) . '" data-estatus="' . $estancias->habilitada . '">Inactiva</button>';
                return $btnEstatus;
            })
            ->editColumn('caducidad', function ($estancias) {
                return $estancias->caducidad;
            })
            ->editColumn('cuotas', function ($estancias) {
                return $estancias->cuotas;
            })
            ->editColumn('noches', function ($estancias) {
                return 'Noches: ' . $estancias->noches . ' | Adultos: ' . $estancias->adultos . ' | Niños: ' . $estancias->ninos;
            })
            ->addColumn('actions', function ($estancias) {
                $btn = '';
                $btn .= '<button class="btn btn-dark btn-xs mr-1" value="' . $estancias->id . '" id="btnCopyEstancia" type="button"><i class="fas fa-copy"></i></button>';

                if (Auth::user()->can('update', $estancias)) {
                    $btn .= '<a class="btn btn-success btn-xs mr-1" href="' . route('estancias.edit', $estancias->id) . '" value="' . $estancias->id . '" id="btnEditarEstancia"><i class="fas fa-edit"></i></a>';
                }

                if (Auth::user()->can('delete', $estancias)) {
                    $btn .= '<button class="btn btn-danger btn-xs" value="' . $estancias->id . '" id="btnEliminarEstancia" type="button"><i class="fas fa-trash"></i></button>';
                }

                return $btn;
            })
            ->rawColumns(['id', 'title', 'precio', 'caducidad', 'noches', 'actions', 'estatus', 'cuotas'])
            ->make(true);

    }

    public function activar_estancia($id, Request $request)
    {
        $data['success']      = false;
        $estancia             = Estancia::findOrFail($id);
        $estancia->habilitada = ($request->estatus == '0') ? 1 : 0;

        if ($estancia->save()) {
            $data['success'] = true;
        }

        return response()->json($data);
    }

}
