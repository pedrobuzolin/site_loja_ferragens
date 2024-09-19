@extends("layout_adm.index")
@section("conteudo")
    <div class="col-8">
        <div class="card mb-0">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" disabled>
                    </div>
                    <div class="col-md-3 row align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ativo" checked>
                            <label class="form-check-label" for="ativo">
                                Ativo
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" required>
                    </div>
                    <div class="col-12">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao">
                    </div>
                    <div class="col-md-6">
                        <label for="secao" class="form-label">Seção</label>
                        <select id="secao" class="form-select" required>
                        <option selected>Escolha</option>
                        <option>...</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="estoque" class="form-label">Estoque</label>
                        <input type="text" class="form-control" id="estoque" required>
                    </div>
                    <div class="col-md-4">
                        <label for="unidade" class="form-label">Unidade de Medida</label>
                        <select id="unidade" class="form-select" required>
                        <option selected>Escolha...</option>
                        <option>...</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="form-control" id="preco" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Escolha a foto do produto</label>
                        <input class="form-control" type="file" id="foto" required>
                    </div>
                    <div class="d-grid gap-2 col-3 mx-auto">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop