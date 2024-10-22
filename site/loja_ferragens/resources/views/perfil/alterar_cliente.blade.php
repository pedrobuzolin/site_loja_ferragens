@extends("layout_cliente.index")
@section("conteudo_cliente")
    <div class="col-md-8 col-lg-8 col-xxl-3">
        <div class="card mb-0">
            <div class="card-body">
                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                    <img src="/layout_adm/images/logos/logo_preta.svg" alt="" style="width: 100px; height: 100px;">
                </a>
                <div class="row justify-content-center mb-3">
                    <h2 class="text-center">Alterar minhas Informações</h2>
                </div>
                <form method="POST" action="{{ route('conta_alte') }}" class="row g-3">
                    <input type="hidden" name="idCliente" id="idCliente" value="{{$cliente->id}}">
                    <input type="hidden" name="idUsuario" id="idUsuario" value="{{$cliente->id_user}}">
                    <input type="hidden" name="idEndereco" id="idEndereco" value="{{$cliente->endereco->id}}">
                    @csrf
                    <h5>Informações do Usuário</h5>
                    <div class="col-md-4">
                        <label for="name" class="form-label">Nome de Usuário</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="nome"
                            value="{{ $cliente->user->name }}">
                    </div>
                    <div class="col-md-8">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email"
                            aria-describedby="emailHelp" value="{{ $cliente->user->email }}">
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Nova senha (deixe em branco para não alterar a senha)</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirme a nova senha</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                    <h5>Informações Pessoais</h5>
                    <div class="col-md-12">
                        <label for="nome_cliente" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" name="nome_cliente" id="nome_cliente"
                            aria-describedby="nome" value="{{ $cliente->nome_cliente }}">
                    </div>
                    <div class="col-md-6">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="cpf" aria-describedby="nome"
                            size="11" value="{{ $cliente->cpf }}">
                    </div>
                    <div class="col-md-6">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control" name="celular" id="celular" aria-describedby="nome"
                            size="11" value="{{ $cliente->celular }}">
                    </div>
                    <h6>Endereço</h6>
                    <div class="col-md-4">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep" size="10"
                            maxlength="9" aria-describedby="nome" value="{{ $cliente->endereco->cep }}">
                    </div>
                    <div class="col-md-9">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" name="rua" id="rua" aria-describedby="nome"
                            value="{{ $cliente->endereco->rua }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" name="numero" id="numero" aria-describedby="nome"
                            value="{{ $cliente->endereco->numero }}">
                    </div>
                    <div class="col-md-12">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" name="complemento" id="complemento"
                            aria-describedby="nome" value="{{ $cliente->endereco->complemento }}">
                    </div>
                    <div class="col-md-12">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro"
                            aria-describedby="nome" value="{{ $cliente->endereco->bairro }}" readonly>
                    </div>
                    <div class="col-md-10">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade"
                            aria-describedby="nome" value="{{ $cliente->endereco->cidade }}" readonly>
                    </div>
                    <div class="col-md-2 mb-4">
                        <label for="uf" class="form-label">UF</label>
                        <input type="text" class="form-control" name="uf" id="uf"
                            aria-describedby="nome" value="{{ $cliente->endereco->uf }}" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Alterar</button>
                    <a href="{{ route('home_cliente') }}" class="btn btn-danger w-100 py-8 fs-4 mb-4">Voltar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
