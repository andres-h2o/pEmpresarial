<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Practica Empresarial</title>

    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/metisMenu.min.css')!!}
    {!!Html::style('css/bootstrap-datetimepicker.min.css')!!}
    {!!Html::style('css/sb-admin-2.css')!!}
    {!!Html::style('css/myStyle.css')!!}
    {!!Html::style('css/ie8.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/bootstrap-responsive.css')!!}
    {!!Html::style('css/bootstrap-timepicker.min.css')!!}
</head>

<body>
<div id="wrapper" class="panel panel-primary ">

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <!-- Aqui el nav o cabezera -->

        <!-- Lado Izquierdo -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/home') }}">Practica Empresarial</a>
        </div>
        <!-- Fin del Lado Izquierdo -->

        <!-- Lado Derecho -->
        <ul class="nav navbar-top-links navbar-right">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    {{ Auth::user()->name }} <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
                </a>

                <ul class="dropdown-menu dropdown-user">

                    <li>
                        <a href="{{ url('/login') }}"><i class="fa fa-gear fa-fw"></i> Registrar</a>
                    </li>

                    <li class="divider"></li>

                    <li>
                        <a href="{{ url('/login') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                </ul>
            </li>
        </ul>
        <!-- Fin Lado Derecho -->
        <!-- Aqui Finaliza el nav o cabezera -->


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <!-- *************************************-->
                    <!-- * G E S T I O N  D E  USUARUIOS  *-->
                    <!-- *************************************-->
                    @if (count(\Practica\User::join('permisos as p','p.id_categoria','users.id_categoria')
           ->where('users.id',Auth::user()->id)->where('id_privilegio',1)->get())==1)
                        <li>
                            <a href="#">
                                <i class="fa fa-users fa-fw"></i> Menú Seguridad<span class="fa arrow"></span>
                            </a>

                            <ul class="nav nav-second">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-magic fa-address-book"></i> Usuarios<span
                                                class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('user.create') }}">
                                                <i class="fa fa-user-plus"></i> Registrar Usuarios
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ url('user') }}">
                                                <i class='fa fa-list-ol fa-fw'></i> Listar Usuarios
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-magic fa-fw"></i> Grupo de Usuario<span
                                                class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('categoria.create') }}">
                                                <i class="fa fa-plus"></i> Registrar Grupo de Usuario
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('categoria') }}">
                                                <i class='fa fa-list-ol fa-fw'></i> Listar
                                                Grupo de Usuario
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-key fa-fw"></i> Privilegios<span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-third-level">
                                        {{-- <li>
                                             <a href="{{ route('privilegio.create') }}">
                                                 <i class="fa fa-plus"></i> Registrar Privilelgio
                                             </a>
                                         </li>--}}
                                        <li>
                                            <a href="{{ url('privilegio') }}">
                                                <i class='fa fa-list-ol fa-fw'></i> Listar
                                                Privilegios
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- modulo curba de inclinacion  *-->

                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<i class="fa fa-yelp fa-fw"></i> Curva de Declinacion<span--}}
                                        {{--class="fa arrow"></span>--}}
                            {{--</a>--}}
                            {{--<ul class="nav nav-third-level">--}}
                                {{--<li>--}}
                                    {{--<a href="{{url('/exponencial')}}">--}}
                                        {{--<i class="fa fa-plus"></i> Exponencial--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="{{url('/hiperbolica')}}">--}}
                                        {{--<i class="fa fa-plus"></i> Hiperbolica--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="{{url('/armonica')}}">--}}
                                        {{--<i class="fa fa-plus"></i> Armonica--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        <li>
                            <a href="{{url('/volumetrica/ver')}}">
                                <i class="fa fa-yelp fa-fw"></i> Volumétrica
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/pozo')}}">
                                <i class="fa fa-yelp fa-fw"></i> Pozos
                            </a>
                        </li>
                    @endif

                    @if (count(\Practica\User::join('permisos as p','p.id_categoria','users.id_categoria')
                     ->where('users.id',Auth::user()->id)->where('id_privilegio',2)->get())==1)
                        <li>
                            <a href="#">
                                <i class="fa fa-users fa-fw"></i> Menú RRHH<span class="fa arrow"></span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <div id="page-wrapper" role="main">
        <br><br>
        @yield('content')
    </div>
</div>
{!!Html::script('js/jquery.min.js')!!}
{!!Html::script('js/bootstrap-tooltip.js')!!}
{!!Html::script('js/bootstrap.min.js')!!}
{!!Html::script('js/bootstrap-datetimepicker.min.js')!!}
{!!Html::script('js/bootstrap-timepicker.min.js')!!}
{!!Html::script('js/metisMenu.min.js')!!}
{!!Html::script('js/sb-admin-2.js')!!}
{!!Html::script('js/bootstrap-confirmation.min.js')!!}


@yield('script')

<script>
    $('[data-toggle="confirmation"]').confirmation({
        href: function (elem) {
            return $(elem).attr('href');
        }
    });
</script>

</body>

</html>
