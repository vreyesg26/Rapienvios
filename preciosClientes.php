<?php
Session_start();

if(@$_SESSION['usuario'] == null || @$_SESSION['usuario'] == ''){
  header('Location:login.php');
}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="img/RLogo.png" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/dashboard.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.min.js"></script>
    <title>Rapienvios | Dashboard</title>
  </head>
  <body>
    <div class="side-panel">
      <img src="img/Logo.png" alt="logo" id="logo" />
      <div class="decoration-line"></div>
      <ul class="dashboard-elements">

        <a href="dashboardClientes.php">
          <li>
            <i class="ri-archive-fill side-icons"></i>
            Mis Paquetes
          </li>
        </a>

      


        <a href="preciosClientes.php">
          <li class="active">
            <i class="ri-price-tag-3-fill side-icons"></i>
            Consultar Precios
          </li>
        </a>

        <a href="cuentaCliente.php">
          <li>
            <i class="ri-settings-3-fill side-icons"></i>
            Mi Cuenta
          </li>
        </a>

        <li class="logout">
          <i class="ri-logout-box-r-line side-icons"></i>
          <a href="cerrarSesion2.php">Cerrar Sesión</a>
        </li>

      </ul>
    </div>
    <div class="content-data">
      <div class="up-content">
        <div class="searchBar">
          
        </div>
        <div class="user-name">
          <h3>Bienvenido, <strong><?php echo $_SESSION['usuario'];?></strong></h3>
        </div>
      </div>
      <div class="data">
        <div class="up-content">
          <h3>Precios mensuales de los casilleros</h3>
        </div>

        <div class="tabla-paquetes">
          <table class="tablaPaquetes" id="tablaPaquetes">
        </div>

        <div class="content-tables"></div>
      </div>
      
    </div>
    <div id="miModal" class="modal">
      <div class="flex" id="flex">
        <div class="contenido-modal">
          <div class="modal-header flex">
            <i class="ri-folder-user-fill side-icons"></i>
            <h2>Nuevo Cliente</h2>
            <span class="close" id="close">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">
                <input type="text" placeholder="ID Cliente" disabled/>
                <input type="text" placeholder="Ingrese el nombre"  id="nombreCliente"/>
                <input type="text" placeholder="Ingrese el teléfono" id="telefono" />
                <input type="text" placeholder="Ingrese la dirección" id="direccion"/>
                <button type="button" onclick="registrarCliente()" class="guardarCliente">Guardar</button>
              </div>
              <div class="imagen">
                <img src="img/nuevoCliente.svg" alt="ilustracion" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="js/main.js"></script>
  </body>
</html>

<script type="text/javascript">
   (function(){
    obtenerPaquetes();
  })();

  function limpiar() {
    var nombreCliente = document.getElementById("nombreCliente").value = "";
    var telefono = document.getElementById("telefono").value = "";
    var  direccion = document.getElementById("direccion").value = "";
  }

  function registrarCliente(){
    var nombreCliente = document.getElementById("nombreCliente").value;
    var telefono = document.getElementById("telefono").value;
    var  direccion = document.getElementById("direccion").value;

    
    //alert(nombreCliente+" "+telefono);
    $.post(
    "webservice/RegistrarCliente.php",
    {
      'nombre': nombreCliente,
      'telefono': telefono,
      'direccion':direccion
    },
      function(data){
        //alert(data);
        $Resp = JSON.parse(data);
        if($Resp.Ok==1){
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: $Resp.Data,
            showConfirmButton: false,
            timer: 1800
          })
          limpiar();
          //sleep(4);
          //window.location="dashboard.php";
        } else {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: $Resp.Data,
            showConfirmButton: false,
            timer: 1800
          })
        }
      }
    );
  }
  
  function obtenerPaquetes(valor) {
    let tablaPaquetes = document.getElementById('tablaPaquetes');
    
    $.post(
      "webservice/mostrarPrecioCasilleroCliente.php",
      {'valor':valor},
      function(Data) {
        let paquetes = JSON.parse(Data);
        html = "<tr><th>Tamaño</th><th>Precio</th></tr>";
        for(i in paquetes) {
          html += "<tr><td>"+ paquetes[i].descripcion +"</td><td>"+"L. "+ paquetes[i].precio +"</td></tr>";
          tablaPaquetes.innerHTML = html;
        }
      }
    );
  }

</script>
