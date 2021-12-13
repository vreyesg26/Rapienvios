<?php
include "Respuesta.php";

class Envio {
    public $idEnvio;
    public $idPaquete;
    public $descripcion;
    public $idEmpleado;
    public $fechaRecibido;
    public $fechaEnvio;
    public $estado;


    public function __construct(){}

    public function constructorEnviosCliente($idEnvio, $descripcion, $fechaRecibido, $fechaEnvio){
        $this->idEnvio = $idEnvio;
        $this->descripcion = $descripcion;
        $this->fechaRecibido = $fechaRecibido;
        $this->fechaEnvio = $fechaEnvio;
    }

    public function ConstructorListarEnvios($idEnvio,$idPaquete,$idEmpleado,$fechaRecibido,$fechaEnvio,$estado){
        $this->idEnvio = $idEnvio;
        $this->idPaquete = $idPaquete;
        $this->idEmpleado = $idEmpleado;
        $this->fechaRecibido = $fechaRecibido;
        $this->fechaEnvio = $fechaEnvio;
        $this->estado = $estado;
    }

    public function obtenerEnviosByCasillero($conexion,$idCasillero) {

        $consulta = 
        "SELECT E.idEnvio, P.descripcion, IF( E.fechaRecibido IS NULL,'', fechaRecibido) as 'fechaRecibido', E.fechaEnvio FROM envio AS E
        INNER JOIN paquete AS P
            ON E.idPaquete = P.idPaquete
        WHERE P.idCasillero = '$idCasillero' AND E.estado = 1;";

        $resultado = mysqli_query($conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $envio = new Envio();
            $envio->constructorEnviosCliente($fila['idEnvio'], $fila['descripcion'], $fila['fechaRecibido'], $fila['fechaEnvio']);
            $lista[] = $envio;
        }
        return $lista;
    }

    public function obtenerEnviosPendientes($Conexion,$valor) {
        $consulta = "SELECT `idEnvio`, envio.idPaquete,cliente.nombre ,envio.idEmpleado, IF(fechaRecibido is null,'-', fechaRecibido) as 'fechaRecibido', fechaEnvio, IF(envio.estado=1,'Activo','Entregado') as Estado 
        FROM `envio`, empleado,paquete,cliente,casillero 
        WHERE envio.idEmpleado = empleado.idEmpleado AND envio.idPaquete = paquete.idPaquete AND paquete.idCasillero =  cliente.idCasillero 
        AND envio.estado =1 AND envio.idPaquete LIKE '%$valor%'";
        $resultado = mysqli_query($Conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Jornadas = new Envio();
            $Jornadas->ConstructorListarEnvios($fila['idEnvio'], $fila['idPaquete'], $fila['idEmpleado'], $fila['fechaRecibido'], $fila['fechaEnvio'], $fila['Estado']);
            $lista[] = $Jornadas;
        }
        return $lista;
    }


    public function EntregarEnvio($conexion){

        $consulta = "UPDATE envio SET estado = 0, fechaRecibido = $this->fechaRecibido WHERE idEnvio = '$this->idEnvio'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El envio se ha Entregado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al modificar" . $conexion->error);
            return $Respuesta;
        }

    }

}