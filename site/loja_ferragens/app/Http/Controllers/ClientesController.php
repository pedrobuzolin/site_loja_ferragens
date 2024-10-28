<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Enderecos;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all()->where("cliente_ativo", "1");

        return view('clientes.index', compact('clientes'));
    }

    public function buscarCliente(Request $request)
    {
        $ativo = $request->input("cliente_ativo");
        $busca = $request->input("buscar");
        if($ativo == "1"){
            $clientes = Clientes::where("cliente_ativo", "1")->whereRaw("LOWER(nome_cliente) LIKE ?", ['%' . strtolower($busca) . '%'])->get();
        }
        else
        {
            $clientes = Clientes::all()->where("cliente_ativo", "0");
        }

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

    protected function getInfoCliente(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                $id ? Rule::unique('users')->ignore($id) : 'unique:users',
            ],
            'password' => $id ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
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

        return $validatedData;
    }

    public function registrarCliente(Request $request)
    {
        $infoCliente = $this->getInfoCliente($request);

        $user = User::create([
            'name' => $infoCliente['name'],
            'email' => $infoCliente['email'],
            'password' => Hash::make($infoCliente['password']),
        ]);
    
        Auth::login($user);
    
        $cliente = Clientes::create([
            'id_user' => $user->id,
            'nome_cliente' => $infoCliente['nome_cliente'],
            'cpf' => $infoCliente['cpf'],
            'celular' => $infoCliente['celular'],
        ]);
    
        $endereco = Enderecos::create([
            'id_cliente' => $cliente->id,
            'cep' => $infoCliente['cep'],
            'rua' => $infoCliente['rua'],
            'numero' => $infoCliente['numero'],
            'complemento' => $infoCliente['complemento'],
            'bairro' => $infoCliente['bairro'],
            'cidade' => $infoCliente['cidade'],
            'uf' => $infoCliente['uf'],
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
        ]);
        
        $idUsuario = $validatedData['idUsuario'];
        $infoCliente = $this->getInfoCliente($request, $idUsuario);

        $idCliente = $validatedData['idCliente'];
        $idEndereco = $validatedData['idEndereco'];

        $usuario = User::find($idUsuario);
        $usuario->name = $infoCliente['name'];
        $usuario->email = $infoCliente['email'];
        
        if ($request->filled('password')) {
            $usuario->password = Hash::make($infoCliente['password']);
        } 
        $usuario->save();
    
        $cliente = Clientes::find($idCliente);
        $cliente->update([
            'nome_cliente' => $infoCliente['nome_cliente'],
            'cpf' => $infoCliente['cpf'],
            'celular' => $infoCliente['celular'],
        ]);
    
        $endereco = Enderecos::find($idEndereco);
        $endereco->update([
            'cep' => $infoCliente['cep'],
            'rua' => $infoCliente['rua'],
            'numero' => $infoCliente['numero'],
            'complemento' => $infoCliente['complemento'],
            'bairro' => $infoCliente['bairro'],
            'cidade' => $infoCliente['cidade'],
            'uf' => $infoCliente['uf'],
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

    public function alterarStatus($id)
    {
        $cliente = Clientes::find($id);
        $idUsuario = $cliente->id_user;
        $usuario = User::find($idUsuario);
        if($cliente->cliente_ativo == 0){
            $cliente->cliente_ativo = 1;
            $usuario->active = 1;
        }
        elseif($cliente->cliente_ativo == 1){
            $cliente->cliente_ativo = 0;
            $usuario->active = 0;
        }
        $cliente->save();
        $usuario->save();

        return redirect()->route("clientes");
    }
}
