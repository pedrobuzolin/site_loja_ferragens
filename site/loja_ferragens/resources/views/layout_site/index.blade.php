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
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Avenida Coronel Clementino Gonçalves, 521, Santa Cruz do Rio Pardo - SP</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">casaedlin@casaedlin.com.br</a></small>
                        <small class="me-3"><i class="fab fa-whatsapp me-2 text-secondary"></i><a href="#" class="text-white">(14) 99835-4236</a></small>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-dark-blue navbar-expand-xl">
                    <a href="home" class="navbar-brand"><img width="80px" height="80px" src="/layout_site/img/logobranca.svg"></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-dark-blue" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="/" class="nav-item nav-link active">Home</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Produtos</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="automotivo" class="dropdown-item">Automotivo</a>
                                    <a href="eletrica" class="dropdown-item">Material Elétrico</a>
                                    <a href="ferragens" class="dropdown-item">Ferragens</a>
                                    <a href="ferramentasEletricas" class="dropdown-item">Ferramentas Elétricas</a>
                                    <a href="ferramentasManuais" class="dropdown-item">Ferramentas Manuais</a>
                                    <a href="gastronomia" class="dropdown-item">Gastronomia</a>
                                    <a href="hidraulica" class="dropdown-item">Material Hidráulico</a>
                                    <a href="jardinagem" class="dropdown-item">Jardinagem / Agrícola</a>
                                    <a href="lazer" class="dropdown-item">Lazer</a>
                                    <a href="marcenaria" class="dropdown-item">Marcenaria</a>
                                    <a href="parafusos" class="dropdown-item">Parafusos e Fixação</a>
                                    <a href="seguranca" class="dropdown-item">Segurança e Acessórios</a>
                                    <a href="tintas" class="dropdown-item">Tintas e Acessórios</a>
                                    <a href="utilidades" class="dropdown-item">Utilidades Domésticas</a>
                                </div>
                            </div>
                            <a href="quemSomos" class="nav-item nav-link">Quem Somos</a>
                            <a href="contato" class="nav-item nav-link">Contato</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <input class="me-4 input-pesquisa" placeholder="Busque um produto"/>
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-dark-blue me-4"><i class="fas fa-search text-white"></i></button>    
                        </div>
                        <div class="d-flex  m-3 me-0">
                            <a href="carrinho" class="position-relative me-4 my-auto">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -8px; left: 25px; height: 20px; min-width: 20px;">3</span>
                            </a>
                            <a href="login" class="my-auto">
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
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">PHSoftware</a> Distributed By <a class="border-bottom" href="https://themewagon.com">PHSoftware</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/layout_site/lib/easing/easing.min.js"></script>
    <script src="/layout_site/lib/waypoints/waypoints.min.js"></script>
    <script src="/layout_site/lib/lightbox/js/lightbox.min.js"></script>
    <script src="/layout_site/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/layout_site/js/main.js"></script>
    </body>

</html>