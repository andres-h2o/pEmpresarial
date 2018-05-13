<?php

namespace Practica\Http\Controllers;

use Practica\Http\Requests;
use Practica\Http\Controllers\Controller;

use Practica\Pozo;
use Illuminate\Http\Request;

class PozoController extends Controller
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
            $pozo = Pozo::where('Pozo', 'LIKE', "%$keyword%")
                ->orWhere('x', 'LIKE', "%$keyword%")
                ->orWhere('y', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pozo = Pozo::latest()->paginate($perPage);
        }

        return view('pozo.index', compact('pozo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pozo.create');
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
        
        Pozo::create($requestData);

        return redirect('pozo')->with('flash_message', 'Pozo added!');
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
        $pozo = Pozo::findOrFail($id);

        return view('pozo.show', compact('pozo'));
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
        $pozo = Pozo::findOrFail($id);

        return view('pozo.edit', compact('pozo'));
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
        
        $pozo = Pozo::findOrFail($id);
        $pozo->update($requestData);

        return redirect('pozo')->with('flash_message', 'Pozo updated!');
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
        Pozo::destroy($id);

        return redirect('pozo')->with('flash_message', 'Pozo deleted!');
    }
}
