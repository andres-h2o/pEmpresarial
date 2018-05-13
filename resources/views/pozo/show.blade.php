@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <div class="container">
        <div class="row">

            <br><br>
        <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h2>Pozo {{ $pozo->Pozo }}</h2></div>
                    <div class="card-body">

                       {{-- <a href="{{ url('/pozo') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/pozo/' . $pozo->id . '/edit') }}" title="Edit Pozo"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('pozo' . '/' . $pozo->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Pozo" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>--}}
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $pozo->id }}</td>
                                    </tr>
                                    <tr><th> Pozo </th><td> {{ $pozo->Pozo }} </td></tr><tr><th> Latitud </th><td id="x"> {{ $pozo->x }} </td></tr><tr><th> Longitud </th><td id="y"> {{ $pozo->y }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            {!! Form::label(' ',null,['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary btn-lg btn-block" id="btnUbicacion">
                                    Ver  Ubicación
                                </button>
                                <div class="col-md-6" id="map" style="width: 100%;height: 40%  ;"></div>
                                <input type="numbre" class="form-control" step="any" style="display: none" id="inLat" name="x">
                                <input type="numbre" class="form-control" step="any" style="display: none"id="inLon" name="y">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('js/ubicacionVer.js')}}"></script>
<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEyfRYnN_D85H6uK3iG0mtmKqpfG71Ras&libraries=places"></script>
