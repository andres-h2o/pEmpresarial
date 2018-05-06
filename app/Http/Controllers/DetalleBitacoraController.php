<?php

namespace Practica\Http\Controllers;

use Practica\Bitacora;
use Practica\Detalle_bitacora;
use Practica\User;
use Illuminate\Http\Request;

class DetalleBitacoraController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalles=Detalle_bitacora::_detallesBitacora($id)->paginate(7);
        $usuario=Bitacora::join('users as u','u.id','bitacoras.id_usuario')
            ->where('bitacoras.id',$id)->select('u.id as id','name as nombre','bitacoras.created_at as fecha')->first();
        return view('bitacora.detalles',compact('detalles','usuario'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id_detalle
     * @return \Illuminate\Http\Response
     */
    public function detalle($id_detalle)
    {
        $detalles=Detalle_bitacora::_detallesBitacora($id_detalle)->paginate(7);
        $usuario=Bitacora::join('users as u','u.id','bitacoras.id_usuario')
            ->where('bitacoras.id',$id_detalle)->select('u.id as id','name as nombre','bitacoras.created_at as fecha')->first();
        return view('bitacora.detalle',compact('detalles','usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
