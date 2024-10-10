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
        $secao = Secao::where("id", $id)->first();
        return view('secoes.alterar', compact('secao'));
    }

    public function executarAlteracao(Request $request)
    {
        $nomeSecao = $request->input("nomeSecao");
        $idSecao = $request->input("id");

        $secao = Secao::where("id", $idSecao)->first();
        $secao->nomeSecao = $nomeSecao;
        $secao->save();

        return redirect('/adm/secoes');
    }

    public function excluir($id)
    {
        $secao = Secao::where("id", $id)->first();
        $secao->secao_ativo = 0;
        $secao->save();
        return redirect('/adm/secoes');
    }
}
