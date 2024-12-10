<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galaxy Fitness</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <!-- sweetalert2 para alertas -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box " style="margin-top:100px">

<?php
        session_start();
        if (isset($_SESSION['mensaje'])) {
            $respuesta = $_SESSION['mensaje'];
        ?>
<script>
    Swal.fire({
  position: "center",
  icon: "error",
  title: "<?php echo $respuesta;?>",
  showConfirmButton: false,
  timer: 1500
});
</script>

        <?php
        }
        ?>

  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Galaxy Fitness</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Inicia Sesion</p>

      <form action="../app/controllers/login/ingreso.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nombre de usuario" name="usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-circle"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
    </div>
   
  </div>

</div>

<!-- jQuery -->
<script src="../public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>
