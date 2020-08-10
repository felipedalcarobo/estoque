<div class="modal fade" id="modalEditarProduto{{ $produto->id }}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Editar Produto - {{ $produto->produto }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>	
			<div class="modal-body">
				<div class="row"> 
					<div class="col-md-12 ml-auto mr-auto">
						<form method="POST" action="{{ route('editar-produto') }}" enctype="multipart/form-data" >
							@csrf
							<div class="form-row">
								<input type="hidden" name="id" value="{{ $produto->id }}" />
								<div class="form-group col-md-6">
									<label for="produto">{{ __('Produto') }} <span>*</span></label>
									<input id="produto" type="text" class="form-control{{ $errors->has('produto') ? ' is-invalid' : '' }}" name="produto" value="{{ $produto->produto }}" maxlength="25" required>

									@if ($errors->has('produto'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('produto') }}</strong>
									</span>
									@endif
								</div>
								
								<div class="form-group col-md-6">
									<label for="preco">{{ __('Preço R$') }} <span id="campo-obrigatorio">*</span></label>
									<input id="preco" type="text" class="form-control{{ $errors->has('preco') ? ' is-invalid' : '' }}" name="preco" value="R$ {{ number_format($produto->preco, 2,',','.') }}" required maxlength="17">

									@if ($errors->has('preco'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('preco') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button type="submit" class="btn btn-primary" >
									{{ __('Salvar') }} 
								</button>
							</div>
						</form>					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>










