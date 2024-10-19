<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $usuario = User::all()->where("access_level", "0");

        return view('usuarios.index', compact('usuario'));
    }
}
