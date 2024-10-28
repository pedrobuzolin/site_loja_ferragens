<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

    public function buscarUsuario(Request $request)
    {
        $ativo = $request->input("active");
        $busca = $request->input("buscar");
        if($ativo == "1"){
            $usuario = User::where("access_level", "0")->where("active", "1")->whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($busca) . '%'])->get();
        }
        else
        {
            $usuario = User::all()->where("access_level", "0")->where("active", 0);
        }

        return view('usuarios.index', compact('usuario'));
    }


    protected function getInfoAdm(Request $request, $id = null)
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
        ]);

        return $validatedData;
    }

    public function registrarAdministrador(Request $request)
    {
        $infoAdm = $this->getInfoAdm($request);
        $admin = User::create([
            'name' => $infoAdm['name'],
            'email' => $infoAdm['email'],
            'password' => Hash::make($infoAdm['password']),
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
        ]);

        $id = $validatedData['id'];
        $infoAdm = $this->getInfoAdm($request, $id);
        $admin = User::find($id);
        $admin->name = $infoAdm['name'];
        $admin->email = $infoAdm['email'];
        
        if ($request->filled('password')) {
            $admin->password = Hash::make($infoAdm['password']);
        }
    
        $admin->save();
        
        return redirect()->route('usuarios')->with('success', 'Registro concluído com sucesso!');
    }
    
   
    public function alterarStatus($id)
    {
        $usuario = User::find($id);
        if($usuario->active == 0){
            $usuario->active = 1;
        }
        elseif($usuario->active == 1){
            $usuario->active = 0;
        }
        $usuario->save();
        return redirect()->route("usuarios");

    }
}
