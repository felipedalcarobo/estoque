@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:25px;">
    <div class="row" style="justify-content: center;">
        <h6>Baixa de Estoque</h6>
    </div>
	<div class="content-cadastro-cadastrar" >
		@include('includes.lista-estoque-retirada')
	</div>
</div>
@endsection
