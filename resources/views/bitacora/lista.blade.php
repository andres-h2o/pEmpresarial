@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <br>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h1 id="cabeza">Lista de Bitacoras</h1>
            <br>
            <div id="tbody">
                <table class="table table-hover">
                    <tr class="info">
                        <th >Fecha</th>
                        <th>Opciones</th>
                    </tr>
                    @foreach($bitacoras as $bitacora)
                        <tr class="warning">
                            <td style="font-style: italic">{{$bitacora->created_at}}</td>
                            <td>
                                <a href="{{ route('detalleBitacora.show', $bitacora->id) }}" class="btn btn-success" aria-label="Skip to main navigation">
                                    <i class="fa fa-check" aria-hidden="true"> Abrir</i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </table>
                {{$bitacoras->links()}}
            </div>
        </div>
    </div>
@endsection