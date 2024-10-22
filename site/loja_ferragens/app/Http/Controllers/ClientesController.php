<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Enderecos;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all()->where("cliente_ativo", "1");

        return view('clientes.index', compact('clientes'));
    }

    public function buscarInfo(){
        if(Auth::check()){
            $id_user = Auth::id();
            $cliente = Clientes::with('user')->where('id_user', $id_user)->first();
        }
        return view('perfil.alterar_cliente', compact('cliente'));
    }
}
