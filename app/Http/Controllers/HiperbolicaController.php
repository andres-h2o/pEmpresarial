<?php

namespace Practica\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Khill\Lavacharts\Lavacharts;
use Practica\Http\Requests;
use Practica\Http\Controllers\Controller;

use Practica\Hiperbolica;
use Illuminate\Http\Request;
use Practica\ValHip;

class HiperbolicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $hiperbolica = Hiperbolica::where('nombre', 'LIKE', "%$keyword%")
                ->orWhere('qi', 'LIKE', "%$keyword%")
                ->orWhere('q', 'LIKE', "%$keyword%")
                ->orWhere('d', 'LIKE', "%$keyword%")
                ->orWhere('b', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $hiperbolica = Hiperbolica::latest()->paginate($perPage);
        }

        return view('hiperbolica.index', compact('hiperbolica'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('hiperbolica.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Hiperbolica::create($requestData);

        return redirect('hiperbolica')->with('flash_message', 'Hiperbolica added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $hiperbolica = Hiperbolica::findOrFail($id);

        return view('hiperbolica.show', compact('hiperbolica'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $hiperbolica = Hiperbolica::findOrFail($id);

        return view('hiperbolica.edit', compact('hiperbolica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $hiperbolica = Hiperbolica::findOrFail($id);
        $hiperbolica->update($requestData);

        return redirect('hiperbolica')->with('flash_message', 'Hiperbolica updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Hiperbolica::destroy($id);

        return redirect('hiperbolica')->with('flash_message', 'Hiperbolica deleted!');
    }

    public function cargar()
    {
        $lista = Hiperbolica::all();
        return view('hiperbolica.cargar', compact('lista'));
    }

    public function nuevo(Request $request)
    {
        Hiperbolica::create([
            "nombre" => $request['nombre'],
            "qi" => $request['qi'],
            "q" => $request['q'],
            "d" => $request['d'],
            "b" => $request['b'],
        ]);
        $id_hiperbolica = Hiperbolica::select('id')->orderBy('id', 'desc')->get()->first()->id;
        $qi = $request['qi'];
        $q = $request['q'];
        $d = $request['d'];
        $b = $request['b'];

        $Df2 = (pow($qi,$b)/((1-$b)*$d))*((pow($qi,(1-$b))-pow($q,(1-$b))))*365; /*formula declinacion hiperbolica nominal anual  */



        $t = (pow(($qi / $q),($b))-1) / ($Df2*$b);/* tiempo vida productiva harmonica */
        ValHip::create([
            "t" => 0,
            "q" => $qi,
            "id_hiperbolica" => $id_hiperbolica,
        ]);
        for ($i = 1; $i <= $t; $i = $i + 1) {
            $qaux2 = $qi *pow((1+$Df2*$i*$b),(-1/$b)) /*formula hiperbolica*/;

            ValHip::create([
                "t" => $i,
                "q" => $qaux2,
                "id_hiperbolica" => $id_hiperbolica,
            ]);
        }
        ValHip::create([
            "t" => $t,
            "q" => $q,
            "id_hiperbolica" => $id_hiperbolica,
        ]);
        $lista = Hiperbolica::all();

        return view('hiperbolica.lista', compact('lista'));
    }

    public function graficar(Request $request)
    {
        $lava = new Lavacharts; // See note below for Laravel

        $grafico = $lava->DataTable();

        $grafico->addNumberColumn('Tiempo');
        $g1 = 0;
        $g2 = 0;
        $g3 = 0;
        $g4 = 0;
        $contador = 0;
        $exp = Hiperbolica::all();
        foreach ($exp as $item) {
            if ($request['' . $item->id] == 1) {
                $contador = $contador + 1;
                switch ($contador) {
                    case 1:
                        $g1 = $item->id;
                        break;
                    case 2:
                        $g2 = $item->id;
                        break;
                    case 3:
                        $g3 = $item->id;
                        break;
                    case 4:
                        $g4 = $item->id;
                        break;
                }
            }
        }

        switch ($contador) {
            case 1:
                $ax=Hiperbolica::find($g1);
                $grafico
                    ->addNumberColumn($ax->nombre);
                $lista = ValHip::where('id_hiperbolica', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValHip::where('id_hiperbolica', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $grafico->addRow([$c, $aux->q]);
                    $c = $c + 1;
                }
                break;
            case 2:
                $ax=Hiperbolica::find($g1);
                $ax2=Hiperbolica::find($g2);
                $grafico->addNumberColumn($ax->nombre)
                    ->addNumberColumn($ax2->nombre);
                $lista = ValHip::where('id_hiperbolica', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValHip::where('id_hiperbolica', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $aux2 = ValHip::where('id_hiperbolica', '=', $g2)->where('t', '>', $c-1)->get()->first();
                    $val1 = $aux->q;
                    if ($aux2 != '') {
                        $val2 = $aux2->q;
                    } else {
                        $val2 = 0;
                    }
                    $grafico->addRow([$c, $val1, $val2]);
                    $c = $c + 1;
                }
                break;
            case 3:
                $ax=Hiperbolica::find($g1);
                $ax2=Hiperbolica::find($g2);
                $ax3=Hiperbolica::find($g3);
                $grafico->addNumberColumn($ax->nombre)
                    ->addNumberColumn($ax2->nombre)
                    ->addNumberColumn($ax3->nombre);
                $lista = ValHip::where('id_hiperbolica', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValHip::where('id_hiperbolica', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $aux2 = ValHip::where('id_hiperbolica', '=', $g2)->where('t', '>', $c-1)->get()->first();
                    $aux3 = ValHip::where('id_hiperbolica', '=', $g3)->where('t', '>', $c-1)->get()->first();
                    $val1 = $aux->q;
                    if ($aux2 != '') {
                        $val2 = $aux2->q;
                    } else {
                        $val2 = 0;
                    }
                    if ($aux3 != '') {
                        $val3 = $aux3->q;
                    } else {
                        $val3 = 0;
                    }
                    $grafico->addRow([$c, $val1, $val2, $val3]);
                    $c = $c + 1;
                }
                break;
            case 4:
                $ax=Hiperbolica::find($g1);
                $ax2=Hiperbolica::find($g2);
                $ax3=Hiperbolica::find($g3);
                $ax4=Hiperbolica::find($g4);
                $grafico->addNumberColumn($ax->nombre)
                    ->addNumberColumn($ax2->nombre)
                    ->addNumberColumn($ax3->nombre)
                    ->addNumberColumn($ax4->nombre);
                $lista = ValHip::where('id_hiperbolica', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValHip::where('id_hiperbolica', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $aux2 = ValHip::where('id_hiperbolica', '=', $g2)->where('t', '>', $c-1)->get()->first();
                    $aux3 = ValHip::where('id_hiperbolica', '=', $g3)->where('t', '>', $c-1)->get()->first();
                    $aux4 = ValHip::where('id_hiperbolica', '=', $g4)->where('t', '>', $c-1)->get()->first();
                    $val1 = $aux->q;
                    if ($aux2 != '') {
                        $val2 = $aux2->q;
                    } else {
                        $val2 = 0;
                    }
                    if ($aux3 != '') {
                        $val3 = $aux3->q;
                    } else {
                        $val3 = 0;
                    }if ($aux4 != '') {
                        $val4 = $aux4->q;
                    } else {
                        $val4 = 0;
                    }
                    $grafico->addRow([$c, $val1, $val2, $val3, $val4]);
                    $c = $c + 1;
                }
                break;
        }

        $lava->LineChart('g1', $grafico, [
            'title' => 'Curvas de Declinación'
        ]);
        $graf = $lava;
        switch ($contador) {
            case 1:
                $n1=Hiperbolica::find($g1)->nombre;
                $lista1 = ValHip::where('id_hiperbolica', '=', $g1)->get();
                return view('hiperbolica.grafico', compact('contador', 'graf', 'lista1','n1'));
                break;
            case 2:
                $n1=Hiperbolica::find($g1)->nombre;
                $n2=Hiperbolica::find($g2)->nombre;
                $lista1 = ValHip::where('id_hiperbolica', '=', $g1)->get();
                $lista2 = ValHip::where('id_hiperbolica', '=', $g2)->get();
                return view('hiperbolica.grafico', compact('contador', 'graf', 'lista1', 'lista2',
                    'n1',
                    'n2'
                ));
                break;
            case 3:
                $n1=Hiperbolica::find($g1)->nombre;
                $n2=Hiperbolica::find($g2)->nombre;
                $n3=Hiperbolica::find($g3)->nombre;
                $lista1 = ValHip::where('id_hiperbolica', '=', $g1)->get();
                $lista2 = ValHip::where('id_hiperbolica', '=', $g2)->get();
                $lista3 = ValHip::where('id_hiperbolica', '=', $g3)->get();
                return view('hiperbolica.grafico', compact('contador', 'graf', 'lista1', 'lista2', 'lista3',
                    'n1',
                    'n2',
                    'n3'
                ));
                break;
            case 4:
                $n1=Hiperbolica::find($g1)->nombre;
                $n2=Hiperbolica::find($g2)->nombre;
                $n3=Hiperbolica::find($g3)->nombre;
                $n4=Hiperbolica::find($g4)->nombre;
                $lista1 = ValHip::where('id_hiperbolica', '=', $g1)->get();
                $lista2 = ValHip::where('id_hiperbolica', '=', $g2)->get();
                $lista3 = ValHip::where('id_hiperbolica', '=', $g3)->get();
                $lista4 = ValHip::where('id_hiperbolica', '=', $g4)->get();
                return view('hiperbolica.grafico', compact('contador', 'graf', 'lista1', 'lista2', 'lista3', 'lista4',
                    'n1',
                    'n2',
                    'n3',
                    'n4'
                ));
                break;
        }
        if($contador>4){
            Session::flash('message-noexist', 'Maximo 4 valores para Graficar....');
        }else{

            Session::flash('message-noexist', 'Minimo Seleccione 1 valores para Graficar....');
        }

        $lista = Hiperbolica::all();
        return view('hiperbolica.lista', compact('lista'));

    }

    public function lista()
    {
        $lista = Hiperbolica::all();
        return view('hiperbolica.lista', compact('lista'));
    }
}
