@extends('layouts.admin')
@section('content')

    @include('alerts.request')
    @include('alerts.existfail')
    @include('alerts.success')
    <body>
    <h1 id="cabeza">Curvas de Declinacion hiperbolica Valores</h1>
    <div id="tbody">
        <a href="{{ url('/hiperbolica/cargar/'.$id_pozo) }}" class="btn btn-success btn-sm" title="Add New Declinacion">
        <i class="fa fa-plus" aria-hidden="true"></i> Añadir nuevo Valor..
        </a>

        {!! Form::open(['route' => 'hiperbolica.graficar','method' => 'POST']) !!}
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>qi </th>
                <th>q</th>
                <th>D</th>
                <th>b</th>
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
                    <td>{{$item->b}}</td>
                    <td>
                        <input  type="checkbox" name="{{$item->id}}" value="1" >
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <!--  -->{!! Form::submit('Graficar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}

    </div>

    </body>
@endsection