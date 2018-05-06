<?php

namespace Practica\Http\Controllers;

use Carbon\Carbon;
use Practica\Bitacora;
use Practica\Categoria;
use Practica\Detalle_bitacora;
use Practica\Permiso;
use Practica\Privilegio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PermisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usuarios');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = Categoria::all()->pluck('nombre', 'id');
        $privilegio = Privilegio::all()->pluck('cu', 'id');
        return view('permiso.create', compact('categoria', 'privilegio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_categoria' => 'required',
            'id_privilegio' => 'required',
        ]);

        Permiso::create([
            'id_categoria' => $request['id_categoria'],
            'id_privilegio' => $request['id_privilegio']
        ]);


        //$campista = Campista::_getcampista()->get()->first();
        Session:: flash('message', 'Usuario registrado exitosamente...');
        //return view('boleta.create',compact('campista'));

        return Redirect::to('/permiso/create');
    }


    /**
     * @param Request $request
     * @param $id_categoria
     * @return Request
     */

    public function asignar(Request $request, $id_categoria)
    {

        $v1 = ($request['v1'] == 1) ? 1 : 0;
        $v2 = ($request['v2'] == 1) ? 1 : 0;
        $v3 = ($request['v3'] == 1) ? 1 : 0;
        $v4 = ($request['v4'] == 1) ? 1 : 0;
        Categoria::find($id_categoria)->update([
            "v1" => $v1,
            "v2" => $v2,
            "v3" => $v3,
            "v4" => $v4,
        ]);

        //$campista = Campista::_getcampista()->get()->first();
        Session:: flash('message', 'Permiso Actualizado exitosamente...');
        //return view('boleta.create',compact('campista'));
        return Redirect::to('/categoria' );
    }


    public function mostrar($id_categoria)
    {
        $categoria = Categoria::find($id_categoria);

        $permisos = Permiso::join('privilegios as pri', 'pri.id', 'permisos.id_privilegio')
            ->where('id_categoria', $id_categoria)
            ->select('pri.id', 'cu', 'permisos.id')->orderby('pri.id')->get();
        $permi = Permiso::join('privilegios as pri', 'pri.id', 'permisos.id_privilegio')
            ->where('id_categoria', $id_categoria)
            ->select('pri.id')->get();
        $sinpermisos = Privilegio::whereNotin('id', $permi)->select('id', 'cu')->get()->pluck('cu', 'id');

        return view('permiso.mostrar', compact('permisos', 'categoria', 'sinpermisos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $permiso = Permiso::where('id', $id)
            ->select(
                'id',
                'id_categoria',
                'id_privilegio'
            )->first();
        Permiso::destroy($id);
        //bitacora

        $id_user = Auth::user()->id;
        $id_bitacora = Bitacora::_getIdUltima($id_user);//capturar Id de la bitacora creada

        Detalle_bitacora::create([
            'fecha' => Carbon::now(),
            'accion' => 'Eliminacion de Permiso',
            'detalle' => 'datos de permiso borrado ' . $permiso,
            'id_bitacora' => $id_bitacora
        ]);

        Session::flash('message', 'Permiso Eliminado Exitosamente...');
        return back();

    }
}
