                <?php
            include_once '../bd/conexion.php';
            $objeto = new Conexion();  
            $conexion = $objeto->Conectar();

            $consul= (isset($_POST['id'])) ? $_POST['id'] : '';
            
            $consulta2='SELECT p.fecha,p.descripcion,c.codigo,c.nombre,dd.monto,dd.movimiento,if(dd.movimiento = "CARGO",dd.monto,0) as  debe ,if(dd.movimiento = "ABONO",dd.monto,0) as  haber   FROM partida p  INNER JOIN detallediario dd ON p.idpartida=dd.idpartida INNER JOIN catalogo c ON dd.codigo=c.codigo WHERE p.idpartida=:idconsul';
            $resultado2 = $conexion->prepare($consulta2);
            $resultado2->bindParam(":idconsul",$consul,PDO::PARAM_STR);
                $resultado2->execute();
                $data2= $resultado2->fetchAll();
                if(!empty($data2)){
                print json_encode($data2,JSON_UNESCAPED_UNICODE);
                 } else{
            print json_encode(null,JSON_UNESCAPED_UNICODE);
                 }
                $conexion=null;
            ?>   