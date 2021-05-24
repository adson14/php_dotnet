<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pessoa::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       Pessoa::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $pessoaId
     * @return \Illuminate\Http\Response
     */
    public function show($pessoaId)
    {
        return Pessoa::findOrFail($pessoaId);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pessoaId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pessoaId)
    {
        $pessoa = Pessoa::findOrFail($pessoaId);
        $pessoa->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pessoaId
     * @return \Illuminate\Http\Response
     */
    public function destroy($pessoaId)
    {
        $pessoa = Pessoa::findOrFail($pessoaId);
        $pessoa->delete();
    }
}
