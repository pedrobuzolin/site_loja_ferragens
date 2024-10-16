$(document).ready(function(){
    $('.add_carrinho').click(function(){
        var idProd = $(this).data('id-produto');
        var quantidade = $(this).closest('.produto').find('input[name="quantidade"]').val();
        var csrfToken = $('input[name="_token"]').val();
        if(quantidade <= 0 || quantidade == "") {
            alert('Por favor, insira uma quantidade válida.');
            return;
        }

        $.ajax({
            url:'/adicionar-produto',
            type: 'POST',
            data: {
                _token: csrfToken,
                id: idProd,
                quantidade: quantidade},
            success: function(response){
                if (response.success) {
                    atualizarNumeroCarrinho();
                } else {
                    alert('Erro ao adicionar produto no carrinho.');
                }
            }
        });
    });
  
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