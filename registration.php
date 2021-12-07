<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';  
class email{
    
    public $email;
    public $nombre;
    
    public function __construct($email, $nombre){
        $this->email = $email;
        $this->nombre = $nombre;
    }

    public function enviar(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Port = 587;

        $mail->setFrom('cuentas@novasystem.com');
        $mail->addAddress("cuentas@novasystem.com", "NovaSystem.com");
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en Nova
        System, para confirmarla haz click el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:8080/sistema_ventas/index.php"
        . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        // Enviar email
        $mail->send();
    }
    
}

?>

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
          <i class="ri-mail-line icons mail"></i>
          <input type="email" name="correo" id="correo" placeholder="Ingrese su correo">
          <i class="ri-user-line icons user"></i>
          <input type="text" name="usuario" id="usuario" placeholder="Ingrese su usuario">
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
    let correo = document.getElementById('correo').value;
    let usuario = document.getElementById('usuario').value;
    let contrasena = document.getElementById('contrasena').value;
    $.post(
      "webservice/registrarse.php",
      {
        "nombre": nombre,
        "correo": correo,
        "usuario": usuario,
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