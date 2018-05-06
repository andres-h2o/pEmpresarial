@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <br>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h1 id="cabeza">Lista de Usuarios</h1>
            <br>
            <div id="tbody">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Nombre</th>
                        <th>Grupos</th>
                        <th>Opciones</th>
                    </tr>
                    @foreach($usuarios as $usuario)
                        <tr class="warning">
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->categoria}}</td>
                            <td>

                                {!! Form::open(['method'=>'DELETE', 'route'=>['user.destroy',$usuario->id]]) !!}
                                <a href="{{ route('user.edit', $usuario->id) }}" class="btn btn-warning" aria-label="Skip to main navigation">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <button class="btn btn-danger" type="submit"
                                        data-toggle="confirmation"
                                        data-placement="left"
                                        data-title="¿Quieres continuar eliminando a {{$usuario->name}}?"
                                        data-btnOkClass="btn btn-primary"
                                        data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                                        data-btnCancelClass="btn btn-default"
                                        data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                                <a href="{{ route('bitacora.show', $usuario->id) }}" class="btn btn-info" aria-label="Skip to main navigation">
                                    <i class="fa fa-list-ol" aria-hidden="true" > Bitacora</i>
                                </a>

                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                </table>

            </div>
        </div>
    </div>
@endsection
