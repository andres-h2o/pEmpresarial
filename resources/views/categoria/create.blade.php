@extends('layouts.admin')
@section('content')
    @include('alerts.request')
    @include('alerts.success')
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading" align="center" style="font-size: 20px">
            <strong>Formulario Para Asignar Permiso</strong>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'categoria.store','method' => 'POST']) !!}
            <div class="row">
                <div class="col-lg-6" style="padding-left: 30px">
                    {!! Form::label('Categoria:') !!}
                    {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa grupo de usuario...']) !!}
                    <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
                </div><!-- /.col-lg-6 -->

            </div><!-- /.row -->
            <br>
            <div class="form-group" align="center">
                {!! Form::submit('Guardar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

