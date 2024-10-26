<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Vendas;
use App\Models\Clientes;

class VendasController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->access_level === '0'){
                $vendas = Vendas::with('itens')->get();
                return view('vendas.index', compact('vendas'));
            }
            elseif($user->access_level === '1'){
                $id_usuario = $user->id;
                $cliente = Clientes::where('id_user', $id_usuario)->first();
                $id_cliente = $cliente->id;
                $compras = Vendas::with('itens')->where('id_cliente', $id_cliente)->where('status', 'approved')->get();
                return view('compras.index', compact('compras'));
            }
        }
    }
}
