<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{    
    public function formularioLogin(){
    return view("login.login");
    }

    public function formularioCadastroCliente(){
        return view("login.criar_conta_cliente");
    }

    public function formularioCadastroAdministrador(){
        return view("login.criar_conta_adm");
    }

    public function registrarCliente(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $cliente = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::login($cliente);

        return redirect()->route('login')->with('success', 'Registro concluído com sucesso!');
    }

    public function registrarAdministrador(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'access_level' => '0',
        ]);

        Auth::login($admin);

        return redirect()->route('usuarios')->with('success', 'Registro concluído com sucesso!');
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

            if ($user->access_level === '0') {
                return redirect()->intended('/adm')->with('success', 'Login bem-sucedido! Bem-vindo, Admin.');
            } elseif ($user->access_level === '1') {
                return redirect()->intended('/perfil')->with('success', 'Login bem-sucedido! Bem-vindo, Cliente.');
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

        return redirect()->route('login');
    }
}
