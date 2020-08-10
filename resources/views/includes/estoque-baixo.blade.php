<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Produto</th>
      <th scope="col">sku</th>
      <th scope="col">Quantidade</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($estoquebaixo as $estoqueb)
      <tr>
        <td>{{ $estoqueb->produto }}</td>
        <td>{{ $estoqueb->sku }}</td>
        <td>{{ $estoqueb->quantidade }}</td>
      </tr>      
    @endforeach
  </tbody>
</table>