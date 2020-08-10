<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Produto</th>
      <th scope="col">SKU</th>
      <th scope="col">Preço</th>
      <th scope="col">Quantidade</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($estoque as $produto)
      <tr>
        <td>{{ $produto->produto }}</td>
        <td>{{ $produto->sku }}</td>
        <td>R${{ number_format($produto->preco, 2,',','.') }}</td>
        <td>{{ $produto->quantidade }}</td>
      </tr>      
    @endforeach
  </tbody>
</table>
