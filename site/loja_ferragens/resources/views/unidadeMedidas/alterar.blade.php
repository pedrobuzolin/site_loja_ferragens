@extends("layout_adm.index")
@section("conteudo")
    <div class="col-8">
        <div class="card mb-0">
            <div class="card-body">
                <form method="post" action="{{route('secoes_alt')}}" class="row g-3">
                    @csrf
                    <input type="hidden" name="id" value="{{$secao->id}}">
                    <div class="col-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" name="idSecao" id="idSecao" value="{{$secao->id}}" disabled>
                    </div>
                    <div class="col-12">
                        <label for="nomeSecao" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nomeSecao" id="nomeSecao" value="{{$secao->nomeSecao}}"required>
                    </div>
                    <div class="d-grid gap-2 col-3 mx-auto">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('secoes')}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop