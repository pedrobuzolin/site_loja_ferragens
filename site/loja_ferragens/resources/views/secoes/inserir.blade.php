@extends("layout_adm.index")
@section("conteudo")
    <div class="col-8">
        <div class="card mb-0">
            <div class="card-body">
                <form method="POST" action="{{route('secoes_novo')}}" class="row g-3">
                    @csrf
                    <input type="hidden" name="secao_ativo" id="secao_ativo" value="1">
                    <div class="col-12">
                        <label for="nomeSecao" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nomeSecao" id="nomeSecao" required>
                    </div>
                    <div class="d-flex gap-2 col-3 mx-auto">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('secoes')}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop