<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all()->where("cliente_ativo", "1");

        return view('clientes.index', compact('clientes'));
    }
}
