<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    public function index()
    {
        return view("clientes.index");
    }

    public function inserir()
    {
        return view('clientes.inserir');
    }

    public function alterar()
    {
        return view('clientes.alterar');
    }

    public function excluir()
    {
        return view('clientes.index');
    }
}
