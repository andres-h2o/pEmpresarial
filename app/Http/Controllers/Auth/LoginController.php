<?php

namespace Practica\Http\Controllers\Auth;


use Carbon\Carbon;
use Practica\Bitacora;
use Practica\Detalle_bitacora;
use Practica\User;
use Practica\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            //crear nueva vitacora por iniciar sesion
            ;
            $id_user=User::_buscarEmail($request->all()['email']); //buscar el id de ese email
            Bitacora::create([
                'id_usuario' =>$id_user,
            ]);
            $id_bitacora=Bitacora::_getIdUltima($id_user);//capturar Id de la bitacora creada

            Detalle_bitacora::create([
                'fecha' => Carbon::now(),
                'accion' => 'Login',
                'detalle' =>'Usuario Inicio sesion',
                'id_bitacora'=>$id_bitacora
            ]);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    public function logout(Request $request)
    {
        //bitacora cerrar
        $id_user = Auth::user()->id;
        $id_bitacora=Bitacora::_getIdUltima($id_user);//capturar Id de la bitacora creada

        Detalle_bitacora::create([
            'fecha' => Carbon::now(),
            'accion'=>'Logout',
            'detalle' =>'Usuario Cerro sesion',
            'id_bitacora'=>$id_bitacora
        ]);
        //logout
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }
}
