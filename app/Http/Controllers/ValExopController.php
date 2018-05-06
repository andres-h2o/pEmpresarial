<?php

namespace Practica\Http\Controllers;

use Practica\Http\Requests;
use Practica\Http\Controllers\Controller;

use Practica\ValExop;
use Illuminate\Http\Request;

class ValExopController extends Controller
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
            $valexop = ValExop::where('t', 'LIKE', "%$keyword%")
                ->orWhere('q', 'LIKE', "%$keyword%")
                ->orWhere('id_exponencial', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $valexop = ValExop::latest()->paginate($perPage);
        }

        return view('val-exop.index', compact('valexop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('val-exop.create');
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
        
        ValExop::create($requestData);

        return redirect('val-exop')->with('flash_message', 'ValExop added!');
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
        $valexop = ValExop::findOrFail($id);

        return view('val-exop.show', compact('valexop'));
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
        $valexop = ValExop::findOrFail($id);

        return view('val-exop.edit', compact('valexop'));
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
        
        $valexop = ValExop::findOrFail($id);
        $valexop->update($requestData);

        return redirect('val-exop')->with('flash_message', 'ValExop updated!');
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
        ValExop::destroy($id);

        return redirect('val-exop')->with('flash_message', 'ValExop deleted!');
    }
}
