$(document).ready(function(){
    $('.add_carrinho').on('click', function(event) {
        event.preventDefault();
        adicionarAoCarrinho($(this));
    });

    $('input[name="quantidade"]').on('keypress', function(event) {
        if (event.which === 13) {
            event.preventDefault();
            var addCarrinhoBtn = $(this).closest('.produto').find('.add_carrinho');
            adicionarAoCarrinho(addCarrinhoBtn);
        }
    });

    function adicionarAoCarrinho(element) {
        var idProd = element.data('id-produto');
        var quantidade = element.closest('.produto').find('input[name="quantidade"]').val();
        var csrfToken = $('input[name="_token"]').val();

        if(quantidade <= 0 || quantidade === "") {
            alert('Por favor, insira uma quantidade válida.');
            return;
        }

        $.ajax({
            url: '/adicionar-produto',
            type: 'POST',
            data: {
                _token: csrfToken,
                id: idProd,
                quantidade: quantidade
            },
            success: function(response){
                if (response.success) {
                    atualizarNumeroCarrinho();
                    element.closest('.produto').find('input[name="quantidade"]').val('');
                } else {
                    alert('Erro ao adicionar produto no carrinho.');
                }
            }
        });
    }

    function atualizarNumeroCarrinho() {
        $.ajax({
            url: '/itens-carrinho',
            type: 'GET',
            success: function(response){
                $('#carrinho_itens').text(response.totalItens);
            }
        });
    }
    atualizarNumeroCarrinho();
});
