<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ClienteMiddleware;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SecaoController;
use App\Http\Controllers\UnidadesMedidasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagamentoController;

// INICIO ROTAS SITE
    // Home
Route::get('/', [ProdutoController::class, 'exibirDestaques'])->name('home');
    
    // Seções
Route::get('/secoes/{secao}', [ProdutoController::class, 'exibirProdutos'])->name('secoes_exibir');

    //Pesquisa
Route::post('/pesquisa', [ProdutoController::class, 'exibirPesquisa'])->name('pesquisa_exibir');

    // Contato
Route::get('/contato', function(){
    return view('site.contato');
});

    // Criar Conta Cliente
Route::get('/criarconta', [ClientesController::class, 'formularioCadastroCliente'])->name('registrar');
Route::post('/criarconta', [ClientesController::class, 'registrarCliente'])->name('add_cli');

    // Login
Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('vld_login');

    // Carrinho
Route::get('/carrinho', [CarrinhoController::class, 'index']);
Route::post('/adicionar-produto', [CarrinhoController::class, 'adicionarProduto'])->name('add-produto');
Route::get('/aumentar-quantidade/{id}', [CarrinhoController::class, 'aumentarQuantidade'])->name('add-qte');
Route::get('/diminuir-quantidade/{id}', [CarrinhoController::class, 'diminuirQuantidade'])->name('rm-qte');
Route::get('/remover-produto/{id}', [CarrinhoController::class, 'removerProduto'])->name('rm-prod');
Route::get('/itens-carrinho', [CarrinhoController::class, 'contarItens']);

// FIM ROTAS SITE

// INICIO ROTAS PERFIL CLIENTE
Route::middleware([ClienteMiddleware::class])->group(function () {
    Route::get('/perfil',[DashboardController::class, 'index'])->name('home_cliente');
    
    Route::post('/perfil/logout', [AuthController::class, 'logout'])->name('logout_cliente');
    
    // Pagamento
    Route::get('/pagamento', [PagamentoController::class, 'pagamento'])->name('pagamento');
    Route::get('/pagamento-sucesso', [PagamentoController::class, 'redirectPeloStatusPagamento'])->name('success');
    Route::get('/pagamento-falha', [PagamentoController::class, 'redirectPeloStatusPagamento'])->name('failure');

    // Conta
    Route::get('/perfil/conta', [ClientesController::class, 'buscarInfo'])->name('minha-conta');
    Route::post('/perfil/conta', [ClientesController::class, 'alterarCliente'])->name('conta_alte');
    
    // Compras
    Route::get('/perfil/compras', [VendasController::class, 'index'])->name('compras');
});

// FIM ROTAS PERFIL CLIENTE

// INICIO ROTAS ADM
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/adm', [DashboardController::class, 'index'])->name('home_adm');

    Route::post('/adm/logout', [AuthController::class, 'logout'])->name('logout');
    
    //Usuários
    Route::get('/adm/usuarios', [UserAdminController::class, 'index'])->name('usuarios');
    Route::post('/adm/usuarios', [UserAdminController::class, 'buscarUsuario'])->name('usuarios_busca');
    Route::get('/adm/usuarios/novo', [UserAdminController::class, 'formularioCadastroAdministrador'])->name('user_novo');
    Route::post('/adm/usuarios/novo', [UserAdminController::class, 'registrarAdministrador'])->name('user_add');
    Route::get('/adm/usuarios/alterar/{id}', [UserAdminController::class, 'buscarAlteracaoAdm'])->name('user_alt');
    Route::post('/adm/usuarios/alterar/', [UserAdminController::class, 'alterarAdministrador'])->name('user_alte');;
    Route::get('/adm/usuarios/excluir/{id}', [UserAdminController::class, 'alterarStatus'])->name('user_del');
    
    //Secao
    Route::get('/adm/secoes', [SecaoController::class, 'index'])->name('secoes');
    Route::post('/adm/secoes', [SecaoController::class, 'buscarSecao'])->name('secoes_busca');
    Route::get('/adm/secoes/novo', [SecaoController::class, 'incluir'])->name('secoes_novo');
    Route::post('/adm/secoes/novo', [SecaoController::class, 'incluirSecao'])->name('secoes_novo');
    Route::get('/adm/secoes/alterar/{id}', [SecaoController::class, 'buscarAlteracao'])->name('secoes_alterar');
    Route::post('/adm/secoes/alterar/', [SecaoController::class, 'executarAlteracao'])->name('secoes_alt');;
    Route::get('/adm/secoes/excluir/{id}', [SecaoController::class, 'excluir'])->name('secoes_excluir');
    
    //Unidades de Medida
    Route::get('/adm/unidades-medidas', [UnidadesMedidasController::class, 'index'])->name('un-medidas');
    Route::post('/adm/unidades-medidas', [UnidadesMedidasController::class, 'buscarUnidade'])->name('uni_busca');
    Route::get('/adm/unidades-medidas/novo', [UnidadesMedidasController::class, 'incluir'])->name('uni_novo');
    Route::post('/adm/unidades-medidas/novo', [UnidadesMedidasController::class, 'incluirUnidade'])->name('uni_add');
    Route::get('/adm/unidades-medidas/alterar/{id}', [UnidadesMedidasController::class, 'buscarAlteracao'])->name('uni_alterar');
    Route::post('/adm/unidades-medidas/alterar', [UnidadesMedidasController::class, 'executarAlteracao'])->name('uni_alt');;
    Route::get('/adm/unidades-medidas/excluir/{id}', [UnidadesMedidasController::class, 'excluir'])->name('uni_excluir');
    
    //Produtos
    Route::get('/adm/produtos', [ProdutoController::class, 'index'])->name('produtos');
    Route::post('/adm/produtos', [ProdutoController::class, 'buscarProduto'])->name('produtos_busca');
    Route::get('/adm/produtos/novo', [ProdutoController::class, 'inserir'])->name('produtos_novo');
    Route::post('/adm/produtos/novo', [ProdutoController::class, 'incluirProduto'])->name('produtos_add');
    Route::get('/adm/produtos/alterar/{id}', [ProdutoController::class, 'alterar'])->name('produtos_alterar');
    Route::post('/adm/produtos/alterar', [ProdutoController::class, 'executarAlteracao'])->name('produtos_alt');;
    Route::get('/adm/produtos/excluir/{id}', [ProdutoController::class, 'excluir'])->name('produtos_excluir');
    
    //Clientes
    Route::get('/adm/clientes', [ClientesController::class, 'index'])->name('clientes');
    Route::post('/adm/clientes', [ClientesController::class, 'buscarCliente'])->name('cliente_busca');
    Route::get('/adm/clientes/alterar/{id}', [ClientesController::class, 'buscarAlteracaoCliente'])->name('cliente_alt');
    Route::post('/adm/clientes/alterar/', [ClientesController::class, 'alterarCliente'])->name('cliente_alte');
    Route::get('/adm/clientes/excluir/{id}', [ClientesController::class, 'alterarStatus'])->name('cliente_del');
    
    //Vendas
    Route::get('/adm/vendas', [VendasController::class, 'index'])->name('vendas');
});

// FIM ROTAS ADM