@extends('layouts.admin')
@section('content')
    @include('alerts.request')
    @include('alerts.success')
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading" align="center" style="font-size: 20px">
            <strong>Formulario Para Crear pribilegio</strong>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'privilegio.store','method' => 'POST']) !!}
            <div class="form-group">
                    {!! Form::label('CU:') !!}
                    {!! Form::text('cu',null,['class'=>'form-control','placeholder'=>'Ingresa el CU...']) !!}
                    <span class="col-lg-6" style="color: #ff0000;">Dato obligatorio</span>

            </div><!-- /.row -->
            <br>
            <div class="form-group" align="center">
                {!! Form::submit('Crear' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

