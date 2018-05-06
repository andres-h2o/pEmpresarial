<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe<br> {{$evento->nombre}}</title>
    {!!Html::style('css/myStyle.css')!!}
</head>
<style type="text/css">
    .table-and {
        border: 1px solid black;
        width: 100%;
        border-collapse: collapse;
    }

    .th-and, .td-and {
        border: 1px solid black;
        padding: 4px;
        text-align: left;
    }

    .tr-and {
        background: #c9c9c9;
    }
</style>
<body>
<a class="image featured"><img src="images/cavezera1.png" style="width: 100%  "/></a>

<h1 id="cabeza">Informe<br> {{$evento->nombre}}</h1>


<div class="panel panel-default">
    <h4 class="panel-title">

        <strong>Ingresos</strong>
    </h4>

    <div>
        <div class="panel-body">

            <table class="table-and">
                <tr class="tr-and">
                    <th class="th-and">Fecha</th>
                    <th class="th-and">Responsable</th>
                    <th class="th-and">Detalle</th>
                    <th class="th-and">Monto</th>
                </tr>
                @foreach($ingresos as $ingreso)

                    <tr>
                        <td class="td-and">{{$ingreso->fecha}}</td>
                        <td class="td-and">{{$ingreso->responsable}}</td>
                        <td class="td-and">{{$ingreso->detalle}}</td>
                        <td class="td-and">{{$ingreso->monto}} Bs.</td>

                    </tr>

                @endforeach
                <tr style="background:chartreuse ">
                    <td><strong> Total Ingresos:</strong></td>
                    <td></td>
                    <td></td>
                    <td><strong>{{$informe->ingresos}}</strong> Bs.</td>

                </tr>
            </table>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <h4 class="panel-title">

        <strong>Egresos</strong>
    </h4>

    <div>
        <div class="panel-body">

            <table class="table-and">
                <tr class="tr-and">
                    <th class="th-and">Fecha</th>
                    <th class="th-and">Responsable</th>
                    <th class="th-and">Detalle</th>
                    <th class="th-and">Monto</th>
                </tr>
                @foreach($egresos as $egreso)
                    <tr style="background: #eea236">
                        <td> {{$egreso->first()->dia}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($egreso as $detalle)
                        <tr>
                            <td class="td-and">{{$detalle->fecha}}</td>
                            <td class="td-and">{{$detalle->responsable}}</td>
                            <td class="td-and">{{$detalle->detalle}}</td>
                            <td class="td-and">{{$detalle->monto}} Bs.</td>

                        </tr>
                    @endforeach
                @endforeach
                <tr style="background: yellow">
                    <td><strong> Total Egresos:</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
            </table>
        </div>
    </div>
</div>
<br>
<br>

<div class="panel panel-default">


    <div>
        <div class="panel-body">

            <table class="table-and">
                <tr style="background: cadetblue">
                    <td><strong>Totales</strong></td>
                    <td></td>
                </tr>
                <tr >
                    <td class="td-and"> Total Ingresos</td>
                    <td class="td-and">{{$informe->ingresos}} Bs. </td>
                </tr>
                <tr >
                    <td class="td-and"> Total Egresos</td>
                    <td class="td-and">({{$informe->egresos}} Bs.)</td>
                </tr>
                <tr style="background: lawngreen">
                    <td><strong> Saldo:</strong></td>
                    <td><strong>{{$informe->saldo}}</strong> Bs.</td>
                </tr>


            </table>
        </div>
    </div>
</div>


</body>
</html>