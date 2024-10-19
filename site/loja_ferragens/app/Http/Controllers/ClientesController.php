<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = User::all()->where("access_level", "1");

        return view('clientes.index', compact('clientes'));
    }
}
