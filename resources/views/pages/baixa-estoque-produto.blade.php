@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:25px;">
    <div class="row" style="justify-content: center;">
        <h6>Baixa de Estoque</h6>
    </div>
	<div class="content-baixa-produto">
		<div class="">
			<h5>Dar baixa no produto: {{ $nomeproduto }}</h5>
			
			@foreach ($estoque as $e)
			<form method="POST" action="{{ route('salvar-retirada') }}" enctype="multipart/form-data">
				@csrf
				<span>Quantidade atual: {{ $e->quantidade }}</span>
				<div class="row">
					<div class="form-group">
						<input type="hidden" name="id_estoque" value="{{ $e->id }}" />
						<label for="quantidade">{{ __('Quantidade de Retirada') }} <span>*</span></label>
						<input id="quantidade" type="number" class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}" name="quantidade" value="{{ old('quantidade') }}" required maxlength="17" min="1">

						@if ($errors->has('quantidade'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('quantidade') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
			@endforeach

				<button type="submit" class="btn btn-primary">
					{{ __('Salvar') }} 
				</button>

			</form>	
		</div>
	</div>
</div>
@endsection
