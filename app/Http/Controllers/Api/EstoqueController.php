<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ModelEstoque;
use App\Models\ModelRelatorios;
use Illuminate\Support\Facades\Validator;

class EstoqueController extends Controller 
{
	public $successStatus = 200;
  
  
   
	public function login(){ 
		if (Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
			$user = Auth::user(); 
			$success['token'] =  $user->createToken('felipe')->accessToken; 
			return response()->json(['success' => $success], $this->successStatus); 
		} 
	  	else { 
			return response()->json(['error'=>'Não autorizado'], 401); 
		} 
	}

	public function store(Request $request) {

        $validator = Validator::make(
            $request->all(),
            [
                'produto' 	  => 'required|max:25',
            	'quantidade'  => 'required|numeric|min:1',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        } else {
            DB::beginTransaction();
            try {
                $user = Auth::user();
                $input = $request->all();

                $data = [
	                'id_produto'  => $input['produto'],
	                'quantidade'  => $input['quantidade'],
	            ];
	            $modelEstoque = ModelEstoque::where('id_produto', $input['produto'])->first();

	            if (!empty($modelEstoque->id)) 
	            {
	                $quantidade = $modelEstoque->quantidade + $input['quantidade'];
	                $modelEstoque->quantidade  = $quantidade;
	                $modelEstoque->save();
	            } 
	            else 
	            {
	                $estoque = ModelEstoque::create($data);
	            }

	            // criar registro na tabela relatorios
	            $datarelatorio = [
	                'quantidade_movimentacao' => $input['quantidade'],
	                'id_produto'              => $input['produto'],
	                'tipo_movimentacao'       => 'E',
	                'canal'                   => 'api'
	            ];

	            $relarorio = ModelRelatorios::create($datarelatorio);

                DB::commit();

                return response()->json(['success' => 'Produto adicionado com sucesso.'], $this->successStatus);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => $e], 401);
            }

        }

    }

  
	public function update(Request $request) {

        $validator = Validator::make(
            $request->all(),
            [
                'id_estoque'  => 'required|max:25',
            	'quantidade'  => 'required|numeric|min:1',
            ]
        );

        $input = $request->all();
        $estoque = ModelEstoque::find($input['id_estoque']);

        if($estoque) {
        	$this->total = $estoque->quantidade - $input['quantidade'];

        	$validator->after(function ($validator) 
        	{
	            if ($this->total < 0 ) 
	            {
	                $validator->errors()->add('quantidade', 'Quantidade para é baixa maior que disponivel.');
	            }
	        });
        } else {
        	$validator->after(function ($validator) 
        	{
                $validator->errors()->add('id_estoque', 'id_estoque invalido');
	        });
        }

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        } else {
            DB::beginTransaction();
            try {
                $user = Auth::user();

	            $estoque->quantidade = $this->total;
	            $estoque->save();

	            // criar registro na tabela relatorios
	            $datarelatorio = [
	                'quantidade_movimentacao' => $input['quantidade'],
	                'id_produto'              => $estoque->id_produto,
	                'tipo_movimentacao'       => 'S',
	                'canal'                   => 'api'
	            ];

	            $relarorio = ModelRelatorios::create($datarelatorio);

                DB::commit();

                return response()->json(['success' => 'Baixa feita com sucesso.'], $this->successStatus);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => $e], 401);
            }

        }

    }


} 




