@extends("layout_adm.index")
@section("conteudo_adm")
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h1 class="card-title">Lista de Produtos</h1>
                    </div>
                    <form class="row mb-3" action="{{ route('produtos_busca') }}" method="POST">
                        @csrf
                        <div class="col-4">
                            <label class="form-label">Ativo</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="produto_ativo" id="produto_ativo1"
                                    value="1" checked>
                                <label class="form-check-label" for="inlineRadio1">SIM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="produto_ativo" id="produto_ativo2"
                                    value="0">
                                <label class="form-check-label" for="inlineRadio2">NÃO</label>
                            </div>
                        </div>
                        <div class=" col-6 mt-3">
                            <input class="form-control" type="text" name="buscar" id="buscar"
                                placeholder="Busque um produto" />
                        </div>
                        <div class="col-2 mt-3">
                            <button type="submit" class="btn btn-warning">Buscar</a>
                        </div>
                    </form>
                </div>
                <div>
                    <a class="btn btn-success" href="{{route('produtos_novo')}}">Novo</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0" id="datatablesSimple">
                        <thead>
                            <tr class="border-2 border-bottom border-primary border-0"> 
                                <th scope="col" class="text-center ps-0">ID</th>
                                <th scope="col" class="text-center">Foto</th>
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Seção</th>
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
                                        <img src="{{$linha->imagens->first()->urlImagem}}" class="img-fluid w-50 rounded-top" alt="">
                                    @endif</td>
                                <td class="text-start fw-medium">{{$linha->nome}}</td>
                                <td class="text-start fw-medium">{{$linha->secao->nomeSecao}}</td>
                                <td class="text-center fw-medium">R$ {{number_format($linha->preco, '2', ',', '.')}}</td>
                                <td class="text-center fw-medium">                            
                                    @if($linha->produto_destaque == 1)
                                        SIM
                                    @else
                                        NÃO
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