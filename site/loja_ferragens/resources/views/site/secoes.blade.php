@extends('layout_site.index')

@section('conteudo')
    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite produtos py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-8 text-start">
                        @if ($secao)
                            <h1>{{ $secao->nomeSecao }}</h1>
                        @endif
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            @foreach ($produtos as $linha)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            @if ($linha->imagens)
                                                <img src="{{ $linha->imagens->first()->linkImagem }}"
                                                    class="img-fluid w-100 rounded-top" alt="{{ $linha->nome }}">
                                            @endif
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                            style="top: 10px; left: 10px;">{{ $secao->nomeSecao }}</div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>{{ $linha->nome }}</h4>
                                            <p>{{ $linha->descricaoProduto }}</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">R${{ $linha->preco }}/
                                                    {{ $linha->unidadeMedida }}</p>
                                                <input type="number" name="quantidade" id="quantidade"
                                                    class="form-control col-2 mt-2 mb-2" />
                                                <a href="#"
                                                    class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                        class="fa fa-shopping-bag me-2 text-primary"></i> Comprar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@stop
