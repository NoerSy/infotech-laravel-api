<?php

namespace App\Http\Controllers;

use App\Models\Consoles;
use Illuminate\Http\Request;

class ConsolesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $console = Consoles::all();
        if($console == null){
            return 'retun is null';
        }
        return view('console.index', compact('console'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('console.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|max:50',
            'merek' => 'required|max:200',
            'image' => 'required|max:200',
            'isSewa' => 'required|max:200',
            'description' => 'required|max:200'
        ]);
        Consoles::create($request->all());
        return redirect()->route('console.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $console = Consoles::findOrFail($id);
        return view('console.edit', compact('console'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'isSewa' => 'required|max:6|numeric'
        ]);

        Consoles::findOrFail($id)->update([
            'isSewa' => $request->isSewa,
            'type' => $request -> type,
            'merek' => $request->merek,
            'image' => $request->image,
            'description' => $request->description
        ]);
        return redirect()->route('console.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Consoles::findOrFail($id)->delete();
        return redirect()->back();
    }
}
