@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <br>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h1 id="cabeza">Lista de Acciones del Usario {{$usuario->nombre}} en fecha {{$usuario->fecha}}</h1>
            <br>

            <div id="tbody">
                <table class="table table-hover">
                    <tr class="info">
                        <th >Fecha</th>
                        <th >Accion</th>
                        <th >Detelle</th>
                    </tr>
                    @foreach($detalles as $detalle)
                        <tr >
                            <td >{{$detalle->fecha}}</td>
                            <td >{{$detalle->accion}}</td>
                            <td >{{$detalle->detalle}}</td>
                        </tr>
                    @endforeach
                </table>
                {{$detalles->links()}}
            </div>
        </div>
    </div>
@endsection