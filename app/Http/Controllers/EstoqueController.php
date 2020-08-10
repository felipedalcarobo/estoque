<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelEstoque;
use App\Models\ModelProdutos;
use App\Models\ModelRelatorios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function baixaEstoque() {
        $id_usuario = auth()->user()->id;

        $estoque = DB::table('estoque')
            ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
            ->where('produtos.user', '=', $id_usuario)
            ->get();

        $produtos = DB::table('produtos')
            ->where('produtos.user', '=', $id_usuario)->get();


        return view('pages/baixa-estoque', compact('estoque', 'produtos'));
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
                'id_produto'  => request('produto'),
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
                $estoque = ModelEstoque::create($data);
            }

            // criar registro na tabela relatorios
            $datarelatorio = [
                'quantidade_movimentacao' => request('quantidade'),
                'id_produto'              => request('produto'),
                'tipo_movimentacao'       => 'E',
                'canal'                   => 'sistema'
            ];

            $relarorio = ModelRelatorios::create($datarelatorio);

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

        $estoque = DB::table('estoque')
            ->where('id_produto', '=', $id)->get();

        $nomeproduto = ModelProdutos::find($id);
        $nomeproduto = $nomeproduto->produto;

        return view('pages/baixa-estoque-produto', compact('estoque', 'nomeproduto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_estoque' => 'required|max:25',
            'quantidade'   => 'required|numeric|min:1',
        ]);

        $estoque = ModelEstoque::find($request->id_estoque);

        $this->total = $estoque->quantidade - $request->quantidade;

        $validator->after(function ($validator) {

            if ($this->total < 0 ) {

                $validator->errors()->add('quantidade', 'Quantidade maior que estoque.');
            }
        });

        if ($validator->fails()) {
            return redirect('baixa-estoque/produto/'. $estoque->id_produto)
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try {
            $estoque->quantidade = $this->total;
            $estoque->save();

            // criar registro na tabela relatorios
            $datarelatorio = [
                'quantidade_movimentacao' => request('quantidade'),
                'id_produto'              => $estoque->id_produto,
                'tipo_movimentacao'       => 'S',
                'canal'                   => 'sistema'
            ];

            $relarorio = ModelRelatorios::create($datarelatorio);

            DB::commit();
            return redirect()->route('baixa-estoque');
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e);
        }
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
