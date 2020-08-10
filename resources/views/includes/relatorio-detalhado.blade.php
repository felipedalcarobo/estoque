<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Produto</th>
      <th scope="col">sku</th>
      <th scope="col">Tipo de Movimentação</th>
      <th scope="col">Quantidade Movimentada</th>
      <th scope="col">Canal</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($movimentacao as $relatorio)
      <tr>
        <td>{{ $relatorio->produto }}</td>
        <td>{{ $relatorio->sku }}</td>
        <td>
          @if($relatorio->tipo_movimentacao == "E")
            <span>Entrada</span>
          @else
            <span>Saída</span>
          @endif  
        </td>
        <td>{{ $relatorio->quantidade_movimentacao }}</td>
        <td>{{ $relatorio->canal }}</td>
        <td>{{ $relatorio->created_at }}</td>
      </tr>      
    @endforeach
  </tbody>
</table>