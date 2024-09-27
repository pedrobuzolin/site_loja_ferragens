<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SecaoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\VendasController;

// INICIO ROTAS SITE
Route::get('/', function () {
    return view('site.index');
});

Route::get('/automotivo', function () {
    return view('site.automotivo');
});

Route::get('/eletrica', function () {
    return view('site.eletrica');
});

Route::get('/ferragens', function () {
    return view('site.ferragens');
});

Route::get('/ferramentasEletricas', function () {
    return view('site.ferramentasEletricas');
});

Route::get('/ferramentasManuais', function () {
    return view('site.ferramentasManuais');
});

Route::get('/gastronomia', function () {
    return view('site.gastronomia');
});

Route::get('/hidraulica', function () {
    return view('site.hidraulica');
});

Route::get('/jardinagem', function () {
    return view('site.jardinagem');
});

Route::get('/lazer', function () {
    return view('site.lazer');
});

Route::get('/marcenaria', function () {
    return view('site.marcenaria');
});

Route::get('/parafusos', function () {
    return view('site.parafusos');
});

Route::get('/seguranca', function () {
    return view('site.seguranca');
});

Route::get('/tintas', function () {
    return view('site.tintas');
});

Route::get('/utilidades', function () {
    return view('site.utilidades');
});

Route::get('/login', function(){
    return view('site.login');
});

Route::get('/criarConta', function(){
    return view('site.criarConta');
});

Route::get('/carrinho', function(){
    return view('site.carrinho');
});

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
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos-novo', [ProdutoController::class, 'inserir']);
Route::get('/produtos-alterar', [ProdutoController::class, 'alterar']);
Route::get('/produtos-excluir', [ProdutoController::class, 'excluir']);


//Pessoa
Route::get('/clientes', [PessoaController::class, 'index']);
Route::get('/clientes-alterar', [PessoaController::class, 'alterar']);
Route::get('/clientes-excluir', [PessoaController::class, 'excluir']);

//Vendas
Route::get('/vendas', [VendasController::class, 'index']);

// FIM ROTAS ADM