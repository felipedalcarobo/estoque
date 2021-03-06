<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelProdutos;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = auth()->user()->id;

        $produtos = DB::table('produtos')
            ->where('produtos.user', '=', $id_usuario)->get();


        return view('pages/produtos', compact('produtos'));
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
            'preco'   => 'required|max:17',
        ]);

        DB::beginTransaction();
        try {

            $data = [
                'produto'=> request('produto'),
                'preco'  => request('preco'),
                'sku'    => uniqid(date('HisYmd')).auth()->user()->id,
                'user'   => auth()->user()->id,
            ];

            $produto = ModelProdutos::create($data);

            DB::commit();
            return redirect()->route('produtos');
        } catch (\Exception $e) {
            DB::rollback();
            // return redirect()->route('falhou');
            print_r($e);
        }
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
        $validatedData = $request->validate([ 
            'produto' => 'required|max:25',
            'preco'   => 'required|max:20',
        ]);

        DB::beginTransaction();
        try {
            $produto = ModelProdutos::findOrFail($request->id);

            $price1 = str_replace(".","", request('preco'));
            $price2 = str_replace(",",".", $price1);
            $price = str_replace("R$ ","", $price2);

            $produto->produto     = $request->produto;
            $produto->preco       = $price;
            $produto->save();

            DB::commit();
            return redirect()->route('produtos');
        } catch (\Exception $e) {
            DB::rollback();
            // return redirect()->route('falhou');
            print_r($e);
        }
    }

    public function delete(Request $request)
    {
        $id = request('id');
        $foto = ModelProdutos::find($id);
        $foto->delete();

        return redirect()->route('produtos');
    }

}
