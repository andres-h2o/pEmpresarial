<?php

namespace Practica\Http\Controllers;

use Khill\Lavacharts\Lavacharts;
use Practica\Declinacion;
use Practica\Http\Requests;
use Practica\Http\Controllers\Controller;

use Practica\Armonica;
use Illuminate\Http\Request;
use Practica\ValArm;

class ArmonicaController extends Controller
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
            $armonica = Armonica::where('nombre', 'LIKE', "%$keyword%")
                ->orWhere('qi', 'LIKE', "%$keyword%")
                ->orWhere('q', 'LIKE', "%$keyword%")
                ->orWhere('d', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $armonica = Armonica::latest()->paginate($perPage);
        }

        return view('armonica.index', compact('armonica'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('armonica.create');
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
        
        Armonica::create($requestData);

        return redirect('armonica')->with('flash_message', 'Armonica added!');
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
        $armonica = Armonica::findOrFail($id);

        return view('armonica.show', compact('armonica'));
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
        $armonica = Armonica::findOrFail($id);

        return view('armonica.edit', compact('armonica'));
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
        
        $armonica = Armonica::findOrFail($id);
        $armonica->update($requestData);

        return redirect('armonica')->with('flash_message', 'Armonica updated!');
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
        Armonica::destroy($id);

        return redirect('armonica')->with('flash_message', 'Armonica deleted!');
    }

    public function cargar()
    {
        $lista = Armonica::all();
        return view('armonica.cargar', compact('lista'));
    }

    public function nuevo(Request $request)
    {
        Armonica::create([
            "nombre" => $request['nombre'],
            "qi" => $request['qi'],
            "q" => $request['q'],
            "d" => $request['d'],
        ]);
        $id_armonica = Armonica::select('id')->orderBy('id', 'desc')->get()->first()->id;
        $qi = $request['qi'];
        $q = $request['q'];
        $d = $request['d'];

        $Df3 = (($qi/$d)*log($qi/$q)*365); /*formula declinacion harmonica nominal anual  */

        $t = (($qi/$q)-1)/$Df3;/* tiempo vida productiva harmonica */

        ValArm::create([
            "t" => 0,
            "q" => $qi,
            "id_armonicas" => $id_armonica,
        ]);
        for ($i = 1; $i <= $t; $i = $i + 1) {

            $qaux3 = $qi /(1+$Df3*$i); /*formula harmonica*/

            ValArm::create([
                "t" => $i,
                "q" => $qaux3,
                "id_armonicas" => $id_armonica,
            ]);
        }
        ValArm::create([
            "t" => $t,
            "q" => $q,
            "id_armonicas" => $id_armonica,
        ]);

        $lista = Armonica::all();

        return view('armonica.lista', compact('lista'));
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
        $exp = Armonica::all();
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
                $ax=Armonica::find($g1);
                $grafico
                    ->addNumberColumn($ax->nombre);
                $lista = ValArm::where('id_armonicas', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValArm::where('id_armonicas', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $grafico->addRow([$c, $aux->q]);
                    $c = $c + 1;
                }
                break;
            case 2:
                $ax=Armonica::find($g1);
                $ax2=Armonica::find($g2);
                $grafico->addNumberColumn($ax->nombre)
                    ->addNumberColumn($ax2->nombre);
                $lista = ValArm::where('id_armonicas', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValArm::where('id_armonicas', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $aux2 = ValArm::where('id_armonicas', '=', $g2)->where('t', '>', $c-1)->get()->first();
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
                $ax=Armonica::find($g1);
                $ax2=Armonica::find($g2);
                $ax3=Armonica::find($g3);
                $grafico->addNumberColumn($ax->nombre)
                    ->addNumberColumn($ax2->nombre)
                    ->addNumberColumn($ax3->nombre);
                $lista = ValArm::where('id_armonicas', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValArm::where('id_armonicas', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $aux2 = ValArm::where('id_armonicas', '=', $g2)->where('t', '>', $c-1)->get()->first();
                    $aux3 = ValArm::where('id_armonicas', '=', $g3)->where('t', '>', $c-1)->get()->first();
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
                $ax=Armonica::find($g1);
                $ax2=Armonica::find($g2);
                $ax3=Armonica::find($g3);
                $ax4=Armonica::find($g4);
                $grafico->addNumberColumn($ax->nombre)
                    ->addNumberColumn($ax2->nombre)
                    ->addNumberColumn($ax3->nombre)
                    ->addNumberColumn($ax4->nombre);
                $lista = ValArm::where('id_armonicas', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValArm::where('id_armonicas', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $aux2 = ValArm::where('id_armonicas', '=', $g2)->where('t', '>', $c-1)->get()->first();
                    $aux3 = ValArm::where('id_armonicas', '=', $g3)->where('t', '>', $c-1)->get()->first();
                    $aux4 = ValArm::where('id_armonicas', '=', $g4)->where('t', '>', $c-1)->get()->first();
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
        $tabla = Declinacion::all();
        switch ($contador) {
            case 1:
                $n1=Armonica::find($g1)->nombre;
                $lista1 = ValArm::where('id_armonicas', '=', $g1)->get();
                return view('armonica.grafico', compact('contador', 'graf', 'lista1','n1'));
                break;
            case 2:
                $n1=Armonica::find($g1)->nombre;
                $n2=Armonica::find($g2)->nombre;
                $lista1 = ValArm::where('id_armonicas', '=', $g1)->get();
                $lista2 = ValArm::where('id_armonicas', '=', $g2)->get();
                return view('armonica.grafico', compact('contador', 'graf', 'lista1', 'lista2',
                    'n1',
                    'n2'
                ));
                break;
            case 3:
                $n1=Armonica::find($g1)->nombre;
                $n2=Armonica::find($g2)->nombre;
                $n3=Armonica::find($g3)->nombre;
                $lista1 = ValArm::where('id_armonicas', '=', $g1)->get();
                $lista2 = ValArm::where('id_armonicas', '=', $g2)->get();
                $lista3 = ValArm::where('id_armonicas', '=', $g3)->get();
                return view('armonica.grafico', compact('contador', 'graf', 'lista1', 'lista2', 'lista3',
                    'n1',
                    'n2',
                    'n3'
                ));
                break;
            case 4:
                $n1=Armonica::find($g1)->nombre;
                $n2=Armonica::find($g2)->nombre;
                $n3=Armonica::find($g3)->nombre;
                $n4=Armonica::find($g4)->nombre;
                $lista1 = ValArm::where('id_armonicas', '=', $g1)->get();
                $lista2 = ValArm::where('id_armonicas', '=', $g2)->get();
                $lista3 = ValArm::where('id_armonicas', '=', $g3)->get();
                $lista4 = ValArm::where('id_armonicas', '=', $g4)->get();
                return view('armonica.grafico', compact('contador', 'graf', 'lista1', 'lista2', 'lista3', 'lista4',
                    'n1',
                    'n2',
                    'n3',
                    'n4'
                ));
                break;
        }
        Session::flash('message-noexist', 'Maximo 4 valores para Graficar....');
        $lista = Armonica::all();
        return view('armonica.lista', compact('lista'));

    }

    public function lista()
    {
        $lista = Armonica::all();
        return view('armonica.lista', compact('lista'));
    }
}
