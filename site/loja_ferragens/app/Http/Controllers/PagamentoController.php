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

class PagamentoController extends Controller
{
    protected function authenticate()
    {
        $mpAccessToken = env('MERCADO_PAGO_ACCESS_TOKEN');
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }

    public function createPreferenceRequest($items, $payer, $id_venda)
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

    public function pagamento()
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
                "currency_id" => "BRL",
                "quantity" => floatval($produto['quantidade']),
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
        } 
        catch (MPApiException $error) {
            return null;
        }
    }

    public function redirectPeloStatusPagamento(Request $request)
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
        session()->forget('carrinho');
        if($status == 'approved'){
            return view('site.pagamento_sucesso');
        }
        else{
            return view('site.pagamento_falha');
        }
    }
}
