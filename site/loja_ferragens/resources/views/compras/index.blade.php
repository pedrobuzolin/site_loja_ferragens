@extends("layout_cliente.index")
@section("conteudo_cliente")
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h1 class="card-title">Lista de Compras</h1>
                    </div>
                    <div class=" col-6">
                        <input class="form-control" type="text" placeholder="Busque uma venda" />
                    </div>
                    <div class="col">
                        <a class="btn btn-warning">Buscar</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                        <thead>
                            <tr class="border-2 border-bottom border-primary border-0"> 
                                <th scope="col" class="text-start ps-0">ID</th>
                                <th scope="col" class="text-center">Data Venda</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Tipo de Pagamento</th>
                                <th scope="col" class="text-center">Mais Informações</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($compras as $compra)               
                                <tr>
                                    <th class="text-start ps-0 fw-medium">{{$compra->id}}</th>
                                    <td class="text-center fw-medium">{{$compra->created_at}}</td>
                                    <td class="text-center fw-medium">{{$compra->total_venda}}</td>
                                    <td class="text-center fw-medium">{{$compra->tipo_pagamento}}</td>
                                    <td class="text-center fw-medium">
                                        <a href="javascript:void(0);" class="botao_mais" data-id={{$compra->id}}><iconify-icon icon="fluent-emoji-high-contrast:plus"></iconify-icon></a>
                                    </td>
                                </tr>
                                <tr class='venda{{$compra->id}}' style='display: none;'>
                                    <th scope="col" class="text-start ps-0">Descrição</th>
                                    <th scope="col" class="text-start ps-0">Quantidade</th>
                                    <th scope="col" class="text-start ps-0">Valor</th>  
                                </tr>
                                @foreach ($compra->itens as $item)
                                    <tr class='venda{{$compra->id}}' style='display: none;'>
                                        <td class="text-start fw-medium">{{$item->produtos->nome}}</td>
                                        <td class="text-start fw-medium">{{$item->quantidade}}</td>
                                        <td class="text-start fw-medium">{{$item->valor_produto}}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    var botao_mais = document.querySelectorAll('.botao_mais');
    botao_mais.forEach(function(button) {
        button.addEventListener('click', function() {
            var idVenda = this.getAttribute('data-id');
            var produtos = document.querySelectorAll('.venda' + idVenda);

            produtos.forEach(function(produto) {
                produto.style.display = produto.style.display === 'none' ? 'table-row' : 'none';
            });
        });
    });
</script>
@stop