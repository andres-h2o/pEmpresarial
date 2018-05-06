<?php

namespace Practica\Http\Controllers;

use Carbon\Carbon;
use Practica\Bitacora;
use Practica\Categoria;
use Practica\Detalle_bitacora;
use Practica\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
        $usuarios= User::join('categorias as c','c.id','id_categoria')
            ->select(
                'users.id as id',
                'name',
                'nombre as categoria'
            )->get();
        return view('user.list',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria=Categoria::pluck('nombre','id');
        return view('user.create',compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'id_categoria' => 'required',
        ]);

        User::create([
            'name' =>$request['name'],
            'email'=>$request['email'],
            'password' => bcrypt($request['password']),
            'id_categoria' => $request['id_categoria'],
        ]);

        $user = User::select('name','email','password','id_categoria')->orderby('created_at','desc')->first();
        $id_user = Auth::user()->id;
        $id_bitacora=Bitacora::_getIdUltima($id_user);//capturar Id de la bitacora creada

        Detalle_bitacora::create([
            'fecha' => Carbon::now(),
            'accion'=>'Registro de Usuario',
            'detalle' =>'datos nuevo Usuario'.$user,
            'id_bitacora'=>$id_bitacora
        ]);
        //$campista = Campista::_getcampista()->get()->first();
        Session:: flash('message','Usuario registrado exitosamente...');
        //return view('boleta.create',compact('campista'));

        return Redirect::to('/user/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria=Categoria::pluck('nombre','id');
        $user=User::find($id);
        return view('user.edit',compact('user','categoria'));
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
        $user=User::find($id);
        $user->update($request->all());
        $user->save ;
        return Redirect::to('/user');
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
