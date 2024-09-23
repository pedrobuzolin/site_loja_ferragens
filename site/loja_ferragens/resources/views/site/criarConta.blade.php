<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Casa EDLIN</title>
  <link rel="shortcut icon" type="image/png" href="/layout_adm/images/logos/icone.ico" />
  <link rel="stylesheet" href="/layout_adm/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="/layout_adm/images/logos/logo_preta.svg" alt="" style="width: 100px; height: 100px;">
                </a>
                <form method="post" >
                    <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="senha" class="form-control" id="senha">
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Criar Conta</button>
                  <a href="login" class="btn btn-danger w-100 py-8 fs-4 mb-4">Voltar</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="/layout_adm/libs/jquery/dist/jquery.min.js"></script>
  <script src="/layout_adm/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>