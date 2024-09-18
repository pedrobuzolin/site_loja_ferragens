<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function(){
    return view('login');
});

// INICIO ROTAS ADM
Route::get('/adm', function(){
    return view('layout_adm.index');
});

Route::get('/produtos', [ProdutoController::class, 'index']);

// FIM ROTAS ADM