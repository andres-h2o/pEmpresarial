@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <br>
    <div class="panel panel-primary">
        <div class="panel-body">


            <h1 id="cabeza">Lista de Permisos de {{$categoria->nombre}} </h1>

            <br>

            {!! Form::open(['route' => ['permiso.asignar', $categoria->id],'method' => 'POST']) !!}
            <div class="panel-body">

                <form>
                    <input  type="checkbox" name="v1" value="1" @if($categoria->v1==1)checked @endif > Seguridad<br>
                    <input  type="checkbox" name="v2" value="1" @if($categoria->v2==1)checked @endif > RRHH<br>
                    <input  type="checkbox" name="v3" value="1" @if($categoria->v3==1)checked @endif > Contabilidad<br>
                    <input type="checkbox" name="v4" value="1" @if($categoria->v4==1)checked @endif > Ventas
                </form>
                {{--<div class="row">

                    <div class="col-lg-6" style="padding-left: 30px">
                        {!! Form::label('Privilegio:') !!}
                        {!! Form::select('id_privilegio',$sinpermisos,null,['class'=>'form-control','placeholder'=>'Seleccionar Privilegio...']) !!}
                    </div>
                    <div class="col-lg-6" style="padding-left: 30px">
                        <br>

                        <form methods="post" href="{{ route('permiso.asignar', $categoria->id) }}" class="btn btn-info"
                              aria-label="Skip to main navigation">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus" aria-hidden="true">
                                    Asignar
                                </i>
                            </button>

                        </form>
                    </div>
                </div>--}}
                <div class="form-group" align="center">
                    {!! Form::submit('Guardar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
                </div>
            </div>
            {!! Form::close() !!}




           {{-- <br>

            <div id="tbody">
                <table class="table table-hover">
                    <tr style="background: orange;color:darkblue ">
                        <th>Privilegio</th>
                        <th>Opciones</th>
                    </tr>
                    @foreach($permisos as $permiso)
                        <tr class="warning">
                            <td>{{$permiso->cu}}</td>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'route'=>['permiso.destroy',$permiso->id]]) !!}

                                <button class="btn btn-danger" type="submit"
                                        data-toggle="confirmation"
                                        data-placement="left"
                                        data-title="¿Quieres continuar eliminando  {{$permiso->cu}}?"
                                        data-btnOkClass="btn btn-primary"
                                        data-btnOkLabel='<i class="fa fa-check-circle"></i> Si'
                                        data-btnCancelClass="btn btn-default"
                                        data-btnCancelLabel='<i class="fa fa-times-circle" aria-hidden="true"></i> No'>
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                                {!! Form::close() !!}
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>--}}
        </div>
    </div>
    </div>
@endsection