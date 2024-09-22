<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {

        return view('produtos.index');
    }

    public function inserir()
    {
        return view('produtos.inserir');
    }

    public function alterar()
    {
        return view('produtos.alterar');
    }

    public function excluir()
    {
        return view('produtos.index');
    }
}
