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

    public function formularioCadastroCliente(){
        return view("login.criar_conta_cliente");
    }

    public function registrarCliente(Request $request)
    {
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

    public function buscarAlteracaoCliente($id)
    {
        $cliente = Clientes::with('user')->find($id);
        return view("clientes.alterar_cliente", compact("cliente"));
    }

    public function alterarCliente(Request $request)
    {
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
}
