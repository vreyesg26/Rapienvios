<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Empleado.php");
    $usuario = new Empleado();
    $contra = @$_POST['contrasena'];
    //$Encriptar = password_hash($contra,PASSWORD_DEFAULT);
    $usuario->ConstructorLogin(@$_POST['usuario'], $contra); 
    echo json_encode($usuario->login($conexion)); 
}
?>