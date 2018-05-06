@extends('layouts.admin')
@section('content')

    @include('alerts.request')
    @include('alerts.existfail')
    @include('alerts.success')
    <h1 id="cabeza">Curvas de Declinacion Exponencial Valores</h1>
    <div id="tbody">
        <a href="{{ url('/exponencial/cargar') }}" class="btn btn-success btn-sm" title="Add New Declinacion">
        <i class="fa fa-plus" aria-hidden="true"></i> Añadir nuevo Valor..
        </a>

        {!! Form::open(['route' => 'exponencial.graficar','method' => 'POST']) !!}
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>qi </th>
                <th>q</th>
                <th>D</th>
                <th>Seleccionar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lista as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{$item->qi}}</td>
                    <td>{{$item->q}}</td>
                    <td>{{$item->d}}</td>
                    <td>
                        <input  type="checkbox" name="{{$item->id}}" value="1" >
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <!--  -->{!! Form::submit('Graficar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}

    </div>
  

@endsection