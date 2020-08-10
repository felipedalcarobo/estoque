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
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([ 
                'produto' => 'required|unique:produtos|max:25',
                'preco'   => 'required|max:17',
            ]);

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
            return redirect()->route('falhou');
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
