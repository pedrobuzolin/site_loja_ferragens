<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprasClienteController extends Controller
{
    public function index(){
        return view('compras.index');
    }
}
