<table class="table table-striped" id="tabelaProdutos">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Produto</th>
      <th scope="col">SKU</th>
      <th scope="col">Preço</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($produtos as $produto)
      <tr>
        <td>{{ $produto->id }}</td>
        <td>{{ $produto->produto }}</td>
        <td>{{ $produto->sku }}</td>
        <td>R${{ number_format($produto->preco, 2,',','.') }}</td>
        <td>
          <a class="editar_produto" data-toggle="modal" data-target="#modalEditarProduto{{ $produto->id }}">
            <span>Editar</span>
          </a>
          @include('includes.editar-produto')
          <a class="deletar_produto" data-toggle="modal" data-target="#modalEcluirProduto{{ $produto->id }}">
            <span>Excluir</span>
          </a>
          @include('includes.excluir-produto')
        </td>
      </tr>
      
      
    @endforeach
  </tbody>
</table>






