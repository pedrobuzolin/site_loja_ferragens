@extends("layout_adm.index")
@section("conteudo")
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h1 class="card-title">Lista de Unidades</h1>
                    </div>
                    <div class=" col-4">
                        <input class="form-control" type="text" placeholder="Busque uma seção" />
                    </div>
                    <div class="col">
                        <a class="btn btn-warning">Buscar</a>
                    </div>
                </div>
                <div>
                    <a class="btn btn-success" href="{{route('uni_novo')}}">Novo</a>
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
                            @foreach ($unidadeMedidas as $linha)
                            <tr>
                                <th class="text-center ps-0 fw-medium">{{$linha->id}}</th>
                                <td class="text-center fw-medium">{{$linha->unidadeMedida}}</td>
                                <td class="text-center fw-medium">
                                    <a href="{{route('uni_alterar', ["id" => $linha->id])}}"><iconify-icon icon="ooui:recent-changes-ltr" width="1.2em" height="1.2em"></iconify-icon></a>
                                    <a href="{{route('uni_excluir', ["id" => $linha->id])}}"><iconify-icon icon="material-symbols:delete" width="1.2em" height="1.2em"></iconify-icon></a>
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