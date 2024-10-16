@extends("layout_adm.index")
@section("conteudo_adm")
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="col-12">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="endereco" required>
                    </div>
                    <div class="col-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" required>
                    </div>
                    <div class="col-6">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celular" required>
                    </div>
                    <div class="d-grid gap-2 col-3 mx-auto">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="/clientes" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop