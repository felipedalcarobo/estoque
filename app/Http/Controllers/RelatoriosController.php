<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id_usuario   = auth()->user()->id;

        $movimentacao = DB::table('relatorios')
            ->join('produtos', 'produtos.id', '=', 'relatorios.id_produto')
            ->where('produtos.user', '=', $id_usuario)->get();


        $estoquebaixo = DB::table('estoque')
            ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
            ->where([['produtos.user', '=', $id_usuario],['estoque.quantidade', '<', '100']])->get();

        return view('pages/relatorios', compact('estoquebaixo', 'movimentacao'));
    }

}
