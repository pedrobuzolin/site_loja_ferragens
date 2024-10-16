@extends("layout_adm.index")
@section("conteudo_adm")
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h1 class="card-title">Lista de Vendas</h1>
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
                                <th scope="col" class="text-center ps-0">ID</th>
                                <th scope="col" class="text-center">Data Venda</th>
                                <th scope="col" class="text-center">Nome Cliente</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Tipo de Pagamento</th>
                                <th scope="col" class="text-center">Tipo de Entrega</th>
                                <th scope="col" class="text-center">Mais Informações</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <tr>
                                <th class="text-center ps-0 fw-medium">1</th>
                                <td class="text-center fw-medium">22/05/2024</td>
                                <td class="text-center fw-medium">Pedro</td>
                                <td class="text-center fw-medium">23,99</td>
                                <td class="text-center fw-medium">Crédito</td>
                                <td class="text-center fw-medium">Entrega</td>
                                <td class="text-center fw-medium">
                                    <a href="javascript:void(0);" class="botao_mais" data-id='1'><iconify-icon icon="fluent-emoji-high-contrast:plus"></iconify-icon></a>
                                </td>
                            </tr>
                            <tr class='venda1' style='display: none;'>
                                <th scope="col" class="text-center ps-0">Descrição</th>
                                <th scope="col" class="text-center ps-0">Quantidade</th>
                                <th scope="col" class="text-center ps-0">Valor</th>  
                            </tr>
                            <tr class='venda1' style='display: none;'>
                                <td class="text-center fw-medium">Martelo</td>
                                <td class="text-center fw-medium">2</td>
                                <td class="text-center fw-medium">R$ 29.99</td>
                            </tr>
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