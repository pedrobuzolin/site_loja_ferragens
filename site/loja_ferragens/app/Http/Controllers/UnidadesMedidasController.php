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

    protected function getInfoUnidade($request){
        $validatedData = $request->validate([
            'unidadeMedida' => 'required|string|max:10',
            'uni_ativo' => 'required|boolean',
        ]);

        return $validatedData;
    }

    public function incluirUnidade(Request $request)
    {
        $infoUnidade = $this->getInfoUnidade($request);
        UnidadeMedidas::create($infoUnidade);
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
        ]);

        $infoUnidade = $this->getInfoUnidade($request);
        $idUnidade = $request['id'];

        $unidade_medidas = UnidadeMedidas::find($idUnidade);
        $unidade_medidas->update($infoUnidade);

        return redirect('/adm/unidades-medidas');
    }

    public function excluir($id)
    {
        $unidadeMedidas = UnidadeMedidas::where("id", $id)->first();
        if($unidadeMedidas->uni_ativo == 0){
            $unidadeMedidas->uni_ativo = 1;
        }
        elseif($unidadeMedidas->uni_ativo == 1){
            $unidadeMedidas->uni_ativo = 0;
        }
        $unidadeMedidas->save();
        return redirect('/adm/unidades-medidas');
    }
}
