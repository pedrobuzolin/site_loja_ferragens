<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;
use App\Models\Imagens;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);

        $total = 0;
        
        foreach ($carrinho as $produtoId => $prod) {
            $carrinho[$produtoId]['subtotal'] = $prod['preco'] * $prod['quantidade'];
            $total += $carrinho[$produtoId]['subtotal'];
        }
    
        session()->put('carrinho_total', $total);
        return view('site.carrinho', compact('carrinho', 'total'));
    }

    public function adicionarProduto(Request $request)
    {
        $produtoId = $request->id;
        $quantidade = $request->quantidade;

        $produto = Produto::where("id", $produtoId)->first();
        $nome = $produto->nome;
        $preco = $produto->preco;
        $imagem = $produto->imagens->first();
        $urlImg = $imagem->urlImagem;

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$produtoId])) {
            $carrinho[$produtoId]['quantidade'] += $quantidade;
        } else {
            $carrinho[$produtoId] = [
                'id' => $produtoId,
                'nome' => $nome,
                'preco' => $preco,
                'urlImg' => $urlImg,
                'quantidade' => $quantidade
            ];
        }
    
        session()->put('carrinho', $carrinho);
        return response()->json(['success' => true, 'carrinho' => $carrinho]);
    }

    public function aumentarQuantidade($id)
    {
        $produtoId = $id;
        $carrinho = session()->get('carrinho', []);
        $quantidadeAtual = $carrinho[$produtoId]['quantidade'];

        if (isset($carrinho[$produtoId])) {
            $quantidadeAtual += 1;
            $carrinho[$produtoId]['quantidade'] = $quantidadeAtual;
        }
        session()->put('carrinho', $carrinho);
        return redirect()->back();
    }

    public function diminuirQuantidade($id)
    {
        $produtoId = $id;
        $carrinho = session()->get('carrinho', []);
        $quantidadeAtual = $carrinho[$produtoId]['quantidade'];
        if (isset($carrinho[$produtoId]) && $carrinho[$produtoId]['quantidade'] > 0) {
            $quantidadeAtual -= 1;
            $carrinho[$produtoId]['quantidade'] = $quantidadeAtual;
        }
        if($carrinho[$produtoId]['quantidade'] == 0){
            unset($carrinho[$produtoId]);
        }
        session()->put('carrinho', $carrinho);
        return redirect()->back();
    }

    public function removerProduto($id)
    {
        $carrinho = session()->get('carrinho', []);
        $produtoId = $id;
        if (isset($carrinho[$produtoId])) {
            unset($carrinho[$produtoId]);
        }
        session()->put('carrinho', $carrinho);
        return redirect()->back();
    }

    public function contarItens()
    {
        $carrinho = session()->get('carrinho', []);
        $totalItens = count($carrinho);
        return response()->json(['totalItens' => $totalItens]);
    }

    
}
