<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
  

$opcion = (isset($_GET["op"])) ? $_GET["op"] : '';

switch($opcion){
    case 1: //alta
        $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
        $contra = (isset($_POST['contraseña'])) ? $_POST['contraseña'] : '';

        $consulta = "INSERT INTO usuario (usuario, clave) VALUES('$usuario', '$contra') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        header('Location: ../vistas/usuario.php');
        break;
    case 2: //modificación

        $id = (isset($_POST['id1'])) ? $_POST['id1'] : '';
        $usuario = (isset($_POST['usuario1'])) ? $_POST['usuario1'] : '';
        $contraseña = (isset($_POST['contraseña1'])) ? $_POST['contraseña1'] : '';

        $consulta = "UPDATE usuario SET usuario='$usuario', clave='$contraseña' WHERE idusuario='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();       
        header('Location: ../vistas/usuario.php'); 
        break;        
    case 3://baja

        $id = (isset($_POST['id2'])) ? $_POST['id2'] : '';

        $consulta = "DELETE FROM usuario WHERE idusuario='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        header('Location: ../vistas/usuario.php');                      
        break;     
    case 4: //alta
        $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
         $contra = (isset($_POST['contraseña'])) ? $_POST['contraseña'] : '';
    
        $consulta = "INSERT INTO usuario (usuario, clave) VALUES('$usuario', '$contra') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        header('Location: ../index.php');
        break;   
}

//print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
//$conexion = NULL;
