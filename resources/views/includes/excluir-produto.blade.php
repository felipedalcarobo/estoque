<div class="modal fade bd-example-modal-sm" id="modalEcluirProduto{{ $produto->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 ml-auto mr-auto" style="text-align: center;">
						
						<form method="POST" action="{{ route('excluir-produto') }}" enctype="multipart/form-data">
							{{ csrf_field() }}		
							<div class="">
								<h5 class="modal-title" id="exampleModalCenterTitle" style="padding-bottom: 10px;">Excluir {{ $produto->produto }}?</h5>			
								<input type="hidden" name="id" value="{{ $produto->id }}" />

								<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
									Fechar
								</button>
								<button type="submit" class="btn btn-danger btn-sm">
									Deletar
								</button>					
							</div>
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
