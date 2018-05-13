@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <div class="container">
        <div class="row">
            <br><br>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New Pozo</div>
                    <div class="card-body">
                        <a href="{{ url('/pozo') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/pozo') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('pozo.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('js/ubicacion.js')}}"></script>
<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEyfRYnN_D85H6uK3iG0mtmKqpfG71Ras&libraries=places"></script>
