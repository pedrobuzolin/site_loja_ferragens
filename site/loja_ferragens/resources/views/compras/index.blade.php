@extends("layout_cliente.index")
@section("conteudo_cliente")
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <h1 class="card-title">Listagem de Compras</h1>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0 table">
                        <thead class="table-light">
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
                                    <td class="text-center fw-medium">{{date("d/m/Y", strtotime($compra->created_at))}}</td>
                                    <td class="text-center fw-medium">R$ {{number_format($compra->total_venda, '2', ',', '.')}}</td>
                                    <td class="text-center fw-medium">
                                        @switch($compra->tipo_pagamento)
                                            @case('credit_card')
                                                Cartão de Crédito
                                                @break
                                            @case('account_money')
                                                Saldo da Conta
                                                @break
                                            @case('ticket')
                                                Boleto
                                                @break
                                            @case('bank_transfer')
                                                PIX
                                                @break
                                            @case('debit_card')
                                                Cartão de Débito
                                                @break
                                            @case('prepaid_card')
                                                Cartão Pré-Pago
                                                @break
                                            @case('digital_wallet')
                                                PayPal
                                                @break
                                            @case('crypto_transfer')
                                                Criptomoedas
                                                @break  
                                            @default
                                                Sem Pagamento
                                        @endswitch
                                    </td>
                                    <td class="text-center fw-medium">
                                        <a href="javascript:void(0);" class="botao_mais" data-id={{$compra->id}}><iconify-icon icon="fluent-emoji-high-contrast:plus"></iconify-icon></a>
                                    </td>
                                </tr>
                                <tr class='venda{{$compra->id}} table-light' style='display: none;'>
                                    <th scope="col" class="text-start ps-0">Descrição</th>
                                    <th scope="col" class="text-center ps-0">Quantidade</th>
                                    <th scope="col" class="text-center ps-0">Valor</th>  
                                </tr>
                                @foreach ($compra->itens as $item)
                                    <tr class='venda{{$compra->id}}' style='display: none;'>
                                        <td class="text-start fw-medium">{{$item->produtos->nome}}</td>
                                        <td class="text-center fw-medium">{{$item->quantidade}}</td>
                                        <td class="text-center fw-medium">R$ {{number_format($item->valor_produto, '2', ',', '.')}}</td>
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