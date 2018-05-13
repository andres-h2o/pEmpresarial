@extends('layouts.admin')
@section('content')
    @include('alerts.success')
    @include('alerts.request')
    <div class="container">
        <div class="row">

            <br><br>
        <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h3>Pozo</h3></div>
                    <div class="card-body">
                        <a href="{{ url('/pozo/create') }}" class="btn btn-success btn-sm" title="Add New Pozo">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo Pozo
                        </a>

                        <form method="GET" action="{{ url('/pozo') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Pozo</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pozo as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->Pozo }}</td>
                                        <td>
                                            <a href="{{ url('/pozo/' . $item->id) }}" title="View Pozo"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('exponencial/ver/' . $item->id) }}" ><button class="btn btn-primary btn-sm"><i class="fa fa-line-chart" aria-hidden="true"></i> Exponencial</button></a>
                                            <a href="{{ url('hiperbolica/ver/' . $item->id) }}"><button class="btn btn-primary btn-sm"><i class="fa fa-line-chart" aria-hidden="true"></i> Hiperbolica</button></a>
                                            <a href="{{ url('armonica/ver/' . $item->id) }}" ><button class="btn btn-primary btn-sm"><i class="fa fa-line-chart" aria-hidden="true"></i> Armonica</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $pozo->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
