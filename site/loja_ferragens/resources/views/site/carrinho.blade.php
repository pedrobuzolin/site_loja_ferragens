@extends('layout_site.index')
@section('conteudo')


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5 mt-4">
                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Produtos</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Total</th>
                            <th scope="col">Remover</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($carrinho as $produto)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{$produto["urlImg"]}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$produto["nome"]}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{$produto["preco"]}}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <a href="{{route('rm-qte', ["id" => $produto['id']])}}" class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                            </a>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0" value="{{$produto['quantidade']}}" disabled>
                                        <div class="input-group-btn">
                                            <a href="{{route('add-qte', ["id" => $produto['id']])}}" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{$produto["subtotal"]}}</p>
                                </td>
                                <td>
                                    <a href="{{route('rm-prod', ["id" => $produto['id']])}}" class="btn btn-md rounded-circle bg-light border mt-4" >
                                        <i class="fa fa-times text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Total <span class="fw-normal">Carrinho</span></h1>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4">{{$total}}</p>
                            </div>
                            <a href="#" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Ir para Pagamento</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->

@stop