<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelEstoque;
use App\Models\ModelProdutos;

class HomeController extends Controller
{
    private $estoque;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ModelEstoque $estoque) {
        $this->middleware('auth');
        $this->estoque = $estoque;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages/dashboard');
    }
}
