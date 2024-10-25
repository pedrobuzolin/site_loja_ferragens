@extends("layout_adm.index")
@section("conteudo_adm")
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-2">
                        <h1 class="card-title">Listagem de Clientes</h1>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                        <thead>
                            <tr class="border-2 border-bottom border-primary border-0"> 
                                <th scope="col" class="text-center ps-0">ID</th>
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($clientes as $linha)
                                <tr>
                                    <th class="text-center ps-0 fw-medium">{{ $linha->id }}</th>
                                    <td class="text-center fw-medium">{{ $linha->nome_cliente }}</td>
                                    <td class="text-center fw-medium">
                                        <a href="{{ route('cliente_alt', ['id' => $linha->id]) }}"><iconify-icon
                                                icon="ooui:recent-changes-ltr" width="1.2em"
                                                height="1.2em"></iconify-icon></a>
                                        <a href="{{ route('cliente_del', ['id' => $linha->id]) }}"><iconify-icon
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