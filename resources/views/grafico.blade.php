@extends('layouts.admin')
@section('content')


    <h1 id="cabeza">Curvas de Declinacion</h1>
    <div id="temps_div"></div>

    <?= $graf->render('LineChart', 'g1', 'temps_div') ?>
            <div class="row">
              <!--  -->{!! Form::open(['route' => 'grafica.nueva','method' => 'POST']) !!}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nombre">qi</label>
                        <input class="form-control" id="qi" type="number" step="any" name="qi" value="{{ $request->qi or 100}}" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apellido">q
                        </label>
                        <input class="form-control" id="q" type="number" step="any" name="q" value="{{ $request->q or 5}}" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apellido">D
                        </label>
                        <input class="form-control" id="d" type="number" step="any" name="d" value="{{ $request->d or 70000}}"  required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apellido">b Hiperbolica
                            </label>
                        <input class="form-control" id="b" type="number" step="any" name="b" value="{{ $request->b or 0.5}}" required >
                    </div>
                </div>


              <!--  -->{!! Form::submit('Graficar' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
            </div>
    <div id="tbody">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>t <br>(Años)</th> <th>q Exponencial <br>STB/d</th><th>q Hiperbolica <br>STB/d</th><th>q Harmonica <br>STB/d</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tabla as $item)
                <tr>
                    <td>{{ $item->t }}</td>
                    <td>{{$item->v1}}</td>
                    <td>{{$item->v2}}</td>
                    <td>{{$item->v3}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection