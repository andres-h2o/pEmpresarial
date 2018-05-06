@extends('layouts.admin')
@section('content')


    <h1 id="cabeza">Curvas de Declinacion hiperbolica Gráfico</h1>
    <div id="temps_div"></div>

    <?= $graf->render('LineChart', 'g1', 'temps_div') ?>
    <div class="col-lg-3" style="padding-left: 30px">
        <h2>{{$n1}}</h2>
        <table id="_TABLA_R" border="1">
            <tr>
                <th>Tiempo</th>
                <th style="text-align: center">q <br>(STB/d)</th>
            </tr>
            @foreach($lista1 as $item)
                <tr>
                    <td>{{ $item->t }}</td>
                    <td>{{$item->q}}</td>

                </tr>
            @endforeach
        </table>

    </div>
    @if($contador>1)
        <div class="col-lg-3" style="padding-left: 30px">
            <h2>{{$n2}}</h2>
            <table id="_TABLA_R" border="1">
                <tr>
                    <th>Tiempo</th>
                    <th style="text-align: center">q <br>(STB/d)</th>
                </tr>
                @foreach($lista2 as $item)
                    <tr>
                        <td>{{ $item->t }}</td>
                        <td>{{$item->q}}</td>

                    </tr>
                @endforeach
            </table>
        </div>
        @if($contador>2)
            <div class="col-lg-3" style="padding-left: 30px">
                <h2>{{$n3}}</h2>
                <table id="_TABLA_R" border="1">
                    <tr>
                        <th>Tiempo</th>
                        <th style="text-align: center">q <br>(STB/d)</th>
                    </tr>
                    @foreach($lista3 as $item)
                        <tr>
                            <td>{{ $item->t }}</td>
                            <td>{{$item->q}}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
            @if($contador>3)
                <div class="col-lg-3" style="padding-left: 30px">
                    <h2>{{$n4}}</h2>
                    <table id="_TABLA_R" border="1">
                        <tr>
                            <th>Tiempo</th>
                            <th style="text-align: center">q <br>(STB/d)</th>
                        </tr>
                        @foreach($lista4 as $item)
                            <tr>
                                <td>{{ $item->t }}</td>
                                <td>{{$item->q}}</td>

                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        @endif
    @endif

@endsection