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

    public function buscarSecao(Request $request)
    {
        $ativo = $request->input("secao_ativo");
        $busca = $request->input("buscar");
        if($ativo == "1"){
            $secao = Secao::where("secao_ativo", "1")->whereRaw("LOWER(nomeSecao) LIKE ?", ['%' . strtolower($busca) . '%'])->get();
        }
        else
        {
            $secao = Secao::all()->where("secao_ativo", "0");
        }

        return view('secoes.index', compact('secao'));
    }

    public function incluir()
    {
        return view('secoes.inserir');
    }

    protected function getInfoSecao($request)
    {
        $validadedData = $request->validate([
            'nomeSecao' => 'required|string|max:30',
            'secao_ativo' => 'required|boolean',
        ]);

        return $validadedData;
    }
    public function incluirSecao(Request $request)
    {

        $infoSecao = $this->getInfoSecao($request);
        Secao::create($infoSecao);
        return redirect('/adm/secoes');
    }

    public function buscarAlteracao($id)
    {
        $secao = Secao::where("id", $id)->first();
        return view('secoes.alterar', compact('secao'));
    }

    public function executarAlteracao(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:secao,id',
        ]);

        $infoSecao = $this->getInfoSecao($request);
        $idSecao = $request['id'];
        $secao = Secao::find($idSecao);
        $secao->update($infoSecao);

        return redirect('/adm/secoes');
    }

    public function excluir($id)
    {
        $secao = Secao::find($id);
        if($secao->secao_ativo == 0){
            $secao->secao_ativo = 1;
        }
        elseif($secao->secao_ativo == 1){
            $secao->secao_ativo = 0;
        }
        $secao->save();
        return redirect('/adm/secoes');
    }
}
