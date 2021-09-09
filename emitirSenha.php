<!DOCTYPE html>
<html>
<?php
require 'controllers/EventoController.php';
session_start();
if(!isset($_SESSION['user'])){
    header("location: index.php");
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Emissão de Senhas</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/icon.ico" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
</head>

<body>
  <!-- Sidenav -->
  <?php include 'menu.php'; ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center ml-md-auto " style="margin-left: 50%">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['user'][0][1] ?></span>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-5 text-left">
              <h2 class="text-white">Emissão de Senhas</h2>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <button data-toggle="modal" data-target="#modalSenha" class="btn btn-sm btn-neutral">Novo Lote</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt-2">
      <div class="row">
        <div class="col-12">
          <table id="myTable" class="table align-items-center table-flush" style="width:100%">
            <thead>
              <tr>
                <th>Evento</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Atrações</th>
                <th>Qtd. Lotes emitidos</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $eventos = new EventoController();
                  foreach($eventos->listar() as $evento){
                ?>
                <tr>
                  <td><?=$evento[1]?></td>
                  <td><?=date('d/m/Y', strtotime($evento[3]))?></td>
                  <td><?=$evento[4]?></td>
                  <td><?=$evento[2]?></td>
                  <td><?=$evento[6]?></td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="modalSenha" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Nova Senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="controllers/LoteController.php" method="POST">
      <input type="hidden" name="cadastrar" value="1">
        <div class="modal-body">
          <div class="row">
            <div class="col-12 form-group">
              <label for="">Evento:</label><br>
              <select class="form-control" name="evento" id="evento">
                  <option value="">Selecione...</option>
                    <?php 
                        $eventos = new EventoController();
                        foreach($eventos->listarTodos() as $evento){
                    ?>
                    <option value="<?=$evento[0]?>"><?=$evento[1]?></option>
                    <?php } ?>
              </select>
            </div>

            <div class="col-12 form-group">
              <label for="">Quantidade de Senha:</label><br>
              <input type="number" name="qtd_senhas" id="" class="form-control" required>
            </div>

            <div class="col-12 form-group">
              <label for="">Valor: </label><br>
              <input type="text" name="valor" id="" class="form-control" required>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
  <?php
    if(isset($_SESSION['msg'])){
  ?>
  <script>
    Swal.fire({
      "title": "<?=$_SESSION['msg']['title']?>",
      "text": "<?=$_SESSION['msg']['text']?>",
      "icon": "<?=$_SESSION['msg']['icon']?>",
    });
  </script>
  <?php unset($_SESSION['msg']); } ?>
  <script>
    $(document).ready( function () {
      $('#myTable').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
      }
      } );
    } );    
  </script>
</body>

</html>
