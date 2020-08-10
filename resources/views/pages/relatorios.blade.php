@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:25px;">
    <div class="row" style="justify-content: center;">
        <h6>Relatórios</h6>
    </div>
	<div class="abaixode100">
		<p>Produtos abaixo de 100 unidades</p>
		<br>
		
		@if(!empty($estoquebaixo[0]))
			@include('includes.estoque-baixo')
		@else
			<div class="estoquecheio">Estoque está cheio</div>
		@endif
	</div>
	<div class="relatoriodetalhado">
		<p>Movimentação Detalhada de Produtos</p>
		<br>
		@include('includes.relatorio-detalhado')
	</div>

</div>
@endsection
