<table class="table table-striped" id="tabelaProdutos">
  <thead>
    <tr>
      <th scope="col">Produto</th>
      <th scope="col">SKU</th>
      <th scope="col">Preço</th>
      <th scope="col">quantidade</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($estoque as $produto)
      <tr>
        <td>{{ $produto->produto }}</td>
        <td>{{ $produto->sku }}</td>
        <td>R${{ number_format($produto->preco, 2,',','.') }}</td>
        <td>{{ $produto->quantidade }}</td>
        <td>
          <a class="editar_produto" href="/baixa-estoque/produto/{{ $produto->id_produto }}">
            <span>Retirada</span>
          </a>
        </td>
      </tr>
      
      
    @endforeach
  </tbody>
</table>






