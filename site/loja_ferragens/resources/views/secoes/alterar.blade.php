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
                    <div class="d-grid gap-2 col-3 mx-auto">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="/secoes" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop