@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <br>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h1 id="cabeza">Lista de Acciones del Usario {{$usuario->nombre}} en fecha {{$usuario->fecha}}</h1>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="text" class="form-control" placeholder="Busqueda por color..." name="search" id="search">
                </div>
            </div>
            <div id="tbody">

                                <td >{{$detalle->fecha}}</td>
                                <td >{{$detalle->accion}}</td>
                                <td>
                                    <a href="{{ route('detalleBitacora.detalle', $detalle->id) }}" class="btn btn-success" aria-label="Skip to main navigation">
                                        <i class="fa fa-check" aria-hidden="true"> Abrir</i>
                                    </a>

                                </td>
                            </tr>

                {{$detalles->links()}}
            </div>
        </div>
    </div>
@endsection