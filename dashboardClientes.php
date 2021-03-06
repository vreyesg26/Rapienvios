<?php
Session_start();

if(@$_SESSION['usuario'] == null || @$_SESSION['usuario'] == ''){
  header('Location:login.php');
}

?>

<?php 

	$conexion=mysqli_connect('localhost','root','','rapienvio');

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
    <link rel="stylesheet" href="css/dashboard.css"/>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.min.js"></script>
    <title>Rapienvios | Dashboard</title>
  </head>
  <body>
    <div class="side-panel">
      <img src="img/Logo.png" alt="logo" id="logo" />
      <hr class="side-nav-hr">
      <ul class="dashboard-elements">

        <a href="dashboardClientes.php">
          <li class="active">
            <i class="ri-archive-fill side-icons"></i>
            Mis Paquetes
          </li>
        </a>

      


        <a href="preciosClientes.php">
          <li>
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
      </ul>


      <ul class="logout-container">
        <a href="cerrarSesion2.php">
            <li class="logout">
              <i class="ri-logout-box-r-line side-icons"></i>
              Cerrar Sesión
            </li>
          </a>
      </ul>
    </div>
    <div class="content-data">
      <div class="up-content">
        <div class="searchBar">
        <h3 id="casillero">casillero no: <strong><?php echo $_SESSION['casillero'];?></strong></h3>
        </div>
        <div class="user-name">
          <h3>Bienvenido, <strong><?php echo $_SESSION['usuario'];?></strong></h3>
        </div>
      </div>

      <div class="data">


        <div class="data-container-paquetes">
          <div class="up-content" style="margin-left:0;">
            <h3>Total de paquetes: <strong>0</strong></h3>
          </div>

          <div class="up-content" style="margin-right:0;">
            <h3>Total de envios: <strong>0</strong></h3>
          </div>
        <div class="up-content">
          <h3>Paquetes en bodega: <strong id="totalPaquetes"></strong></h3>
        </div>


        <div class="tabla-paquetes">
          <table class="tablaPaquetes" id="tablaPaquetes">
          </table>
        </div>

        
        <div class="tabla-envios">
          <table class="tablaEnvios" id="tablaEnvios"></table>
        </div>


        <div class="content-tables"></div>
      </div>

      <div class="data">
      <div class="up-content">
          <h3>Paquetes enviados: <strong id="totalEnvios"> </strong></h3>
        </div>
        <div class="tabla-envios">
          <table class="tablaEnvios" id="tablaEnvios">
        </div>   
        <div class="content-tables"></div>
      </div>


    </div>

    <div id="modalTracking" class="modal">
      <?php 
        $sql="SELECT * from tracking";
        $result=mysqli_query($conexion,$sql);
        $mostrar=mysqli_fetch_array($result);
          for($i=0; $i<1;$i++){
            ?>
            <div class="flex" id="flex">
              <div class="contenido-modal">
                <div class="modal-header flex">
                  <i class="ri-folder-user-fill side-icons"></i>
                  
                  <h2>Tracking</h2>
                  <span class="close" id="closer">&times;</span>
                </div>
                <div class="modal-body modal-tracking">
                  <form action="" method="post" class="nuevoCliente">
                    <div class="form" style="display:grid; gap:2rem;">
                      <h4 style="grid-column:1/1">
                      ID :
                      </h4>
                      <p style="grid-column:2/2"><?php echo $mostrar['id'] ?></p>
                      <h4 style="grid-column:1/1">
                      ID Tracking:
                      </h4>
                      <p style="grid-column:2/2"><?php echo $mostrar['idTracking'] ?></p>
                      <h4 style="grid-column:1/1">
                      ID Paquete:
                      </h4>
                      <p style="grid-column:2/2"><?php echo $mostrar['idPaquete'] ?></p>
                      <h4 style="grid-column:1/1">
                        Fecha Llegada:
                      </h4>
                      <p style="grid-column:2/2"><?php echo $mostrar['fechaLlegada'] ?></p>
                      <h4 style="grid-column:1/1">
                        Fecha Salida:
                      </h4>
                      <p style="grid-column:2/2"><?php echo $mostrar['fechaSalida'] ?></p>
                      <h4 style="grid-column:1/1">
                        Ubicación:
                      </h4>
                      <p style="grid-column:2/2"><?php echo $mostrar['ubicacion'] ?></p>
                    </div>
                    <div class="imagen">
                      <img src="img/nuevoCliente.svg" alt="ilustracion" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php
          }
        ?> 
    </div>
    
    <script src="js/main.js"></script>
  </body>
</html>

<script type="text/javascript">


  (function(){
    obtenerPaquetes();
    obtenerEnvios();
    EstadoEdit();
  })();
  
  function obtenerPaquetes(valor) {
    let tablaPaquetes = document.getElementById('tablaPaquetes');
  
   (function(){
    totalPaquetes();
    totalEnvios();
    obtenerPaquetes();
    obtenerEnvios();
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


  function totalPaquetes() {
    let totalPaquetes = document.getElementById('totalPaquetes');
    var casillero = <?php echo $_SESSION['casillero'] ?>;
    $.post(
      "webservice/totalPaquetesCliente.php",
      {'casillero':casillero},
      function(Data) {
        let total = JSON.parse(Data);
        totalPaquetes.innerHTML = total['totalPaquetes'];
      }
    );
  }

  function enviarPaquete(elemento){
    var idPaquete = document.getElementById('enviarPaquete').value = elemento.value;
    $.post(
      "webservice/enviarPaqueteCliente.php",
      {'idPaquete':idPaquete},
      function(Data){
        //alert(Data);
        obtenerPaquetes();
      }
    );
    
    $.post(
      "webservice/crearEnvioCliente.php",
      {'idPaquete':idPaquete},
      function(Data){
        //alert(Data);
        obtenerEnvios();
      }
    );
    
  }
 
  function obtenerPaquetes(valor) {
    let tablaPaquetes = document.getElementById('tablaPaquetes');
    
    var casillero = <?php echo $_SESSION['casillero'] ?>;
    $.post(
      "webservice/mostrarPaquetesCliente.php",
      {'casillero':casillero},
      function(Data) {
        let paquetes = JSON.parse(Data);
        html = "<tr><th>ID</th><th>Descripción</th><th>Peso</th><th>Acciones</th></tr>";
        for(i in paquetes) {
          html += "<tr><td>"+ paquetes[i].idPaquete +"</td><td>"+ paquetes[i].descripcion +"</td><td>"+ paquetes[i].peso +"</td><td><button id='enviarPaquete' class='btnEdit' onclick='enviarPaquete(this);' value="+ paquetes[i].idPaquete +">Enviar paquete</button></td></tr>";
          tablaPaquetes.innerHTML = html;
        }
      }
    );
  }


  
  function totalEnvios() {
    let totalPaquetes = document.getElementById('totalEnvios');
    var casillero = <?php echo $_SESSION['casillero'] ?>;
    $.post(
      "webservice/totalEnviosCliente.php",
      {'casillero':casillero},
      function(Data) {

        let paquetes = JSON.parse(Data);
        html = "<tr><th>ID</th><th>Descripción</th><th>Peso</th></tr>";
        for(i in paquetes) {
          html += "<tr id='idTr'><td id='idPaquete"+i+"'>"+ paquetes[i].idPaquete +"</td><td>"+ paquetes[i].descripcion +"</td><td>"+ paquetes[i].peso;
          tablaPaquetes.innerHTML = html;
        }
=======
        
        let total = JSON.parse(Data);
        totalPaquetes.innerHTML = total['totalEnvios'];

      }
    );
  }

  function obtenerEnvios(valor) {
    let tablaEnvios = document.getElementById('tablaEnvios'); 
    var casillero = <?php echo $_SESSION['casillero'] ?>;
    $.post(
      "webservice/mostrarEnviosActivosCliente.php",
      {
        'casillero':casillero
      },
      function(Data) {

        //alert(Data);
        let clientes = JSON.parse(Data);
        html = "<tr><th>ID</th><th>fecha Envio</th><th>Estado</th><th>Acciones</th></tr>";
        for(i in clientes) {
          html += "<tr><td>"+ clientes[i].idEnvio +"</td><td>"+ clientes[i].fechaEnvio +"</td><td>"+ clientes[i].estado +"</td><td><button class='btnDelete' id='eliminarCliente' onclick='mostrarTracking(this);' value="+ clientes[i].idPaquete +">Mostrar Tracking</button></td></tr>";
          tablaClientes.innerHTML = html;


        let envios = JSON.parse(Data);
        html = "<tr><th>ID</th><th>Descripcion</th><th>fecha Envio</th><th>Acciones</th></tr>";
        for(i in envios) {
          if (i in envios <1)
            html =+ "<h3>No hay envios disponibles</h3>"
          else
          html += "<tr><td>"+ envios[i].idEnvio +"</td><td>"+ envios[i].descripcion +"</td><td>"+ envios[i].fechaEnvio +"</td><td><button class='btnDelete' id='eliminarCliente' onclick='obtenerIdEliminar(this);' value="+ envios[i].idEnvio +">Mostrar Tracking</button></td></tr>";
          tablaEnvios.innerHTML = html;

        }
      }
      
    );
  }

  
  
  function EstadoEdit() {
    var id = document.getElementById("idTr");
    console.log(id);
  }
  function mostrarTracking(elemento) {
    let modal2 = document.getElementById('modalTracking');
    let flex2 = document.getElementById('flex');
    let abrir2 = document.getElementById('eliminarCliente');
    let cerrar2 = document.getElementById('closer');
    modal2.style.display = 'block';

    cerrar2.addEventListener('click', function(){
        modal2.style.display = 'none';
    });

    window.addEventListener('click', function(e){
        console.log(e.target);
        if(e.target == flex2){
            modal.style.display = 'none';
        }
    });

    $.POST(
      'webservice/mostrarTracking.php',
      {
      'id':elemento.value
      },
    function (Data){
    alert(Data);
      
    }); 
  }
</script>
