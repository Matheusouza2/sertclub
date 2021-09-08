<html lang="pt-br">
<?php session_start();
if(isset($_SESSION['user'])){
  header("location: admin.php");
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="assets/img/icon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="assets/img/backLogin.png" class="img-fluid"
          alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="controllers/UserController.php" method="POST">
            <input type="hidden" name="login" value="true">
            <div class="form-outline mb-4">
                <label class="form-label" for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" class="form-control form-control-lg"
                placeholder="Digite seu usuário aqui" />
            </div>

            <div class="form-outline mb-3">
                <label class="form-label" for="senha">Senha</label>
                <input type="password" id="senha" name="senha" class="form-control form-control-lg"
                placeholder="Digite sua senha" />
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Entrar</button>
            </div>

        </form>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © <?php echo date('Y') ?> - Desenvolvido pela SertSoft
    </div>
    <!-- Copyright -->
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</body>
</html>