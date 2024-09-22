<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secao;

class SecaoController extends Controller
{
    public function index()
    {
        return view("secoes.index");
    }

    public function inserir()
    {
        return view('secoes.inserir');
    }

    public function alterar()
    {
        return view('secoes.alterar');
    }

    public function excluir()
    {
        return view('secoes.index');
    }
}
