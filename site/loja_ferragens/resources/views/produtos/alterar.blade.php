@extends("layout_adm.index")
@section("conteudo")
    <div class="col-8">
        <div class="card mb-0">
            <div class="card-body">
                <form method="POST" action="{{route("produtos_alt")}}" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <input type="hidden" class="form-control" name="id" id="id" value="{{$produto->id}}">
                    <div class="col-3">
                        <label for="idProduto" class="form-label">ID</label>
                        <input type="text" class="form-control" name="idProduto" id="idProduto" value="{{$produto->id}}" disabled>
                    </div>
                    <div class="col-12">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{$produto->nome}}" required>
                    </div>
                    <div class="col-12">
                        <label for="descricaoProduto" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="descricaoProduto" id="descricaoProduto" value="{{$produto->descricaoProduto}}">
                    </div>
                    <div class="col-md-6">
                        <label for="idSecao" class="form-label">Seção</label>
                        <select name="idSecao" id="idSecao" class="form-select" required>
                        <option selected value="{{$produto->idSecao}}">{{$produto->idSecao}} - {{$produto->secao->first()->nomeSecao}}</option>
                        @foreach ($secao as $sec)
                        <option value="{{$sec->id}}">{{$sec->id}} - {{$sec->nomeSecao}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="estoque" class="form-label">Estoque</label>
                        <input type="text" class="form-control" name="estoque" id="estoque" value="{{$produto->estoque}}"required>
                    </div>
                    <div class="col-md-4">
                        <label for="unidade" class="form-label">Unidade de Medida</label>
                        <select name="unidade" id="unidade" class="form-select" required>
                        <option selected value="{{$produto->unidadeMedida}}">{{$produto->unidadeMedida}}</option>
                        <option>UN</option>
                        <option>KG</option>
                        <option>M</option>
                        <option>CT</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="form-control" name="preco" id="preco" value="{{$produto->preco}}" required>
                    </div>
                    <div class="mt-2">
                        <p>Imagem atual</p>
                        <img src="{{$produto->imagens->first()->linkImagem}}" alt="{{$produto->nome}}" width="100">
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Escolha uma nova foto do produto (Opcional)</label>
                        <input class="form-control" type="file" name="imagem" id="imgem">
                    </div>
                    <div class="d-grid gap-2 col-3 mx-auto">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route("produtos")}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop