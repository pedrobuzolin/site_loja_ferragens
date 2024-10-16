@extends("layout_adm.index")
@section("conteudo_adm")
    <div class="col-8">
        <div class="card mb-0">
            <div class="card-body">
                <form method="post" action="{{route('uni_alt')}}" class="row g-3">
                    @csrf
                    <input type="hidden" name="id" value="{{$unidadeMedidas->id}}">
                    <div class="col-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" name="idUni" id="idUni" value="{{$unidadeMedidas->id}}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="uni_ativo" class="form-label">Ativo</label>
                        <select name="uni_ativo" id="uni_ativo" class="form-select">
                        <option value="{{$unidadeMedidas->uni_ativo}}"selected>
                            @if($unidadeMedidas->uni_ativo == "1")
                                SIM
                            @else
                                NÃO
                            @endif
                        </option>
                        <option value="1">SIM</option>
                        <option value="0">NÃO</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="unidadeMedida" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="unidadeMedida" id="unidadeMedida" value="{{$unidadeMedidas->unidadeMedida}}"required>
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