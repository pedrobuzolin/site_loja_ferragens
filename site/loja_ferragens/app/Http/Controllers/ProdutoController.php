<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Secao;
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

        return view('produtos.inserir', compact('secao'));
    }

    public function incluirProduto(Request $request)
    {
        $nomeProd = $request->input("nomeProduto");
        $descricaoProduto = $request->input("descricaoProduto");
        $idSecao = $request->input("idSecao");
        $estoque = $request->input("estoque");
        $unidade = $request->input("unidade");
        $preco = $request->input("preco");

        $novoProduto = new Produto;
        $novoProduto->nome = $nomeProd;
        $novoProduto->descricaoProduto = $descricaoProduto;
        $novoProduto->idSecao = $idSecao;
        $novoProduto->unidadeMedida = $unidade;
        $novoProduto->estoque = $estoque;
        $novoProduto->preco = $preco;
        $novoProduto->save();

        $idProduto = $novoProduto->id;
        if($request->hasFile('imagem')){
            $imagemUrl = Cloudinary::upload($request->file('imagem')->getPathname())->getSecurePath();
        
            $novaImagem = new Imagens;
            $novaImagem->idProduto = $idProduto;
            $novaImagem->linkImagem = $imagemUrl;
            $novaImagem->save();
        }

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

        $produto = Produto::where("id", $id)->first();
        $produto->nome = $nome;
        $produto->descricaoProduto = $descricaoProduto;
        $produto->idSecao = $idSecao;
        $produto->unidadeMedida = $unidade;
        $produto->preco = $preco;
        $produto->estoque = $estoque;
 
        if ($request->hasFile("imagem")) {
            $novaImagem = Cloudinary::upload($request->file("imagem")->getPathname())->getSecurePath();

            $imagem = $produto->imagens->first();
            $imagem->linkImagem = $novaImagem;
            $imagem->save();
        }

        $produto->save();

        return redirect('/adm/produtos');
    }

    public function excluir()
    {
        return view('produtos.index');
    }

    public function exibirProdutos($id)
    {
        $secao = Secao::where("id", $id)->first();
        $produtos = Produto::with('imagens')->where("idSecao", $id)->where("produto_ativo", "1")->get();

        return view('site.secoes', compact('produtos', 'secao'));
    }
}
