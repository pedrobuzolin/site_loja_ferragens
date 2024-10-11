@extends("layout_adm.index")
@section("conteudo")
    <div class="col-8">
        <div class="card mb-0">
            <div class="card-body">
                <form method="POST" action="{{route('uni_add')}}" class="row g-3">
                    @csrf
                    <input type="hidden" name="uni_ativo" id="uni_ativo" value="1">
                    <div class="col-12">
                        <label for="unidadeMedida" class="form-label">Unidade Medida</label>
                        <input type="text" class="form-control" name="unidadeMedida" id="unidadeMedida" required>
                    </div>
                    <div class="d-flex gap-2 col-3 mx-auto">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('un-medidas')}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop