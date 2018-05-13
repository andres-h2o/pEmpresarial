<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('permiso/asignar/{id_categoria}', 'PermisoController@asignar')->name('permiso.asignar');
Route::get('pastor/searchPastor/', 'PastorController@searchPastor');
Route::get('pastor/PastorPaginatesearch/', 'PastorController@PastorPaginatesearch');
Route::get('campista/searchCampistas/', 'CampistaController@searchCampistas');
Route::get('campista/CampistaPaginatesearch/', 'CampistaController@CampistaPaginatesearch');
Route::get('evento/searchCampistas/', 'EventoController@searchCampistas');
Route::get('evento/CampistaPaginatesearch/', 'EventoController@CampistaPaginatesearch');
Route::get('grafico', 'CategoriaController@grafico');
Route::post('grafica/nueva', 'CategoriaController@graficaNueva')->name('grafica.nueva');


Route::get('evento/opciones', 'EventoController@index2');
Route::get('puntaje/control', 'PuntajeController@index2');
Route::get('detalleBitacora/detalle/{id_detalle}', 'DetalleBitacoraController@detalle')->name('detalleBitacora.detalle');
Route::get('detalleMovimiento/listado/{id_informe}', 'DetalleMovimientoController@listado')->name('detalleMovimiento.listado');
Route::post('detalleMovimiento/guardar/{id_informe}', 'DetalleMovimientoController@store')->name('detalleMovimiento.guardar');


Route::resource('campista', 'CampistaController');
Route::resource('pastor', 'PastorController');
Route::resource('iglesia', 'IglesiaController');
Route::resource('evento', 'EventoController');
Route::resource('grupo', 'GrupoController');
Route::resource('lider', 'LiderController');
Route::resource('detallePuntaje', 'DetallePuntajeController');
Route::resource('user', 'UserController');
Route::resource('bitacora', 'BitacoraController');
Route::resource('detalleBitacora', 'DetalleBitacoraController');
Route::resource('detalleMovimiento', 'DetalleMovimientoController');
Route::resource('informe', 'InformeController');
Route::resource('privilegio', 'PrivilegioController');
Route::resource('categoria', 'CategoriaController');
Route::resource('permiso', 'PermisoController');


Route::resource('puntaje', 'PuntajeController');
Route::get('puntaje/nuevo/{id_evento}', 'PuntajeController@nuevo')->name('puntaje.nuevo');
Route::get('puntaje/detalles/{id_evento}', 'PuntajeController@detalles')->name('puntaje.detalles');
Route::get('puntaje/printPuntaje/{evento}', 'PuntajeController@printPuntaje')->name('puntaje.printPuntaje');

Route::post('lider/guardar/{id_grupo}', 'LiderController@store')->name('lider.guardar');

//composer install

Route::resource('boleta', 'BoletaController');
Route::post('boleta/guardar/{id_campista}', 'BoletaController@store')->name('boleta.guardar');
Route::get('boleta/printBoleta/{boleta}', 'BoletaController@printBoleta')->name('boleta.printBoleta');

Route::get('informe/printInforme/{id_informe}', 'InformeController@printInforme')->name('informe.printInforme');


Route::get('evento/todos/{id_evento}', 'EventoController@todos')->name('evento.todos');
Route::get('evento/printTodos/{evento}', 'EventoController@printTodos')->name('evento.printTodos');


Route::get('evento/colores/{id_gestion}', 'EventoController@colores')->name('evento.colores');
Route::get('evento/printColores/{grupo}/{evento}', 'EventoController@printColores')->name('evento.printColores');
Route::get('evento/iglesias/{evento}', 'EventoController@iglesias')->name('evento.iglesias');
Route::get('evento/printIglesias/{iglesia}/{evento}', 'EventoController@printIglesias')->name('evento.printIglesias');
Route::get('evento/lideres/{evento}', 'EventoController@lideres')->name('evento.lideres');

Route::get('grupo/lideres/{grupo}', 'GrupoController@lideres')->name('grupo.lideres');
Route::get('detalleMovimiento/registrar/{id_informe}', 'DetalleMovimientoController@registrar')->name('detalleMovimiento.registrar');

Route::get('permiso/mostrar/{id_usuario}', 'PermisoController@mostrar')->name('permiso.mostrar');
Route::get('permiso/mostrar1/{id_usuario}', 'PermisoController@mostrar')->name('permiso.mostrar1');


Route::get('telefonos/{ci}', 'TelefonoController@index');
Route::get('trabajos/{ci}', 'TrabajoController@index');

Route::delete('/{ci}', 'MiembroController@destroy');

Route::resource('persona','PersonaController');
Route::resource('telefono','TelefonoController');
Route::resource('trabajo','TrabajoController');
Route::resource('bautismo','BautismoController');
Route::resource('ministerio','MinisterioController');
Route::resource('miembro','MiembroController');
Route::resource('encuentro','EncuentroController');
Route::resource('celula','CelulaController');
Route::resource('escuela', 'EscuelaController');
Route::resource('reunion', 'ReunionController');


Route::resource('estaditica_clientes','EstadisticasClientesController@index');


Route::resource('declinacion', 'DeclinacionController');


Route::get('exponencial', 'ExponecialController@lista');
Route::get('exponencial/cargar/{id_pozo}', 'ExponecialController@cargar');
Route::post('exponencial/nuevo/{id_pozo}', 'ExponecialController@nuevo')->name('exponencial.nuevo');
Route::post('exponencial/graficar', 'ExponecialController@graficar')->name('exponencial.graficar');


Route::get('hiperbolica', 'HiperbolicaController@lista');
Route::get('hiperbolica/cargar/{id_pozo}', 'HiperbolicaController@cargar');
Route::post('hiperbolica/nuevo/{id_pozo}', 'HiperbolicaController@nuevo')->name('hiperbolica.nuevo');
Route::post('hiperbolica/graficar', 'HiperbolicaController@graficar')->name('hiperbolica.graficar');


Route::get('armonica', 'ArmonicaController@lista');
Route::get('armonica/cargar/{id_pozo}', 'ArmonicaController@cargar');
Route::post('armonica/nuevo/{id_pozo}', 'ArmonicaController@nuevo')->name('armonica.nuevo');
Route::post('armonica/graficar', 'ArmonicaController@graficar')->name('armonica.graficar');

Route::resource('volumetrico', 'VolumetricoController');
Route::get('volumetrica/ver', 'VolumetricoController@ver');
Route::post('volumetrica/nueva', 'VolumetricoController@nueva')->name('volumetrico.nueva');
Route::resource('pozo', 'PozoController');
Route::get('exponencial/ver/{id_pozo}', 'ExponecialController@lista');
Route::get('hiperbolica/ver/{id_pozo}', 'HiperbolicaController@lista');
Route::get('armonica/ver/{id_pozo}', 'ArmonicaController@lista');