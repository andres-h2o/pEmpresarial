@extends('layouts.admin')
@section('content')
    @include('alerts.request')
    @include('alerts.success')
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading" align="center" style="font-size: 20px">
            <strong>Formulario Para Crear Usuario</strong>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'user.store','method' => 'POST']) !!}
            <div class="row">
                <div class="col-lg-6" style="padding-left: 30px">
                    {!! Form::label('Nombre:') !!}
                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre...']) !!}
                    <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    {!! Form::label('email:') !!}
                    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el e-mail...']) !!}
                    <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <br>
            <div class="row">
                <div class="col-lg-6" style="padding-left: 30px">
                    {!! Form::label('password') !!}
                    {!! Form::password('password',['class'=>'form-control','placeholder'=>'Ingresa el password...']) !!}

                </div><!-- /.col-lg-6 -->

                <div class="col-lg-6" style="padding-left: 30px">
                    {!! Form::label('Grupo de Usuario: ') !!} <br>
                    {!! Form::select('id_categoria',$categoria, null, ['class'=>'form-control','placeholder'=>'Seleccione un Grupo...']) !!}
                    <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <br>

            <div class="form-group" align="center">
                {!! Form::submit('Crear' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

