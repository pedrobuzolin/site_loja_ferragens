<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Secao;
use App\Models\UnidadeMedidas;
use App\Models\Imagens;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all()->where("produto_ativo", "1");

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
        return view('produtos.alterar', compact('produto', 'secao'));
    }

    public function executarAlteracao(Request $request)
    {
        $id = $request->input("id");
        $nome = $request->input("nome");
        $descricaoProduto = $request->input("descricaoProduto");
        $idSecao = $request->input("idSecao");
        $estoque = $request->input("estoque");
        $unidade = $request->input("unidade");
        $preco = $request->input("preco");
        $destaque = $request->input("destaque");

        $produto = Produto::where("id", $id)->first();
        $produto->nome = $nome;
        $produto->descricaoProduto = $descricaoProduto;
        $produto->idSecao = $idSecao;
        $produto->unidadeMedida = $unidade;
        $produto->preco = $preco;
        $produto->estoque = $estoque;
        if($destaque == "SIM"){
            $produto->produto_destaque = 1;
        }
 
        if ($request->hasFile("imagem")) {
            $novaImagem = Cloudinary::upload($request->file("imagem")->getPathname())->getSecurePath();

            $imagem = $produto->imagens->first();
            $imagem->linkImagem = $novaImagem;
            $imagem->save();
        }

        $produto->save();

        return redirect('/adm/produtos');
    }

    public function excluir($id)
    {
        $produto = Produto::where("id", $id)->first();
        $produto->produto_ativo = 0;
        $produto->save();
        return redirect('/adm/produtos');
    }

    public function exibirDestaques()
    {
        $produtos = Produto::all()->where("produto_destaque", "1");
        $secao = Secao::where("secao_ativo", "1")->get();
        $carrinho = session('carrinho', []);
        return view('site.index', compact('produtos', 'secao'));
    }

    public function exibirProdutos($id)
    {
        $secao = Secao::where("id", $id)->first();
        $produtos = Produto::with('imagens')->where("idSecao", $id)->where("produto_ativo", "1")->get();
        $carrinho = session('carrinho', []);
        return view('site.secoes', compact('produtos', 'secao'));
    }
}
