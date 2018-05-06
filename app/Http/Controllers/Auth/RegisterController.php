<?php

namespace Practica\Http\Controllers\Auth;

use Carbon\Carbon;
use Practica\Bitacora;
use Practica\Detalle_bitacora;
use Practica\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Practica\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'tipo' => 'max:1',
        ]);
    }

    protected function registered(Request $request, $user)
    {
        Bitacora::create([
        'id_usuario' =>Auth::user()->id,
            ]);
            $id_bitacora=Bitacora::_getIdUltima(Auth::user()->id);//capturar Id de la bitacora creada

            Detalle_bitacora::create([
                'fecha' => Carbon::now(),
                'accion' => 'Login',
                'detalle' =>'Usuario Inicio sesion',
                'id_bitacora'=>$id_bitacora
            ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'id_categoria' => 4,
        ]);
    }
}
