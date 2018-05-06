@if (count($permiso) > 0)
    <table class="table table-hover">
        <tr class="info">
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Carnet</th>
            <th>F. Nacimiento</th>
            <th>Telefono</th>
            <th>Opciones</th>
        </tr>
        @foreach($pastores as $directivo)
            <tr class="warning">
                <td>{{$directivo->nombre}}</td>
                <td>{{$directivo->apellido}}</td>
                <td>{{$directivo->ci}}</td>
                <td>{{$directivo->fecha_nacimiento}}</td>
                <td>{{$directivo->telefono}}</td>
                <td>

                    {!! Form::open(['method'=>'DELETE', 'route'=>['pastor.destroy',$directivo->ci]]) !!}
                    <a href="{{ route('pastor.edit', $directivo->ci) }}" class="btn btn-warning" aria-label="Skip to main navigation">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <button class="btn btn-danger" type="submit"
                            data-toggle="confirmation"
                            data-placement="left"
                            data-title="¿Quieres continuar eliminando a {{$directivo->nombre}}?"
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
    {{$pastores->links()}}
    <script>
        $('[data-toggle="confirmation"]').confirmation({
            href: function(elem){
                return $(elem).attr('href');
            }
        });
    </script>
@else
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <h3 style="text-align: center;">
                <b style="text-align: center;">{{$search}}</b> no fue encontrado!!!.
            </h3>
        </div>
    </div>
@endif