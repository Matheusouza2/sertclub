<!DOCTYPE html>
<html>
<?php
require 'controllers/LoteController.php';
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Gerenciar Lotes</title>
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
              <h2 class="text-white">Gerenciar Lotes</h2>
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
                <th>Valor do Lote</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $lotes = new LoteController();
                  foreach($lotes->listarTodos() as $lote){
                ?>
                <tr>
                  <td><?=$lote[7]?></td>
                  <td><?=date('d/m/Y', strtotime($lote[9]))?></td>
                  <td><?=$lote[10]?></td>
                  <td><?=$lote[2]?></td>
                  <td>R$ <?=$lote[3]?></td>
                  <td><?php if($lote[5] == 1){ ?>
                        <button class="btn btn-sm btn-danger" title="Encerar Lote" onclick="encerrarLote(<?=$lote[0]?>)"><i class="fad fa-ban"></i></button>
                        <?php }?>
                </td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
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
    function encerrarLote(id){
        Swal.fire({
            "title": "O lote será encerrado",
            "text": "Tem certeza que deseja encerrar esse lote, a ação no pode ser desfeita.",
            "icon": "warning",
            "confirmButtonText": "Sim",
            "showCancelButton": true,
            "cancelButtonText" : "Não"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "controllers/LoteController.php?loteId="+id,
                    dataType: "json",
                    success: function(data){
                        Swal.fire({
                            "title": "Lote Encerrado",
                            "text": "O lote foi marcado como encerrado !",
                            "icon": "success"
                        });
                    },
                    error: function(data){
                        Swal.fire({
                            "title": "Lote Encerrado",
                            "text": "O lote foi marcado como encerrado !",
                            "icon": "success"
                        });
                    }
                });
            }
        });
    } 
  </script>
</body>

</html>