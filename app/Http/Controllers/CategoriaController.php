<?php

namespace Practica\Http\Controllers;

use Khill\Lavacharts\Lavacharts;
use Practica\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Practica\Declinacion;


class CategoriaController extends Controller
{
    private $lava;
    private $grafico;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usuarios');
        $this->lava = new Lavacharts; // See note below for Laravel

        $this->grafico = $this->lava->DataTable();

        $this->grafico->addNumberColumn('Tiempo')
            ->addNumberColumn('Q Exponencial')
            ->addNumberColumn('Q Hiperbolica')
            ->addNumberColumn('Q Harmonica');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.lista', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:50',
        ]);

        Categoria::create([
            'nombre' => $request['nombre']
        ]);


        //$campista = Campista::_getcampista()->get()->first();
        Session:: flash('message', 'Usuario registrado exitosamente...');
        //return view('boleta.create',compact('campista'));

        return view('categoria.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private $hola = 0;

    public function graficaNueva(Request $request)
    {
        Declinacion::truncate();
        $qi = $request['qi'];
        $q = $request['q'];
        $d = $request['d'];
        $b = $request['b'];

        $Df1 = ((($qi - $q) / $d) * 365); /*formula declinacion exponencial nominal anual  */
        $Df2 = (pow($qi,$b)/((1-$b)*$d))*((pow($qi,(1-$b))-pow($q,(1-$b))))*365; /*formula declinacion hiperbolica nominal anual  */
        $Df3 = (($qi/$d)*log($qi/$q)*365); /*formula declinacion harmonica nominal anual  */

        $t = (($qi/$q)-1)/$Df3;/* tiempo vida productiva harmonica */
        Declinacion::create([
            "t" => 0,
            "v1" => $qi,
            "v2" => $qi,
            "v3" => $qi,
        ]);
        for ($i = 1; $i <= $t; $i = $i + 1) {
            $qaux1 = $qi * exp(-$Df1 * $i); /* formula exponecial*/
            $qaux2 = $qi *pow((1+$Df2*$i*$b),(-1/$b)) /*formula hiperbolica*/;
            $qaux3 = $qi /(1+$Df3*$i); /*formula harmonica*/
            //return $qaux;
            Declinacion::create([
                "t" => $i,
                "v1" => $qaux1,
                "v2" => $qaux2,
                "v3" => $qaux3,
            ]);
        }


        $declinacion = Declinacion::all();
        $g1 = $this->grafico;
        foreach ($declinacion as $item) {
            $g1->addRow([$item->t, $item->v1, $item->v2, $item->v3]);
        }
        $this->lava->LineChart('g1', $this->grafico, [
            'title' => 'Curvas de Declinación'
        ]);
        $graf = $this->lava;
    $tabla  =Declinacion::all();
        return view('grafico', compact("graf","tabla","request"));

    }

    private $datos = [];

    public function grafico()
    {
        // return $request['sw'];
        $this->lava->LineChart('g1', $this->grafico, [
            'title' => 'Curvas de Declinación'
        ]);
        $graf = $this->lava;
        $request=null;
        $tabla=[];
        return view('grafico', compact("graf","request","tabla"));
    }
}
