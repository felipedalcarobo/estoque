@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:25px;">
    <div class="row" style="justify-content: center;">
        <h6>Estoque</h6>
    </div>
    <div>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNovoProduto">Adicionar</button>
	</div>
	<div class="content-cadastro-cadastrar" >
		@include('includes.lista-produtos')
	</div>
    <div>
    	
    </div>
    <div class="modal fade" id="modalNovoProduto" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Cadastrar Novo Produto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>				
				@include('includes.cadastrar-produto')
			</div>
		</div>
	</div>
</div>
@endsection




