@extends("layout_adm.index")
@section("conteudo")
    <div class="col-8">
        <div class="card mb-0">
            <div class="card-body">
                <form method="POST" action="{{route("produtos_add")}}" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                    </div>
                    <div class="col-12">
                        <label for="descricaoProduto" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="descricaoProduto" id="descricaoProduto">
                    </div>
                    <div class="col-md-6">
                        <label for="idSecao" class="form-label">Seção</label>
                        <select name="idSecao" id="idSecao" class="form-select" required>
                        <option selected>Escolha uma Seção</option>
                        @foreach ($secao as $sec)
                            <option value="{{$sec->id}}">{{$sec->id}} - {{$sec->nomeSecao}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="estoque" class="form-label">Estoque</label>
                        <input type="text" class="form-control" name="estoque" id="estoque" required>
                    </div>
                    <div class="col-md-4">
                        <label for="idUniMedida" class="form-label">Unidade de Medida</label>
                        <select name="idUniMedida" id="idUniMedida" class="form-select" required>
                        <option selected>Escolha uma Unidade de Medida</option>
                        @foreach ($unidadeMedidas as $uni)
                            <option value="{{$uni->id}}">{{$uni->id}} - {{$uni->unidadeMedida}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="form-control" name="preco" id="preco" required>
                    </div>
                    <div class="col-md-4">
                        <label for="produto_destaque" class="form-label">Destaque</label>
                        <select name="produto_destaque" id="produto_destaque" class="form-select">
                        <option selected>Escolha...</option>
                        <option value="1">SIM</option>
                        <option value="0">NÃO</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Escolha a foto do produto</label>
                        <input class="form-control" type="file" name="imagem" id="imgem" required>
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