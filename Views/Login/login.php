<!doctype html>
<html lang="eS">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">



  <!-- Bootstrap CSS -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="<?php echo SERVER_URL; ?>/Assets/css/login.css">
  <link rel="icon" href="<?php echo SERVER_URL; ?>/Assets/images/favicon.png" type="image/x-icon">

  <title>Iniciar Sesión</title>
</head>

<body>

  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="<?php echo SERVER_URL; ?>/Assets/images/login/logo.jpg" id="icon" alt="User Icon" />
        <h1>INICIAR SESION</h1>
      </div>

      <!-- Login Form -->
      <form id="formLogin" name="formLogin" action="">
        <div class="form-group">
          <label for="user" class="user">Usuario</label>
          <input type="text" id="user" name="user" placeholder="Ingrese la cuenta de usuario">
        </div>
        <div class="form-group">
          <label for="password" class="user">Contraseña</label>
          <input type="password" id="password" class="fadeIn second" name="password" placeholder="Ingrese su contraseña">
        </div>
        <div class="alert alert-danger text-center d-none" id="alerta" role="alert">

        </div>
        <div class="fadeIn fourth">
          <button class="button-login" type="submit" onclick="enterLogin(event);">Entrar</button>
        </div>

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="#">¿Olvidaste tu contraseña?</a>
        </div>
    </div>

    </form>

  </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- Required Jquery -->

  <script>
    const baseUrl = "<?php echo SERVER_URL; ?>";
  </script>

  <script type="text/javascript" src="<?php echo SERVER_URL; ?>/Assets/js/jquery/jquery.min.js "></script>
  <script type="text/javascript" src="<?php echo SERVER_URL; ?>/Assets/js/jquery-ui/jquery-ui.min.js "></script>
  <script type="text/javascript" src="<?php echo SERVER_URL; ?>/Assets/js/popper.js/popper.min.js"></script>
  <script type="text/javascript" src="<?php echo SERVER_URL; ?>/Assets/js/bootstrap/js/bootstrap.min.js "></script>
  <!-- waves js -->
  <script src="<?php echo SERVER_URL; ?>/Assets/pages/waves/js/waves.min.js"></script>
  <!-- jquery slimscroll js -->
  <script type="text/javascript" src="<?php echo SERVER_URL; ?>/Assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
  <!-- slimscroll js -->
  <script src="<?php echo SERVER_URL; ?>/Assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
  <!-- sweetalert js -->
  <script src="<?php echo SERVER_URL; ?>/Alert/dist/sweetalert2.all.min.js"></script>
  <!-- menu js -->
  <script src="<?php echo SERVER_URL; ?>/Assets/js/pcoded.min.js"></script>
  <script src="<?php echo SERVER_URL; ?>/Assets/js/vertical/vertical-layout.min.js "></script>
  <script type="text/javascript" src="<?php echo SERVER_URL; ?>/Assets/js/script.js "></script>
  <!-- funciones js -->
  <script src="<?php echo SERVER_URL; ?>/Assets/js/funciones/functions_login.js"></script>
</body>

</html>