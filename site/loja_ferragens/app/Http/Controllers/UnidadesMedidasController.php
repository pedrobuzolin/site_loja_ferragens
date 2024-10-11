<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadeMedidas;

class UnidadesMedidasController extends Controller
{
    public function index()
    {
        $unidadeMedidas = UnidadeMedidas::all()->where("uni_ativo", "1");

        return view('unidadeMedidas.index', compact('unidadeMedidas'));
    }

    public function buscarUnidade(Request $request)
    {
        $ativo = $request->input("uni_ativo");
        $busca = $request->input("buscar");
        if($ativo == "1"){
            $unidadeMedidas = UnidadeMedidas::where("uni_ativo", "1")->whereRaw("LOWER(unidadeMedida) LIKE ?", ['%' . strtolower($busca) . '%'])->get();
        }
        else
        {
            $unidadeMedidas = UnidadeMedidas::all()->where("uni_ativo", "0");
        }

        return view('unidadeMedidas.index', compact('unidadeMedidas'));
    }

    public function incluir()
    {
        return view('unidadeMedidas.inserir');
    }

    public function incluirUnidade(Request $request)
    {
        $request->validate([
            'unidadeMedida' => 'required|string|max:10',
        ]);

        UnidadeMedidas::create($request->all());
        return redirect('/adm/unidades-medidas');
    }

    public function buscarAlteracao($id)
    {
        $unidadeMedidas = UnidadeMedidas::where("id", $id)->first();
        return view('unidadeMedidas.alterar', compact('unidadeMedidas'));
    }

    public function executarAlteracao(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:unidade_medidas,id',
            'unidadeMedida' => 'required|string|max:10',
            'uni_ativo' => 'required|boolean',
        ]);
        $idUnidade = $request['id'];
        $unidadeMedida = $request['unidadeMedida'];
        $uni_ativo = $request['uni_ativo'];

        $unidade_medidas = UnidadeMedidas::find($idUnidade);
        $unidade_medidas->unidadeMedida = $unidadeMedida;
        $unidade_medidas->uni_ativo = $uni_ativo;
        $unidade_medidas->save();

        return redirect('/adm/unidades-medidas');
    }

    public function excluir($id)
    {
        $unidadeMedidas = UnidadeMedidas::where("id", $id)->first();
        $unidadeMedidas->uni_ativo = 0;
        $unidadeMedidas->save();
        return redirect('/adm/unidades-medidas');
    }
}
