<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAdminController extends Controller
{
    public function index()
    {
        $usuario = User::all()->where("access_level", "0")->where("active", 1);

        return view('usuarios.index', compact('usuario'));
    }

    public function formularioCadastroAdministrador(){
        return view("login.criar_conta_adm");
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

    public function buscarAlteracaoAdm($id)
    {
        $usuario = User::find($id);
        return view("usuarios.alterar_adm", compact("usuario"));
    }    
    
    public function alterarAdministrador(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $id = $validatedData['id'];
        $admin = User::find($id);
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        
        if ($request->filled('password')) {
            $admin->password = Hash::make($validatedData['password']);
        }
    
        $admin->save();
        
        return redirect()->route('usuarios')->with('success', 'Registro concluído com sucesso!');
    }
    
   
    public function desativarAdm($id)
    {
        $usuario = User::find($id);
        $usuario->active = 0;
        $usuario->save();
        return redirect()->route("usuarios");

    }
}
