@extends('layouts.admin')

@section('content')
    @include('alerts.existfail')
    @include('alerts.success')
<br>
<div class="container">
    <div class="row" align="center">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading" id="cabeza"> Bienvenido {{ Auth::user()->name }} !!</div>
            @if (Auth::user()->tipo =='N')
                <h3 style="color:#ea3723 ">Aun no tienes PERMISOS en el sistema, ponte en contacto con el Administrador!</h3>
            @endif
                <div class="panel-body">
                  <section class="box">
                        <a class="image featured"><img src="images/pempresarial.png" alt="" style="width: 100% ;" /></a>
                        <header>
                          <h2>Practica Empresarial</h2>
                        </header>

                  </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
