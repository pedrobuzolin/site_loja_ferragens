<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SecaoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\VendasController;

Route::get('/', function () {
    return view('site.index');
});

Route::get('/login', function(){
    return view('login');
});

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