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
                return redirect('/adm')->with('success', 'Você já está logado como Admin.');
            } elseif ($user->access_level === '1') {
                return redirect('/perfil')->with('success', 'Você já está logado como Cliente.');
            }
        }
    
        return view('login.login');
    }

    public function formularioCadastroCliente(){
        return view("login.criar_conta_cliente");
    }

    public function formularioCadastroAdministrador(){
        return view("login.criar_conta_adm");
    }

    public function registrarCliente(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'nome_cliente' => 'required|string',
                'cpf' => 'required|string|min:11|max:11',
                'celular' => 'required|string|min:11|max:11',
                'cep' => 'required|string|min:8|max:8',
                'rua' => 'required|string',
                'numero' => 'required|string',
                'complemento' => 'nullable|string',
                'bairro' => 'required|string',
                'cidade' => 'required|string',
                'uf' => 'required|string|min:2|max:2',
            ]);
        
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
    
            Auth::login($user);
    
            $cliente = Clientes::create([
                'id_user' => $user->id,
                'nome_cliente' => $validatedData['nome_cliente'],
                'cpf' => $validatedData['cpf'],
                'celular' => $validatedData['celular'],
            ]);
    
            $endereco = Enderecos::create([
                'id_cliente' => $cliente->id,
                'cep' => $validatedData['cep'],
                'rua' => $validatedData['rua'],
                'numero' => $validatedData['numero'],
                'complemento' => $validatedData['complemento'],
                'bairro' => $validatedData['bairro'],
                'cidade' => $validatedData['cidade'],
                'uf' => $validatedData['uf'],
            ]);
    
            return redirect()->route('login')->with('success', 'Registro concluído com sucesso!');
        }
        catch (ValidationException $e) {
            // Exibir os erros de validação
            dd($e->errors());
        }
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
    
    public function buscarAlteracaoCliente($id)
    {
        $cliente = Clientes::with('user')->find($id);
        return view("clientes.alterar_cliente", compact("cliente"));
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
    
    public function alterarCliente(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'idCliente' => 'required|exists:clientes,id',
                'idUsuario' => 'required|exists:users,id',
                'idEndereco' => 'required|exists:enderecos,id',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'nullable|string|min:8|confirmed',
                'nome_cliente' => 'required|string',
                'cpf' => 'required|string|min:11|max:11',
                'celular' => 'required|string|min:11|max:11',
                'cep' => 'required|string|min:8|max:8',
                'rua' => 'required|string',
                'numero' => 'required|string',
                'complemento' => 'nullable|string',
                'bairro' => 'required|string',
                'cidade' => 'required|string',
                'uf' => 'required|string|min:2|max:2',
            ]);
        
            $idUsuario = $validatedData['idUsuario'];
            $idCliente = $validatedData['idCliente'];
            $idEndereco = $validatedData['idEndereco'];

            $usuario = User::find($idUsuario);
            $usuario->name = $validatedData['name'];
            $usuario->email = $validatedData['email'];
            
            if ($request->filled('password')) {
                $usuario->password = Hash::make($validatedData['password']);
            } 
            $usuario->save();
    
            $cliente = Clientes::find($idCliente);
            $cliente->update([
                'nome_cliente' => $validatedData['nome_cliente'],
                'cpf' => $validatedData['cpf'],
                'celular' => $validatedData['celular'],
            ]);
    
            $endereco = Enderecos::find($idEndereco);
            $endereco->update([
                'cep' => $validatedData['cep'],
                'rua' => $validatedData['rua'],
                'numero' => $validatedData['numero'],
                'complemento' => $validatedData['complemento'],
                'bairro' => $validatedData['bairro'],
                'cidade' => $validatedData['cidade'],
                'uf' => $validatedData['uf'],
            ]);

            if (Auth::check()) {
                $user = Auth::user();
                
                if ($user->access_level === '0') {
                    return redirect()->route('clientes')->with('success', 'Registro concluído com sucesso!');
                } elseif ($user->access_level === '1') {
                    return redirect()->route('home_cliente')->with('success', 'Registro concluído com sucesso!');
                }
            }
    
        }
        catch (ValidationException $e) {
            // Exibir os erros de validação
            dd($e->errors());
        }
    }

    public function desativarAdm($id)
    {
        $usuario = User::find($id);
        $usuario->active = 0;
        $usuario->save();
        return redirect()->route("usuarios");

    }

    public function desativarCliente($id)
    {
        $cliente = Clientes::find($id);
        $cliente->cliente_ativo = 0;
        $cliente->save();

        $idUsuario = $cliente->id_user;
        $usuario = User::find($idUsuario);
        $usuario->active = 0;
        $usuario->save();

        return redirect()->route("clientes");
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

        return redirect('/');
    }
}
