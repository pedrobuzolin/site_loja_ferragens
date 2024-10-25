<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user = Auth::user();
            $nome = $user->name;
            if ($user->access_level === '0') {
                return view('adm.index', compact('nome'));
            } elseif ($user->access_level === '1') {
                return view('perfil.index', compact('nome'));
            }
        }
    }
}
