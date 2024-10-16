@extends('layout_adm.topo_rodape')
@section('conteudo')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="/layout_adm/images/logos/logo_preta.svg" alt=""
                                        style="width: 100px; height: 100px;">
                                </a>
                                <h4>Cadastro de Cliente</h4>
                                <form method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nome_cliente" class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="nome_cliente" id="nome_cliente"
                                            aria-describedby="nome">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Senha</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Criar
                                        Conta</button>
                                    <a href="login" class="btn btn-danger w-100 py-8 fs-4 mb-4">Voltar</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
