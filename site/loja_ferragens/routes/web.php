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

Route::get('/carrinho', function(){
    return view('carrinho');
});

// FIM ROTAS SITE

// INICIO ROTAS ADM
Route::get('/adm', function(){
    return view('layout_adm.index');
});

//Produtos
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/novo', [ProdutoController::class, 'inserir']);
Route::get('/alterar', [ProdutoController::class, 'alterar']);
Route::get('/excluir', [ProdutoController::class, 'excluir']);

//Secao
Route::get('/secoes', [SecaoController::class, 'index']);
Route::get('/novo', [SecaoController::class, 'inserir']);
Route::get('/alterar', [SecaoController::class, 'alterar']);
Route::get('/excluir', [SecaoController::class, 'excluir']);

//Pessoa
Route::get('/clientes', [PessoaController::class, 'index']);
Route::get('/novo', [PessoaController::class, 'inserir']);
Route::get('/alterar', [PessoaController::class, 'alterar']);
Route::get('/excluir', [PessoaController::class, 'excluir']);

//Vendas
Route::get('/vendas', [VendasController::class, 'index']);

// FIM ROTAS ADM