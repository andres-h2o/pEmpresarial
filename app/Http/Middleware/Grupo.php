<?php

namespace Practica\Http\Middleware;
use Practica\Permiso;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Closure;

class Grupo
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permiso = Permiso::where('id_categoria',$this->auth->user()->id_categoria)
        ->where('id_privilegio',5)->get();
        if(count($permiso)==0){
            Session::flash('message-noexist','Sin Privilegios');
            return redirect()->to('home');
        }

        return $next($request);
    }
}
