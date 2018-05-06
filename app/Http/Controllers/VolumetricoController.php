<?php

namespace Practica\Http\Controllers;

use Khill\Lavacharts\Lavacharts;
use Practica\Http\Requests;
use Practica\Http\Controllers\Controller;

use Practica\Volumetrico;
use Illuminate\Http\Request;

class VolumetricoController extends Controller
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
            $volumetrico = Volumetrico::where('nombre', 'LIKE', "%$keyword%")
                ->orWhere('a', 'LIKE', "%$keyword%")
                ->orWhere('b', 'LIKE', "%$keyword%")
                ->orWhere('h', 'LIKE', "%$keyword%")
                ->orWhere('o', 'LIKE', "%$keyword%")
                ->orWhere('swc', 'LIKE', "%$keyword%")
                ->orWhere('gop', 'LIKE', "%$keyword%")
                ->orWhere('g', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $volumetrico = Volumetrico::latest()->paginate($perPage);
        }

        return view('volumetrico.index', compact('volumetrico'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('volumetrico.create');
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

        Volumetrico::create($requestData);

        return redirect('volumetrico')->with('flash_message', 'Volumetrico added!');
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
        $volumetrico = Volumetrico::findOrFail($id);

        return view('volumetrico.show', compact('volumetrico'));
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
        $volumetrico = Volumetrico::findOrFail($id);

        return view('volumetrico.edit', compact('volumetrico'));
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

        $volumetrico = Volumetrico::findOrFail($id);
        $volumetrico->update($requestData);

        return redirect('volumetrico')->with('flash_message', 'Volumetrico updated!');
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
        Volumetrico::destroy($id);

        return redirect('volumetrico')->with('flash_message', 'Volumetrico deleted!');
    }

    public function ver()
    {
        $lava = new Lavacharts; // See note below for Laravel

        $grafico = $lava->DataTable();

        $grafico->addStringColumn('Tiempo')
            ->addNumberColumn('Volumen');

        $volumetrico = Volumetrico::all();
        foreach ($volumetrico as $item) {
            $grafico->addRow([$item->nombre, $item->g]);
        }
        $lava->LineChart('g1', $grafico, [
            'title' => 'Curvas de Declinación'
        ]);
        $graf = $lava;
        $tabla = Volumetrico::all();
        return view('volumetrico.cargar', compact("graf", "tabla", "request"));
    }

    public function nueva(Request $request)
    {
        $a = $request['a'];
        $h = $request['h'];
        $o = $request['o'];
        $swc = $request['swc'];
        $b = $request['b'];
        $gop = $request['gop'];

        if ($gop == 0) {

            $g = (7758 * $a * $h * $o*(1 - $swc)) / $b;
        } else {

            $g = (43.560 * $a * $h * $o*(1 - $swc)) / $b;
        }
        Volumetrico::create([
            "a"=>$a,
            "h"=>$h,
            "o"=>$o,
            "swc"=>$swc,
            "b"=>$b,
            "gop"=>$gop,
            "g"=>$g,
        ]);

        $lava = new Lavacharts; // See note below for Laravel

        $grafico = $lava->DataTable();

        $grafico->addStringColumn('Tiempo')
            ->addNumberColumn('Volumen');

        $volumetrico = Volumetrico::all();
        foreach ($volumetrico as $item) {
            $grafico->addRow([$item->nombre, $item->g]);
        }
        $lava->LineChart('g1', $grafico, [
            'title' => 'Volumetrico'
        ]);
        $graf = $lava;
        $tabla = Volumetrico::all();
        return view('volumetrico.cargar', compact("graf", "tabla", "request"));
    }
}
