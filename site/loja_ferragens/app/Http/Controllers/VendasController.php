<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendas;
use App\Models\Clientes;

class VendasController extends Controller
{
    public function indexAdm()
    {
        $vendas = Vendas::with('itens')->get();
        return view('vendas.index', compact('vendas'));
    }

    public function indexCliente(){
        if(Auth::check()){
            $id_usuario = Auth::id();
            $cliente = Clientes::where('id_user', $id_usuario)->first();
            $id_cliente = $cliente->id;
        }
        $compras = Vendas::with('itens')->where('id_cliente', $id_cliente)->where('status', 'approved')->get();
        return view('compras.index', compact('compras'));
    }
}
