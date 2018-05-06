@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <br>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h1 id="cabeza">Lista de Grupo de Usuario</h1>
            <br>
            <div id="tbody">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th> <th>Nombre</th><th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categorias as $item)
                        <tr>
                            <td>{{ $loop->iteration or $item->id }}</td>
                            <td>{{$item->nombre}}</td>
                            <td>
                                <a href="{{ route('permiso.mostrar', $item->id) }}" class="btn btn-primary" aria-label="Skip to main navigation">
                                    <i class="fa fa-list-ol" aria-hidden="true" > Permisos</i>
                                </a>
                                <form method="POST" action="{{ url('/categoria' . '/' . $item->nombre) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-xs" title="Delete privilegio" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection