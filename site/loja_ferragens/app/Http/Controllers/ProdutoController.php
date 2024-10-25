<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Secao;
use App\Models\UnidadeMedidas;
use App\Models\Imagens;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Validation\ValidationException;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all()->where("produto_ativo", "1");

        return view('produtos.index', compact('produtos'));
    }

    public function buscarProduto(Request $request)
    {
        $ativo = $request->input("produto_ativo");
        $busca = $request->input("buscar");
        if($ativo == "1"){
            $produtos = Produto::where("produto_ativo", "1")->whereRaw("LOWER(nome) LIKE ?", ['%' . strtolower($busca) . '%'])->get();
        }
        else
        {
            $produtos = Produto::all()->where("produto_ativo", "0");
        }

        return view('produtos.index', compact('produtos'));
    }

    public function inserir()
    {
        $secao = Secao::all()->where("secao_ativo", "1");
        $unidadeMedidas = UnidadeMedidas::all()->where("uni_ativo", "1");

        return view('produtos.inserir', compact('secao', 'unidadeMedidas'));
    }

    public function incluirProduto(Request $request)
    {
        $request->validate([
            'idSecao' => 'required|exists:secao,id',
            'idUniMedida' => 'required|exists:unidade_medidas,id',
            'nome' => 'required|string|max:80',
            'descricaoProduto' => 'required|string|max:255',
            'estoque' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'preco' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'produto_destaque' => 'required|boolean',
            'produto_ativo' => 'required|boolean',
            'imagem' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $infoProd = $request->except('imagem');

        $produto = Produto::create($infoProd);

        $imagemUrl = Cloudinary::upload($request->file('imagem')->getRealPath(),[
                'folder' => 'img-prod-ed'
            ])->getSecurePath();
        
        Imagens::create([
            "idProduto" => $produto->id,
            "urlImagem" => $imagemUrl,
        ]);

        return redirect('/adm/produtos');
    }

    public function alterar($id)
    {
        $produto = Produto::where("id", $id)->first();
        $secao = Secao::all()->where("secao_ativo", "1");
        $unidadeMedidas = UnidadeMedidas::all()->where("uni_ativo", "1");
        return view('produtos.alterar', compact('produto', 'secao', 'unidadeMedidas'));
    }

    public function executarAlteracao(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:produtos,id',
            'idSecao' => 'required|exists:secao,id',
            'idUniMedida' => 'required|exists:unidade_medidas,id',
            'nome' => 'required|string|max:80',
            'descricaoProduto' => 'required|string|max:255',
            'estoque' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'preco' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'produto_destaque' => 'required|boolean',
            'produto_ativo' => 'required|boolean',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $infoProd = $request->except(['id', 'imagem']);

        $id = $request['id'];
        $produto = Produto::find($id);
        
 
        if ($request->hasFile("imagem")) {
            $novaImagem = Cloudinary::upload($request->file('imagem')->getRealPath(),[
                'folder' => 'img-prod-ed'
            ])->getSecurePath();

            $imagem = $produto->imagens->first();
            $imagem->urlImagem = $novaImagem;
            $imagem->save();
        }
        $produto->update($infoProd);
        return redirect('/adm/produtos');
    }

    public function excluir($id)
    {
        $produto = Produto::where("id", $id)->first();
        $produto->produto_ativo = 0;
        $produto->produto_destaque = 0;
        $produto->save();
        return redirect('/adm/produtos');
    }

    public function exibirDestaques()
    {
        $produtos = Produto::where("produto_ativo", "1")->where("produto_destaque", "1")->get();
        $secao = Secao::where("secao_ativo", "1")->get();
        $carrinho = session('carrinho', []);
        return view('site.index', compact('produtos', 'secao'));
    }

    public function exibirProdutos($secao)
    {
        $secao = Secao::where("nomeSecao", $secao)->first();
        $id = $secao->id;
        $produtos = Produto::with('imagens')->where("idSecao", $id)->where("produto_ativo", "1")->get();
        $carrinho = session('carrinho', []);
        return view('site.secoes', compact('produtos', 'secao'));
    }

    public function exibirPesquisa(Request $request)
    {
        $busca = $request->input("buscar");
        $produtos = Produto::where("produto_ativo", "1")->whereRaw("LOWER(nome) LIKE ?", ['%' . strtolower($busca) . '%'])->get();
        $carrinho = session('carrinho', []);
        return view('site.pesquisa', compact('produtos', 'busca'));
    }
}
