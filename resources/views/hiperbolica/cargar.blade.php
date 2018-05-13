@extends('layouts.admin')
@section('content')


    <h1 id="cabeza">Curvas de Declinacion hiperbolica</h1>
    <div id="temps_div"></div>
    <div class="row">
        {!! Form::open(['route' => ['hiperbolica.nuevo',$id_pozo],'method' => 'POST']) !!}
        <div class="col-md-2">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input class="form-control" id="nombre" type="text" name="nombre" value="Año"
                       required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="nombre">qi</label>
                <input class="form-control" id="qi" type="number" step="any" name="qi" value="{{ $request->qi or 100}}"
                       required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="apellido">q
                </label>
                <input class="form-control" id="q" type="number" step="any" name="q" value="{{ $request->q or 5}}"
                       required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="apellido">D
                </label>
                <input class="form-control" id="d" type="number" step="any" name="d" value="{{ $request->d or 70000}}"
                       required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="apellido">D
                </label>
                <input class="form-control" id="b" type="number" step="any" name="b" value="{{ $request->b or 0.5}}"
                       required>
            </div>
        </div>

        <!--  -->{!! Form::submit('Guargar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
    </div>


@endsection