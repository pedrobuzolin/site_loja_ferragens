@extends('layout_adm.index')
@section('conteudo_adm')
    <div class="card mb-0 col-6">
        <div class="card-body">
            <h4>Alteração de Usuário</h4>
            <form method="POST" action="{{route('user_alte')}}">
                @csrf
                <input type="hidden" name="id" id="id" value="{{$usuario->id}}">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" id="name"
                        value="{{$usuario->name}}" aria-describedby="nome">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$usuario->email}}" aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="password" id="password" value="{{$usuario->password}}">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirme a Senha</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{$usuario->password}}">
                </div>
                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Alterar Conta</button>
                <a href="{{route('usuarios')}}" class="btn btn-danger w-100 py-8 fs-4 mb-4">Voltar</a>
            </form>
        </div>
    </div>
@endsection
