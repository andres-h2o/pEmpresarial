<?php

namespace Practica\Http\Controllers;

use Practica\Http\Requests;
use Practica\Http\Controllers\Controller;

use Practica\Declinacion;
use Illuminate\Http\Request;

class DeclinacionController extends Controller
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
            $declinacion = Declinacion::where('fecha', 'LIKE', "%$keyword%")
                ->orWhere('v1', 'LIKE', "%$keyword%")
                ->orWhere('v2', 'LIKE', "%$keyword%")
                ->orWhere('v3', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $declinacion = Declinacion::latest()->paginate($perPage);
        }

        return view('declinacion.index', compact('declinacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('declinacion.create');
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
        
        Declinacion::create($requestData);

        return redirect('declinacion')->with('flash_message', 'Declinacion added!');
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
        $declinacion = Declinacion::findOrFail($id);

        return view('declinacion.show', compact('declinacion'));
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
        $declinacion = Declinacion::findOrFail($id);

        return view('declinacion.edit', compact('declinacion'));
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
        
        $declinacion = Declinacion::findOrFail($id);
        $declinacion->update($requestData);

        return redirect('declinacion')->with('flash_message', 'Declinacion updated!');
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
        Declinacion::destroy($id);

        return redirect('declinacion')->with('flash_message', 'Declinacion deleted!');
    }
}
