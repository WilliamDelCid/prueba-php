<?php
include_once '../bd/conexion.php';
include_once '../modelos/partidita.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
  

$opcion = (isset($_GET["op"])) ? $_GET["op"] : '';

switch($opcion){
    case 1: //PARA AGREGAR
        $id_partida =(isset($_POST["id_partida"])) ? $_POST["id_partida"] : ''; ; 
        $fecha =(isset($_POST["fecha"])) ? $_POST["fecha"] : ''; 
        $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : '';
        $cierre = 0;
        $activo = 1;
        $cont=0;
      //  $cont = (isset($_POST["contador"])) ? $_POST["contador"] : '';
     
        
                    $data_partida = array("id" => $id_partida,
                    "fecha" => $fecha,
                    "descripcion" => $descripcion,
                    "cierre" => $cierre,
                    "activo" => $activo);

                //AGREGAMOS LA PARTIDA
                $query ="INSERT INTO partida(idpartida,fecha,descripcion,cierre,estado) VALUES (:id,:fecha,:descripcion,:cierre,:activo)";
                $r = $conexion->prepare($query);
                $r->bindParam(":id",$data_partida["id"],PDO::PARAM_STR);
                $r->bindParam(":fecha",$data_partida["fecha"],PDO::PARAM_STR);
                $r->bindParam(":descripcion",$data_partida["descripcion"],PDO::PARAM_STR);
                $r->bindParam(":cierre",$data_partida["cierre"],PDO::PARAM_STR);
                $r->bindParam(":activo",$data_partida["activo"],PDO::PARAM_INT);
                $r->execute();


              
                for ($i=0; $i <count($_POST["cuenta_hidden"]) ; $i++) { 
                    if (!empty($_POST["cuenta_hidden"][$i])) {
                        $data_detalle = array("id" => $id_partida,
                          "codigo" => $_POST["cuenta_hidden"][$i],
                          "monto" => $_POST["cantidad"][$i],
                          "movimiento" => $_POST["movimiento"][$i]
                        );
                        
                        $query = $conexion->prepare("INSERT INTO detallediario(codigo,idpartida,monto,movimiento) VALUES (:codigo,:id,:monto,:movimiento)");
                        $query->bindParam(":id",$data_detalle["id"],PDO::PARAM_STR);
                        $query->bindParam(":codigo",$data_detalle["codigo"],PDO::PARAM_STR);
                        $query->bindParam(":monto",$data_detalle["monto"],PDO::PARAM_STR);
                        $query->bindParam(":movimiento",$data_detalle["movimiento"],PDO::PARAM_STR);
                        $query->execute();
          

            }
            }

            echo "true"; 
                
        break;
    case 2: //modificación
        $id_partida =(isset($_POST["id_partida"])) ? $_POST["id_partida"] : ''; ; 
        $fecha =(isset($_POST["fecha"])) ? $_POST["fecha"] : ''; 
        $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : '';
		$cierre = 0;

		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
                            );
                         
         $query15 = $conexion->prepare("UPDATE partida set fecha=:fecha,descripcion=:descripcion,cierre=:cierre WHERE idpartida=:id");
         $query15->bindParam(":id",$data_partida["id"],PDO::PARAM_STR);
         $query15->bindParam(":fecha",$data_partida["fecha"],PDO::PARAM_STR);
         $query15->bindParam(":descripcion",$data_partida["descripcion"],PDO::PARAM_STR);
         $query15->bindParam(":cierre",$data_partida["cierre"],PDO::PARAM_STR);
         $query15->execute();
        //EDITAMOS EL DETALLE
        if($query15){
			for ($i=0; $i < count($_POST["cuenta_hidden"]) ; $i++) { 
			if (!empty($_POST["cuenta_hidden"][$i])) {
                $comprobar = PartidaModel::comprobar($_POST["cuenta_hidden"][$i],$id_partida);
                 
			
			if (!$comprobar) {
				$data_detalle = array("id" => $id_partida,
							  "codigo" => $_POST["cuenta_hidden"][$i],
							  "monto" => $_POST["cantidad"][$i],
							  "movimiento" => $_POST["movimiento"][$i]
							);

                //$respuesta_detalle = DetalleModel::agregarDetalle($data_detalle);             
                //SI ESE DETALLE NO EXISTIA SE AGREGA
                $query4= "INSERT INTO detallediario(codigo,idpartida,monto,movimiento) VALUES (:codigo,:id,:monto,:movimiento)";
                $consul4= $conexion->prepare($query4);
                $consul4->bindParam(":id",$data_detalle["id"],PDO::PARAM_STR);
                $consul4->bindParam(":codigo",$data_detalle["codigo"],PDO::PARAM_STR);
                $consul4->bindParam(":monto",$data_detalle["monto"],PDO::PARAM_STR);
                $consul4->bindParam(":movimiento",$data_detalle["movimiento"],PDO::PARAM_STR);
                $consul4->execute();
			}else{
                
				$data_detalle = array("id" => $id_partida,
							  "codigo" => $_POST["cuenta_hidden"][$i],
							  "monto" => $_POST["cantidad"][$i],
							  "movimiento" => $_POST["movimiento"][$i]
							);

                //$respuesta_detalle =DetalleModel::editarDetalle($data_detalle);
                
                //SI YA EXISTE SOLO MODIFICAMOS

                $query5 ="UPDATE detallediario SET monto=:monto,movimiento=:movimiento WHERE idpartida=:id AND codigo=:codigo";
                $consul5= $conexion->prepare($query5);
                $consul5->bindParam(":id",$data_detalle["id"],PDO::PARAM_STR);
                $consul5->bindParam(":codigo",$data_detalle["codigo"],PDO::PARAM_STR);
                $consul5->bindParam(":monto",$data_detalle["monto"],PDO::PARAM_STR);
                $consul5->bindParam(":movimiento",$data_detalle["movimiento"],PDO::PARAM_STR);
                $consul5->execute();
		}

			

			}
		}
		}

        break;        
    case 3://baja

        $id = (isset($_POST['id2'])) ? $_POST['id2'] : '';
        $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';

        if(strpos($estado, 'Desactivar') !== false){
            $query = $conexion->prepare("UPDATE partida SET estado=0 WHERE idpartida=:id");
            $query->bindParam(":id",$id,PDO::PARAM_INT);
            $query->execute();
       
        }else{
            $query = $conexion->prepare("UPDATE partida SET estado=1 WHERE idpartida=:id");
            $query->bindParam(":id",$id,PDO::PARAM_INT);
            $query->execute();

        }
                                  
        break;        
}


header('Location: ../vistas/partida.php');