@extends('layouts.admin')
@section('content')


    <h1 id="cabeza">Volumetrico</h1>
    <div id="temps_div"></div>

    <?= $graf->render('LineChart', 'g1', 'temps_div') ?>
            <div class="row">
              <!--  -->{!! Form::open(['route' => 'volumetrico.nueva','method' => 'POST']) !!}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" id="nombre" type="text"  name="nombre" value="Año" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apellido">Área (Acre)
                        </label>
                        <input class="form-control" id="a" type="number" step="any" name="a" value="{{ $request->a or 10000}}" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apellido">Espesor
                        </label>
                        <input class="form-control" id="h" type="number" step="any" name="h" value="{{ $request->h or 100}}"  required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apellido">Porocidad %
                            </label>
                        <input class="form-control" id="o" type="number" step="any" name="o" value="{{ $request->o or 0.5}}" required >
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apellido">SWC
                            </label>
                        <input class="form-control" id="swc" type="number" step="any" name="swc" value="{{ $request->swc or 0.6}}" required >
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apellido"> Bg
                            </label>
                        <input class="form-control" id="b" type="number" step="any" name="b" value="{{ $request->swc or 0.6}}" required >
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apellido">Factor Volumetrico
                            </label>
                        <select id="gop" name="gop">
                            <option value="0" selected>sfc/ft3</option>
                            <option value="1" >ft3/sfc</option>
                        </select>
                    </div>
                </div>



              <!--  -->{!! Form::submit('Añadir' , ['class'=>'btn btn-primary btn-lg btn-block']) !!}
            </div>
    <div id="tbody">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Año </th>
                <th>Area (Acres)</th>
                <th>Espesor</th>
                <th>Porocidad %</th>
                <th>SWC</th>
                <th>BG</th>
                <th>Factor Volumetrico</th>
                <th><strong> Volumen</strong></th>

            </tr>
            </thead>
            <tbody>
            @foreach($tabla as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{$item->a}}</td>
                    <td>{{$item->h}}</td>
                    <td>{{$item->o}}</td>
                    <td>{{$item->swc}}</td>
                    <td>{{$item->b}}</td>
                    <td> @if($item->gop==0)sfc/ft3 @else ft3/sfc @endif </td>
                    <td><stron>{{$item->g}}</stron> </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection