@extends("layout_adm.index")
@section("conteudo")
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h1 class="card-title">Lista de Produtos</h1>
                    </div>
                    <div class=" col-6">
                        <input class="form-control" type="text" placeholder="Busque um produto" />
                    </div>
                    <div class="col">
                        <a class="btn btn-warning">Buscar</a>
                    </div>
                </div>
                <div>
                    <a class="btn btn-success" href="{{route('produtos_novo')}}">Novo</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                        <thead>
                            <tr class="border-2 border-bottom border-primary border-0"> 
                                <th scope="col" class="text-center ps-0">ID</th>
                                <th scope="col" class="text-center">Foto</th>
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Unidade</th>
                                <th scope="col" class="text-center">Estoque</th>
                                <th scope="col" class="text-center">Preço</th>
                                <th scope="col" class="text-center">Destaque</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach ($produtos as $linha)
                            <tr>
                                <th class="text-center ps-0 fw-medium">{{$linha->id}}</th>
                                <td class="text-center fw-medium col-2">                                                   
                                    @if($linha->imagens)
                                        <img src="{{$linha->imagens->first()->linkImagem}}" class="img-fluid w-50 rounded-top" alt="">
                                    @endif</td>
                                <td class="text-center fw-medium">{{$linha->nome}}</td>
                                <td class="text-center fw-medium">{{$linha->unidadeMedida}}</td>
                                <td class="text-center fw-medium">{{$linha->estoque}}</td>
                                <td class="text-center fw-medium">{{$linha->preco}}</td>
                                <td class="text-center fw-medium">                            
                                    @if($linha->produto_destaque == 0)
                                        NÃO
                                    @else
                                        SIM
                                    @endif
                                </td>
                                <td class="text-center fw-medium">
                                    <a href="{{route('produtos_alterar', ["id" => $linha->id])}}"><iconify-icon icon="ooui:recent-changes-ltr" width="1.2em" height="1.2em"></iconify-icon></a>
                                    <a href="{{route('produtos_excluir', ["id" => $linha->id])}}"><iconify-icon icon="material-symbols:delete" width="1.2em" height="1.2em"></iconify-icon></a>
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