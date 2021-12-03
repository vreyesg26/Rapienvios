<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/confirmPassword.css" />
    <link rel="shortcut icon" href="img/RLogo.png" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.min.js"></script>
    <title>Rapienvios - Inicia sesión o registrate</title>
  </head>
  <body>
    <header>
      <nav class="nav-bar">
        <a href="index.php"><img src="img/Logo2.png" alt="logo" id="logo" /></a>
      </nav>
    </header>
    <section class="content-data">
      <img id="cover" src="img/Ilustracion2.png" alt="cover">
      <form action="" method="post">
          <h2>Recuperar Contraseña</h2>
          <i class="ri-lock-2-line icons password"></i>
          <input type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña">
          <i class="ri-lock-password-line icons cpassword"></i>
          <input type="password" name="confirmarContrasena" id="confirmarContrasena" placeholder="Confirmar contraseña">
          <button type="button" onclick="cambiarContraseña()" class="startSession" >Guardar</button>
      </form>
    </section>
  </body>
  

  <script type="text/javascript">

  </script>
</html>