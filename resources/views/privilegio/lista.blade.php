@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <br>
    <div class="panel panel-primary">
        <div class="panel-body">


            <h1 id="cabeza">Lista de Privilegios</h1>

            <br>


            <div id="tbody">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Nombre de Caso de Uso</th>

                    </tr>
                    @foreach($privilegios as $privilegio)
                        <tr class="warning">
                            <td>{{$privilegio->cu}}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection