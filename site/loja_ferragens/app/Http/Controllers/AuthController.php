<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clientes;
use App\Models\Enderecos;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{    
    public function formularioLogin(){
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->access_level === '0') {
                return redirect('/adm');
            } elseif ($user->access_level === '1') {
                return redirect('/perfil');
            }
        }
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if($user->active !== 1){
                Auth::logout();
                return back()->withErrors(['email'=> 'Sua conta foi desativada']);
            }

            if ($user->access_level === '0') {
                return redirect()->intended('/adm');
            } elseif ($user->access_level === '1') {
                return redirect()->intended('/perfil');
            }

            return redirect()->intended('/')->with('error', 'Acesso Inválido');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
