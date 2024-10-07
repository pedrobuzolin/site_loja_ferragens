<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SecaoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\CarrinhoController;

// INICIO ROTAS SITE
Route::get('/', [ProdutoController::class, 'exibirDestaques']);

Route::get('/secoes/{id}', [ProdutoController::class, 'exibirProdutos'])->name('secoes_exibir');

Route::get('/login', function(){
    return view('site.login');
});

Route::get('/criarConta', function(){
    return view('site.criarConta');
});

Route::get('/carrinho', [CarrinhoController::class, 'index']);
Route::post('/adicionar-produto', [CarrinhoController::class, 'adicionarProduto'])->name('add-produto');
Route::get('/aumentar-quantidade/{id}', [CarrinhoController::class, 'aumentarQuantidade'])->name('add-qte');
Route::get('/diminuir-quantidade/{id}', [CarrinhoController::class, 'diminuirQuantidade'])->name('rm-qte');
Route::get('/remover-produto/{id}', [CarrinhoController::class, 'removerProduto'])->name('rm-prod');
Route::get('/itens-carrinho', [CarrinhoController::class, 'contarItens']);

// FIM ROTAS SITE

// INICIO ROTAS ADM
Route::get('/adm', function(){
    return view('layout_adm.index');
});

//Secao
Route::get('/adm/secoes', [SecaoController::class, 'index'])->name('secoes');
Route::get('/adm/secoes/novo', [SecaoController::class, 'incluir'])->name('secoes_novo');
Route::post('/adm/secoes/novo', [SecaoController::class, 'incluirSecao'])->name('secoes_novo');
Route::get('/adm/secoes/alterar/{id}', [SecaoController::class, 'buscarAlteracao'])->name('secoes_alterar');
Route::post('/adm/secoes/alterar', [SecaoController::class, 'executarAlteracao'])->name('secoes_alt');;
Route::get('/adm/secoes/excluir/{id}', [SecaoController::class, 'excluir'])->name('secoes_excluir');

//Produtos
Route::get('/adm/produtos', [ProdutoController::class, 'index'])->name('produtos');
Route::get('/adm/produtos/novo', [ProdutoController::class, 'inserir'])->name('produtos_novo');
Route::post('/adm/produtos/novo', [ProdutoController::class, 'incluirProduto'])->name('produtos_novo');
Route::get('/adm/produtos/alterar/{id}', [ProdutoController::class, 'alterar'])->name('produtos_alterar');
Route::post('/adm/produtos/alterar', [ProdutoController::class, 'executarAlteracao'])->name('produtos_alt');;
Route::get('/adm/produtos/excluir/{id}', [ProdutoController::class, 'excluir'])->name('produtos_excluir');


//Pessoa
Route::get('/adm/clientes', [PessoaController::class, 'index'])->name('clientes');
Route::get('/adm/clientes-alterar', [PessoaController::class, 'alterar']);
Route::get('/adm/clientes-excluir', [PessoaController::class, 'excluir']);

//Vendas
Route::get('/adm/vendas', [VendasController::class, 'index'])->name('vendas');

// FIM ROTAS ADM