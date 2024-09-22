<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendas;

class VendasController extends Controller
{
    public function index()
    {
        return view("vendas.index");
    }
}
