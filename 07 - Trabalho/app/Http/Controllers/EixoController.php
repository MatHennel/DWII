<?php

namespace App\Http\Controllers;

use App\Models\AreaEixo;
use Illuminate\Http\Request;

class EixoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AreaEixo::all();
        return view('eixos.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eixos.create');
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
            'nome' => 'required',
            'descricao' => 'required'
        ]);

        AreaEixo::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'descricao' => $request->descricao
        ]);

        return redirect()->route('eixos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dados = AreaEixo::find($id);
        return view('eixos.show', compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = AreaEixo::find($id);
           
        return view('eixos.edit', compact('data'));  
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
            'nome' => 'required',
            'descricao' => 'required'
        ]);

        $reg = AreaEixo::find($id);
        $reg->fill([
            "nome" => mb_strtoupper($request->nome, 'UTF-8'),
            'descricao' => $request->descricao
        ]);
        $reg->save();

        return redirect()->route('eixos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AreaEixo::destroy($id);
        return redirect()->route('eixos.index');
    }
}
