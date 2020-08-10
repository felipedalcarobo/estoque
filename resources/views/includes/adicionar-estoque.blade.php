<div class="modal-body">
	<div class="row"> 
		<div class="col-md-12 ml-auto mr-auto">
			<form method="POST" action="{{ route('salvar-estoque') }}" enctype="multipart/form-data">
				@csrf
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="produto">{{ __('Produto') }} <span>*</span></label>
						<select class="form-control{{ $errors->has('produto') ? ' is-invalid' : '' }}" id="produto" name="produto" required >
							<option value="">Escolha o Produto</option>
								
							@foreach($produtos as $produto)
								<option value="{{ $produto->id }}">{{ $produto->produto }}</option>
							@endforeach

						</select>
						@if ($errors->has('produto'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('produto') }}</strong>
						</span>
						@endif
					</div>
					
					<div class="form-group col-md-6">
						<label for="quantidade">{{ __('Quantidade') }} <span>*</span></label>
						<input id="quantidade" type="number" class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}" name="quantidade" value="{{ old('quantidade') }}" required min="1">

						@if ($errors->has('quantidade'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('quantidade') }}</strong>
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
	













