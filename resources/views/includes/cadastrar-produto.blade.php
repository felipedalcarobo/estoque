<div class="modal-body">
	<div class="row"> 
		<div class="col-md-12 ml-auto mr-auto">
			<form method="POST" action="{{ route('salvar-produto') }}" enctype="multipart/form-data">
				@csrf
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="produto">{{ __('Produto') }} <span>*</span></label>
						<input id="produto" type="text" class="form-control{{ $errors->has('produto') ? ' is-invalid' : '' }}" name="produto" value="{{ old('produto') }}" required autofocus="autofocus" maxlength="25">

						@if ($errors->has('produto'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('produto') }}</strong>
						</span>
						@endif
					</div>
					
					<div class="form-group col-md-6">
						<label for="preco">{{ __('Preço R$') }} <span>*</span></label>
						<input id="preco" type="text" class="form-control{{ $errors->has('preco') ? ' is-invalid' : '' }}" name="preco" value="{{ old('preco') }}" required maxlength="17">

						@if ($errors->has('preco'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('preco') }}</strong>
						</span>
						@endif
					</div>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary">
						{{ __('Salvar') }} 
					</button>
				</div>
			</form>				
		</div>
	</div>
</div>
	













