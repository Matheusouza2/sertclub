<!DOCTYPE html>
<html>
<?php
require 'controllers/LoteController.php';
require 'vendor/autoload.php';
if(!isset($_SESSION['user'])){
    header("location: index.php");
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Portaria</title>
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
  <style>
      .eventoName{
        color:#fff;
        margin: 0;
        position:relative;
        bottom:340px;
        left:20px;
        font-size: 32pt;
        font-size: 2vw
      }
      .eventoNameRot{
        color: #fff;
        position: relative;
        bottom: -50px;
        left:130px;
        font-size: 24px;
        font-size: 1vw;
      }
      .artistasRot{
        color:#f12b76;
        margin: 0;
        position:relative;
        bottom:-50px;
        left:130px;
        font-size: 16pt;
        font-size: 0.8vw;
      }
      .data{
        color:#fff;
        margin: 0;
        position:relative;
        bottom:340px;
        left:20px;
        font-size: 20pt;
      }
      .dataRot{
        color:#ffffff;
        margin: 0;
        position:relative;
        bottom:-100px;
        left:130px;
        font-size: 16pt;
      }
      .local{
        color:#f12b76;
        margin: 0;
        position:relative;
        bottom:340px;
        left:20px;
        font-size: 20pt;
      }
      .localRot{
        color:#f12b76;
        margin: 0;
        position:relative;
        bottom:-100px;
        left:130px;
        font-size: 16pt;
      }
      .cod-barras{
        margin: 0;
        position:relative;
        bottom:320px;
        left:40px;
        font-size: 24pt;
        font-size: 1vw;
      }
      .canhoto{
        transform: rotate(-270deg);
        margin: 0;
      }
      .titleArtista{
        margin:0;
        position:relative;
        bottom:340px;
        left: 25px;
        color:#fff;
        background-color: #000;
      }
      .titleHora{
        margin:0;
        position:relative;
        bottom:340px;
        left: 25px;
        color:#fff;
        background-color: #000;
      }
      .titleLocal{
        margin:0;
        position:relative;
        bottom:340px;
        left: 25px;
        color:#fff;
        background-color: #000;
      }
      .artistas{
        color:#f12b76;
        margin: 0;
        position:relative;
        bottom:340px;
        left:20px;
        font-size: 16pt;
        font-size: 1.5vw;
      }
      .cod-bilhete{
        color: #fff;
        position:relative;
        bottom: 425px;
        left: 680px;
        font-size: 11pt;
        font-weight: bold;
      }
    </style>
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
              <h2 class="text-white">Portaria</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-12">
                <label for="">Código de Barras da Senha</label>
                <input type="number" name="cod_barras" class="form-control" id="cod_barras">
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-6">
                <img src="assets/img/bilhete.png" width="850px" class="img-fluid" alt="">
                <h4 class="eventoName"></h4>
                <small class='titleArtista'>ATRAÇÕES</small>
                <pre class='artistas'></pre>
                <small class='titleHora'>HORÁRIO</small>
                <h4 class='data'></h4>
                <small class='titleLocal'>LOCAL</small>
                <h4 class='local'></h4>
                <h4 class='cod-barras text-green'></h4>
      
                <div class='canhoto'>
                    <h4 class='eventoNameRot'></h4>
                    <pre class='artistasRot'></pre>
                    <h4 class='dataRot'></h4>
                    <h4 class='localRot'></h4> 
                </div>
                <h4 class='cod-bilhete'></h4>
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
      $('#cod_barras').focus();
    document.addEventListener("keypress", function(e) {
        if(e.key === 'Enter') {
            var cod_barras = $('#cod_barras').val();
            if(cod_barras.length > 0){
                $('.cod-barras').text('');
                $.ajax({
                    url: "controllers/LoteController.php?cod_barras="+cod_barras,
                    dataType: "json",
                    success: function(data){
                        if(!data){
                            Swal.fire({
                                "title": "Senha Invalida",
                                "text": "Não foi localizada essa senha no sistema",
                                "icon": "error",
                            });
                            return;        
                        }
                        console.log(data);
                        $('.eventoName').text(data.nome);
                        $('.eventoNameRot').text(data.nome);
                        $('.artistas').text(data.atracoes);
                        $('.artistasRot').text(data.atracoes);
                        $('.data').text(data.data.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1')+' '+data.hora);
                        $('.dataRot').text(data.data.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1')+' '+data.hora);
                        $('.local').text(data.local);
                        $('.localRot').text(data.local);
                        $('.cod-bilhete').text(data.cod_barras);
                        $('.cod-barras').append('VALIDADO COM SUCESSO !!  <i class="fad fa-check"></i>');
                        
                    }
                });
                return;
            }
            Swal.fire({
                "title": "Código de Barras",
                "text": "Nenhum Código de barras foi digitado",
                "icon": "error",
            });
        }
    });
  </script>
</body>

</html>
