@extends('layout_adm.index')
@section('conteudo_adm')
    <div class="card mb-0 col-6">
        <div class="card-body">
            <h4>Cadastro de Usuário</h4>
            <form method="POST" action="{{route('user_add')}}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" id="name"
                        aria-describedby="nome">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirme a Senha</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Criar Conta</button>
                <a href="{{route('usuarios')}}" class="btn btn-danger w-100 py-8 fs-4 mb-4">Voltar</a>
            </form>
        </div>
    </div>
@endsection
