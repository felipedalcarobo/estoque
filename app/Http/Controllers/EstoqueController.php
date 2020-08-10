<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelEstoque;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = auth()->user()->id;

        $estoque = DB::table('estoque')
            ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
            ->where('produtos.user', '=', $id_usuario)->get();

        $produtos = DB::table('produtos')
            ->where('produtos.user', '=', $id_usuario)->get();


        return view('pages/informacoes-estoque', compact('estoque', 'produtos'));
    }

    public function baixaEstoque() {
        return view('pages/baixa-estoque');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([ 
            'produto' => 'required|max:25',
            'quantidade'   => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();
        try {

            $data = [
                'id_produto'=> request('produto'),
                'quantidade'  => request('quantidade'),
            ];

            $modelEstoque = ModelEstoque::where('id_produto', request('produto'))->first();

            if (!empty($modelEstoque->id)) 
            {
                $quantidade = $modelEstoque->quantidade + request('quantidade');
                $modelEstoque->quantidade  = $quantidade;
                $modelEstoque->save();
            } 
            else 
            {
                $produto = ModelEstoque::create($data);
            }

            DB::commit();
            return redirect()->route('estoque');
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e);
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
