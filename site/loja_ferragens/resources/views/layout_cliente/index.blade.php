@extends("layout_adm.topo_rodape")
@section("conteudo")

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
          <a href="/adm" class="text-nowrap logo-img">
            <img src="/layout_adm/images/logos/logo_preta.svg" alt="" style="width: 80px; height: 80px;" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">Consultas</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('minha-conta')}}" aria-expanded="false">
                <span>
                    <iconify-icon icon="material-symbols:person" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Minha Conta</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('compras')}}" aria-expanded="false">
                <span>
                    <iconify-icon icon="mdi:cart-sale" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Compras</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="/layout_adm/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Minha Conta</p>
                    </a>
                    <a href="{{route('logout_cliente')}}" class="mx-3 mt-2 d-block">
                      <form action="{{ route('logout_cliente') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary mx-3 mt-2 d-block">Sair</button>
                      </form>
                    </a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="row">
            @yield("conteudo_cliente")
        </div>
      </div>
@endsection