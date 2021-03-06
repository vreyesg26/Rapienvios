<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="shortcut icon" href="img/RLogo.png" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.min.js"></script>
    <title>Rapienvios - Inicia sesión o registrate</title>
  </head>
  <body>
    <header>
      <nav class="nav-bar">
        <a href="login.php"><img src="img/Logo2.png" alt="logo" id="logo" /></a>
      </nav>
    </header>
    <section class="content-data">
      <form action="" method="post">
          <h2>REGISTRATE</h2>
          <i class="ri-emotion-line icons name"></i>
          <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre">
          <i class="ri-phone-line icons phone"></i>
          <input type="text" name="telefono" id="telefono" placeholder="Ingrese su teléfono">
          <i class="ri-route-line icons direction"></i>
          <input type="text" name="direccion" id="direccion" placeholder="Ingrese su dirección">
          <i class="ri-mail-line icons mail"></i>
          <input type="email" name="correo" id="correo" placeholder="Ingrese su correo">
          <i class="ri-lock-2-line icons password"></i>
          <input type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña">
          <button type="button" class="startSession" onclick="registrar();">Registrarse</button>
          <p>¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
      </form>
      <img id="cover" src="img/Personaje.png" alt="cover">
    </section>
  </body>
</html>

<script type="text/javascript">
  function registrar() {
    let nombre = document.getElementById('nombre').value;
    let telefono = document.getElementById('telefono').value;
    let direccion = document.getElementById('direccion').value;
    let correo = document.getElementById('correo').value;
    let contrasena = document.getElementById('contrasena').value;
    $.post(
      "webservice/registrarClientes.php",
      {
        "nombre": nombre,
        "telefono": telefono,
        "direccion": direccion,
        "correo": correo,
        "contrasena": contrasena
      },
      function(Data){
        let data = JSON.parse(Data);
        if (data.Ok == "1") {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: data.Data,
            showConfirmButton: false,
            timer: 1800
          })
          window.location="dashboardClientes.php";
        } else if (data.Ok == "0") {
          Swal.fire({
              position: 'center',
              icon: 'warning',
              title: data.Data,
              showConfirmButton: false,
              timer: 1800
          })
        }
      }
    );
  }
</script>