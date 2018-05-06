<?php

namespace Practica\Http\Controllers;

use Practica\Http\Requests;
use Practica\Http\Controllers\Controller;

use Practica\ValHip;
use Illuminate\Http\Request;

class ValHipController extends Controller
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
            $valhip = ValHip::where('t', 'LIKE', "%$keyword%")
                ->orWhere('q', 'LIKE', "%$keyword%")
                ->orWhere('id_hiperbolica', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $valhip = ValHip::latest()->paginate($perPage);
        }

        return view('val-hip.index', compact('valhip'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('val-hip.create');
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
        
        ValHip::create($requestData);

        return redirect('val-hip')->with('flash_message', 'ValHip added!');
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
        $valhip = ValHip::findOrFail($id);

        return view('val-hip.show', compact('valhip'));
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
        $valhip = ValHip::findOrFail($id);

        return view('val-hip.edit', compact('valhip'));
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
        
        $valhip = ValHip::findOrFail($id);
        $valhip->update($requestData);

        return redirect('val-hip')->with('flash_message', 'ValHip updated!');
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
        ValHip::destroy($id);

        return redirect('val-hip')->with('flash_message', 'ValHip deleted!');
    }
}
