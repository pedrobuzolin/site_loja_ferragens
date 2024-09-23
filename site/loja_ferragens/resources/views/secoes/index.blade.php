@extends("layout_adm.index")
@section("conteudo")
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h1 class="card-title">Lista de Seções</h1>
                    </div>
                    <div class=" col-4">
                        <input class="form-control" type="text" placeholder="Busque uma seção" />
                    </div>
                    <div class="col">
                        <a class="btn btn-warning">Buscar</a>
                    </div>
                </div>
                <div>
                    <a class="btn btn-success" href="/secoes-novo">Novo</a>
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
                            <tr>
                                <th class="text-center ps-0 fw-medium">1</th>
                                <td class="text-center fw-medium">Ferramentas</td>
                                <td class="text-center fw-medium">
                                    <a href="/secoes-alterar"><iconify-icon icon="ooui:recent-changes-ltr" width="1.2em" height="1.2em"></iconify-icon></a>
                                    <a href="/secoes-excluir"><iconify-icon icon="material-symbols:delete" width="1.2em" height="1.2em"></iconify-icon></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop