<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <title>Casa EDLIN</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Ferramentas Manuais, Ferramentas Elétricas, Gastronomia, Utilidades, Material Hidráulico e Elétrico, Jardinagem" name="keywords">
        <meta content="Onde a especialidade é a variedade!" name="description">
        <link rel="shortcut icon" href="/layout_site/img/icone.ico" type="image/x-icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="/layout_site/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="/layout_site/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="/layout_site/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="/layout_site/css/style.css" rel="stylesheet">
        
        <!-- Carrossel -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-dark-blue position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a class="text-white">Avenida Coronel Clementino Gonçalves, 521, Santa Cruz do Rio Pardo - SP</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a class="text-white">casaedlin@casaedlin.com.br</a></small>
                        <small class="me-3"><i class="fab fa-whatsapp me-2 text-secondary"></i><a href="https://wa.me/message/MT4TWVBLSKXDE1" class="text-white">(14) 99835-4236</a></small>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-dark-blue navbar-expand-xl">
                    <a href="/" class="navbar-brand"><img width="80px" height="80px" src="/layout_site/img/logobranca.svg"></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-dark-blue" id="navbarCollapse">
                        <div class="navbar-nav">
                            <a href="/" class="nav-item nav-link active">Home</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Produtos</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    @foreach ($secoes as $linha)
                                        <a href="{{route('secoes_exibir', ["secao" => $linha->nomeSecao])}}" class="dropdown-item">{{$linha->nomeSecao}}</a>
                                    @endforeach
                                    

                                </div>
                            </div>
                            <a href="/contato" class="nav-item nav-link">Contato</a>
                        </div>
                        <form class="d-flex me-4 col-7" method="POST" action="{{route('pesquisa_exibir')}}">
                            @csrf
    
                                <input name="buscar" id="buscar" type="search" class="ms-3 me-2 form-control" placeholder="Busque um produto"/>
                                <button type="submit" class="btn-search btn border border-secondary btn-md-square rounded-circle bg-dark-blue me-4"><i class="fas fa-search text-white"></i></button>    

                        </form>
                        <div class="d-flex  m-3 me-0">
                            <a href="/carrinho" class="position-relative me-4 my-auto">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                                <span id="carrinho_itens" class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -8px; left: 25px; height: 20px; min-width: 20px;">0</span>
                            </a>
                            <a href="/login" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        @yield("conteudo")
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Casa EDLIN</a>, Todos os direitos reservados.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom" href="#">PHSoftware</a> Distributed By <a class="border-bottom" href="#">PHSoftware</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   
        <a href="https://wa.me/message/MT4TWVBLSKXDE1" class="btn btn-primary border-3 border-primary rounded-circle whatsapp"><i class="fab fa-whatsapp fa-lg text-white"></i></a>  
        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/layout_site/lib/easing/easing.min.js"></script>
    <script src="/layout_site/lib/waypoints/waypoints.min.js"></script>
    <script src="/layout_site/lib/lightbox/js/lightbox.min.js"></script>
    <script src="/layout_site/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/layout_site/js/main.js"></script>
    <script src="/layout_site/js/carrinho.js"></script>
    </body>

</html>