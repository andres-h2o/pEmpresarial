<?php

namespace Practica\Http\Controllers;

use Practica\Http\Requests;
use Practica\Http\Controllers\Controller;

use Practica\ValArm;
use Illuminate\Http\Request;

class ValArmController extends Controller
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
            $valarm = ValArm::where('t', 'LIKE', "%$keyword%")
                ->orWhere('q', 'LIKE', "%$keyword%")
                ->orWhere('id_armonicas', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $valarm = ValArm::latest()->paginate($perPage);
        }

        return view('val-arm.index', compact('valarm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('val-arm.create');
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
        
        ValArm::create($requestData);

        return redirect('val-arm')->with('flash_message', 'ValArm added!');
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
        $valarm = ValArm::findOrFail($id);

        return view('val-arm.show', compact('valarm'));
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
        $valarm = ValArm::findOrFail($id);

        return view('val-arm.edit', compact('valarm'));
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
        
        $valarm = ValArm::findOrFail($id);
        $valarm->update($requestData);

        return redirect('val-arm')->with('flash_message', 'ValArm updated!');
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
        ValArm::destroy($id);

        return redirect('val-arm')->with('flash_message', 'ValArm deleted!');
    }
}
