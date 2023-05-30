<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
  

$opcion = (isset($_GET["op"])) ? $_GET["op"] : '';

switch($opcion){
    case 1: //nuevo
        $id = (isset($_POST['id'])) ? $_POST['id'] : '';
        $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
        $tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
        $nivel = (isset($_POST['nivel'])) ? $_POST['nivel'] : '';
        $saldo = (isset($_POST['saldo'])) ? $_POST['saldo'] : '';

        $consulta = "INSERT INTO catalogo (codigo, nombre, tipo, nivel, saldo) VALUES('$id', '$nombre','$tipo', '$nivel', '$saldo') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM catalogo ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        header('Location: ../vistas/catalogo.php');
        break;
    case 2: //modificación

        $id = (isset($_POST['id1'])) ? $_POST['id1'] : '';
        $nombre = (isset($_POST['nombre1'])) ? $_POST['nombre1'] : '';
        $tipo = (isset($_POST['tipo1'])) ? $_POST['tipo1'] : '';
        $nivel = (isset($_POST['nivel1'])) ? $_POST['nivel1'] : '';
        $saldo = (isset($_POST['saldo1'])) ? $_POST['saldo1'] : '';

        $consulta = "UPDATE catalogo SET nombre='$nombre', tipo='$tipo', nivel='$nivel', saldo='$saldo' WHERE codigo='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM catalogo WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        header('Location: ../vistas/catalogo.php');
        break;        
    case 3://borrar

        $id = (isset($_POST['id2'])) ? $_POST['id2'] : '';

        $consulta = "DELETE FROM catalogo WHERE codigo='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        
        header('Location: ../vistas/catalogo.php');
        break;
        
    case 4://obtener registro
        $id = (isset($_POST['id'])) ? $_POST['id'] : '';


        $consulta = "SELECT * FROM catalogo  WHERE codigo='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        break;

    case 5://obtener registro
        $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    
    
        $consulta = "SELECT c.codigo AS codigo, c.nombre AS nombre, t.nombre AS tipo, c.nivel AS nivel, s.nombre AS saldo
                    FROM catalogo c 
                    INNER JOIN tipo t ON c.tipo=t.id
                    INNER JOIN saldo s ON c.saldo=s.id
                    WHERE c.codigo='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    
        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        break;
}



//$conexion = NULL;
