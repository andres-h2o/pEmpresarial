<?php

namespace Practica\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Khill\Lavacharts\Lavacharts;
use Practica\Declinacion;
use Practica\Http\Requests;
use Practica\Http\Controllers\Controller;

use Practica\Exponecial;
use Illuminate\Http\Request;
use Practica\ValExop;

class ExponecialController extends Controller
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
            $exponecial = Exponecial::where('nombre', 'LIKE', "%$keyword%")
                ->orWhere('qi', 'LIKE', "%$keyword%")
                ->orWhere('q', 'LIKE', "%$keyword%")
                ->orWhere('d', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $exponecial = Exponecial::latest()->paginate($perPage);
        }

        return view('exponecial.index', compact('exponecial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('exponecial.create');
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

        Exponecial::create($requestData);

        return redirect('exponecial')->with('flash_message', 'Exponecial added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $exponecial = Exponecial::findOrFail($id);

        return view('exponecial.show', compact('exponecial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $exponecial = Exponecial::findOrFail($id);

        return view('exponecial.edit', compact('exponecial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $exponecial = Exponecial::findOrFail($id);
        $exponecial->update($requestData);

        return redirect('exponecial')->with('flash_message', 'Exponecial updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Exponecial::destroy($id);

        return redirect('exponecial')->with('flash_message', 'Exponecial deleted!');
    }

    public function cargar($id_pozo)
    {
        return view('exponencial.cargar', compact('id_pozo'));
    }

    public function nuevo(Request $request,$id_pozo)
    {
        Exponecial::create([
            "nombre" => $request['nombre'],
            "qi" => $request['qi'],
            "q" => $request['q'],
            "d" => $request['d'],
            "id_pozo" => $id_pozo,
        ]);
        $id_exponencial = Exponecial::select('id')->orderBy('id', 'desc')->get()->first()->id;
        $qi = $request['qi'];
        $q = $request['q'];
        $d = $request['d'];

        $Df1 = ((($qi - $q) / $d) * 365); /*formula declinacion exponencial nominal anual  */


        $t = (-log($q / $qi)) / $Df1;/* tiempo vida productiva harmonica */

        ValExop::create([
            "t" => 0,
            "q" => $qi,
            "id_exponencial" => $id_exponencial,
        ]);
        for ($i = 1; $i <= $t; $i = $i + 1) {
            $qaux1 = $qi * exp(-$Df1 * $i); /* formula exponecial*/

            ValExop::create([
                "t" => $i,
                "q" => $qaux1,
                "id_exponencial" => $id_exponencial,
            ]);
        }
        ValExop::create([
            "t" => $t,
            "q" => $q,
            "id_exponencial" => $id_exponencial,
        ]);

        $lista = Exponecial::all();

       return $this->lista($id_pozo);
        //return view('exponencial.lista', compact('lista'));
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
        $exp = Exponecial::all();
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
                $ax=Exponecial::find($g1);
                $grafico
                    ->addNumberColumn($ax->nombre);
                $lista = ValExop::where('id_exponencial', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValExop::where('id_exponencial', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $grafico->addRow([$c, $aux->q]);
                    $c = $c + 1;
                }
                break;
            case 2:
                $ax=Exponecial::find($g1);
                $ax2=Exponecial::find($g2);
                $grafico->addNumberColumn($ax->nombre)
                    ->addNumberColumn($ax2->nombre);
                $lista = ValExop::where('id_exponencial', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValExop::where('id_exponencial', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $aux2 = ValExop::where('id_exponencial', '=', $g2)->where('t', '>', $c-1)->get()->first();
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
                $ax=Exponecial::find($g1);
                $ax2=Exponecial::find($g2);
                $ax3=Exponecial::find($g3);
                $grafico->addNumberColumn($ax->nombre)
                    ->addNumberColumn($ax2->nombre)
                    ->addNumberColumn($ax3->nombre);
                $lista = ValExop::where('id_exponencial', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValExop::where('id_exponencial', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $aux2 = ValExop::where('id_exponencial', '=', $g2)->where('t', '>', $c-1)->get()->first();
                    $aux3 = ValExop::where('id_exponencial', '=', $g3)->where('t', '>', $c-1)->get()->first();
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
            $ax=Exponecial::find($g1);
            $ax2=Exponecial::find($g2);
            $ax3=Exponecial::find($g3);
            $ax4=Exponecial::find($g4);
            $grafico->addNumberColumn($ax->nombre)
                ->addNumberColumn($ax2->nombre)
                ->addNumberColumn($ax3->nombre)
                ->addNumberColumn($ax4->nombre);
                $lista = ValExop::where('id_exponencial', '=', $g1)->get();
                $c = 0;
                foreach ($lista as $item) {
                    $aux = ValExop::where('id_exponencial', '=', $g1)->where('t', '>', $c-1)->get()->first();
                    $aux2 = ValExop::where('id_exponencial', '=', $g2)->where('t', '>', $c-1)->get()->first();
                    $aux3 = ValExop::where('id_exponencial', '=', $g3)->where('t', '>', $c-1)->get()->first();
                    $aux4 = ValExop::where('id_exponencial', '=', $g4)->where('t', '>', $c-1)->get()->first();
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
                $n1=Exponecial::find($g1)->nombre;
                $lista1 = ValExop::where('id_exponencial', '=', $g1)->get();
                return view('exponencial.grafico', compact('contador', 'graf', 'lista1','n1'));
                break;
            case 2:
                $n1=Exponecial::find($g1)->nombre;
                $n2=Exponecial::find($g2)->nombre;
                $lista1 = ValExop::where('id_exponencial', '=', $g1)->get();
                $lista2 = ValExop::where('id_exponencial', '=', $g2)->get();
                return view('exponencial.grafico', compact('contador', 'graf', 'lista1', 'lista2',
                    'n1',
                    'n2'
                    ));
                break;
            case 3:
                $n1=Exponecial::find($g1)->nombre;
                $n2=Exponecial::find($g2)->nombre;
                $n3=Exponecial::find($g3)->nombre;
                $lista1 = ValExop::where('id_exponencial', '=', $g1)->get();
                $lista2 = ValExop::where('id_exponencial', '=', $g2)->get();
                $lista3 = ValExop::where('id_exponencial', '=', $g3)->get();
                return view('exponencial.grafico', compact('contador', 'graf', 'lista1', 'lista2', 'lista3',
                    'n1',
                    'n2',
                    'n3'
                    ));
                break;
            case 4:
                $n1=Exponecial::find($g1)->nombre;
                $n2=Exponecial::find($g2)->nombre;
                $n3=Exponecial::find($g3)->nombre;
                $n4=Exponecial::find($g4)->nombre;
                $lista1 = ValExop::where('id_exponencial', '=', $g1)->get();
                $lista2 = ValExop::where('id_exponencial', '=', $g2)->get();
                $lista3 = ValExop::where('id_exponencial', '=', $g3)->get();
                $lista4 = ValExop::where('id_exponencial', '=', $g4)->get();
                return view('exponencial.grafico', compact('contador', 'graf', 'lista1', 'lista2', 'lista3', 'lista4',
                    'n1',
                    'n2',
                    'n3',
                    'n4'
                ));
                break;
        }
        Session::flash('message-noexist', 'Maximo 4 valores para Graficar....');
        $lista = Exponecial::all();
        return view('exponencial.lista', compact('lista'));

    }

    public function lista($id_pozo)
    {
        $lista = Exponecial::where('id_pozo','=',$id_pozo)->get();
        return view('exponencial.lista', compact('lista','id_pozo'));
    }
}
