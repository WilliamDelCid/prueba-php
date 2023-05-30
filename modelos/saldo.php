<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
  

$opcion = (isset($_GET["op"])) ? $_GET["op"] : '';

switch($opcion){
    case 1: //alta
        $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';

        $consulta = "INSERT INTO saldo (nombre) VALUES('$nombre') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM saldo ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación

        $id = (isset($_POST['id1'])) ? $_POST['id1'] : '';
        $nombre = (isset($_POST['nombre1'])) ? $_POST['nombre1'] : '';

        $consulta = "UPDATE saldo SET nombre='$nombre' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM saldo WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja

        $id = (isset($_POST['id2'])) ? $_POST['id2'] : '';

        $consulta = "DELETE FROM saldo WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

header('Location: ../vistas/saldo.php');
//print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
//$conexion = NULL;
