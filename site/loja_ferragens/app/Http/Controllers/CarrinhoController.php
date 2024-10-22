<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;
use App\Models\Imagens;
use App\Models\Clientes;
use App\Models\Vendas;
use App\Models\ItensVendas;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class CarrinhoController extends Controller
{
    function index()
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

    function adicionarProduto(Request $request)
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

    function aumentarQuantidade($id)
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

    function diminuirQuantidade($id)
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

    function removerProduto($id)
    {
        $carrinho = session()->get('carrinho', []);
        $produtoId = $id;
        if (isset($carrinho[$produtoId])) {
            unset($carrinho[$produtoId]);
        }
        session()->put('carrinho', $carrinho);
        return redirect()->back();
    }

    function contarItens()
    {
        $carrinho = session()->get('carrinho', []);
        $totalItens = count($carrinho);
        return response()->json(['totalItens' => $totalItens]);
    }

    protected function authenticate()
    {
        $mpAccessToken = env('MERCADO_PAGO_ACCESS_TOKEN');
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }

    function createPreferenceRequest($items, $payer, $id_venda)
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

        $backUrls = array(
            'success' => route('success'),
            'failure' => route('failure')
        );

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "CASA EDLIN",
            "external_reference" => $id_venda,
            "expires" => false,
            "auto_return" => 'all',
        ];

        return $request;
    }

    function pagamento()
    {
        $this->authenticate();
        $carrinho = session()->get('carrinho', []);
        $total_carrinho = session()->get('carrinho_total', 0);
        if(Auth::check()){
            $id_usuario = Auth::id();
            $email_usuario = Auth::user()->email;
            $cliente = Clientes::where('id_user', $id_usuario)->first();
            $info_cliente = [
                "id_cliente" => $cliente->id,
                "nome_cliente" => $cliente->nome_cliente,
            ];
        }

        $venda = new Vendas();
        $venda->id_cliente = $cliente->id;
        $venda->total_venda = $total_carrinho;
        $venda->status = "pendente";
        $venda->save();
        
        $id_venda = $venda->id;

        
        
        $items = [];
        foreach ($carrinho as $produto) {
            $items[] = [
                "id" => $produto['id'],
                "title" => $produto['nome'],
                "description" => "Descrição do produto",
                "currency_id" => "BRL",
                "quantity" => intval($produto['quantidade']),
                "unit_price" => $produto['preco'],
            ];
            $item_venda = new ItensVendas();
            $item_venda->id_venda = $id_venda;
            $item_venda->id_produto = $produto['id'];
            $item_venda->valor_produto = $produto['preco'];
            $item_venda->quantidade = $produto['quantidade'];
            $item_venda->save();
        }

        $payer = array(
            "name" => $cliente->nome_cliente,
            "email" => $email_usuario,
        );

        $request = $this->createPreferenceRequest($items, $payer, $id_venda);
        
        $client = new PreferenceClient();
        
        try {
            $preference = $client->create($request);
            $link = $preference->init_point;
            return redirect()->away($link);

        } catch (MPApiException $error) {
            return null;
        }
    }

    function pagamentoCerto(Request $request)
    {
        $payment_id = $request->query('collection_id');
        $payment_type = $request->query('payment_type');
        $status = $request->query('status');
        $external_reference = $request->query('external_reference');

        $venda = Vendas::where('id', $external_reference)->first();
        $venda->status = $status;
        $venda->id_pagamento_mercado_pago = $payment_id;
        $venda->tipo_pagamento = $payment_type;
        $venda->save();
        session()->flush('carrinho', []);
        return view('site.pagamento_sucesso');
    }
    function pagamentoFalha(Request $request)
    {
        $payment_id = $request->query('collection_id');
        $payment_type = $request->query('payment_type');
        $status = $request->query('status');
        $external_reference = $request->query('external_reference');

        $venda = Vendas::where('id', $external_reference)->first();
        $venda->status = $status;
        $venda->id_pagamento_mercado_pago = $payment_id;
        $venda->tipo_pagamento = $payment_type;
        $venda->save();
        session()->flush('carrinho', []);
        return view('site.pagamento_falha');
    }
}
