@extends("layout_adm.index")
@section("conteudo_adm")
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <h1 class="card-title">Lista de Vendas</h1>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                        <thead class="table-light">
                            <tr class="border-2 border-bottom border-primary border-0"> 
                                <th scope="col" class="text-center ps-0">ID</th>
                                <th scope="col" class="text-center">Data Venda</th>
                                <th scope="col" class="text-center">Nome Cliente</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Tipo de Pagamento</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Mais Informações</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($vendas as $venda)               
                                <tr>
                                    <th class="text-start ps-0 fw-medium">{{$venda->id}}</th>
                                    <td class="text-center fw-medium">{{date("d/m/Y", strtotime($venda->created_at))}}</td>
                                    <td class="text-center fw-medium">{{$venda->clientes->nome_cliente}}</td>
                                    <td class="text-center fw-medium">R$ {{number_format($venda->total_venda, '2', ',', '.')}}</td>
                                    <td class="text-center fw-medium">
                                        @switch($venda->tipo_pagamento)
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
                                        @if($venda->status == 'approved')
                                            Aprovada
                                        @else
                                            Rejeitada
                                        @endif
                                    </td>
                                    <td class="text-center fw-medium">
                                        <a href="javascript:void(0);" class="botao_mais" data-id={{$venda->id}}><iconify-icon icon="fluent-emoji-high-contrast:plus"></iconify-icon></a>
                                    </td>
                                </tr>
                                <tr class='venda{{$venda->id}} table-light' style='display: none;'>
                                    <th scope="col" class="text-start ps-0">Descrição</th>
                                    <th scope="col" class="text-start ps-0">Quantidade</th>
                                    <th scope="col" class="text-start ps-0">Valor</th>  
                                </tr>
                                @foreach ($venda->itens as $item)
                                    <tr class='venda{{$venda->id}}' style='display: none;'>
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