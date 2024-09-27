<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secao;

class SecaoController extends Controller
{
    public function index()
    {
        $secao = Secao::all()->where("secao_ativo", "1");

        return view('secoes.index', compact('secao'));
    }

    public function incluir()
    {
        return view('secoes.inserir');
    }

    public function incluirSecao(Request $request)
    {
        $nomeSecao = $request->input("nomeSecao");

        $novaSecao = new Secao;
        $novaSecao->nomeSecao = $nomeSecao;
        $novaSecao->save();

        return redirect('/adm/secoes');
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
