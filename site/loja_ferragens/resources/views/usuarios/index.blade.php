@extends('layout_adm.index')
@section('conteudo_adm')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h1 class="card-title">Lista de Usuários</h1>
                    </div>
                <div>
                    <a class="btn btn-success" href="{{ route('user_novo') }}">Novo</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0" id="datatablesSimple">
                        <thead>
                            <tr class="border-2 border-bottom border-primary border-0">
                                <th scope="col" class="text-center ps-0">ID</th>
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($usuario as $linha)
                                <tr>
                                    <th class="text-center ps-0 fw-medium">{{ $linha->id }}</th>
                                    <td class="text-center fw-medium">{{ $linha->name }}</td>
                                    <td class="text-center fw-medium">
                                        <a href="{{ route('user_alt', ['id' => $linha->id]) }}"><iconify-icon
                                                icon="ooui:recent-changes-ltr" width="1.2em"
                                                height="1.2em"></iconify-icon></a>
                                        <a href="{{ route('user_del', ['id' => $linha->id]) }}"><iconify-icon
                                                icon="material-symbols:delete" width="1.2em"
                                                height="1.2em"></iconify-icon></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
