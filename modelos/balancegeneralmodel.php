<?php
require_once '../bd/conexion.php';
$op = (isset($_GET["op"])) ? $_GET["op"] : '';
if ($op==1) {
	$fecha_inicio = (isset($_POST["fecha_inicio"])) ? $_POST["fecha_inicio"] : '';
	$fecha_fin = (isset($_POST["fecha_fin"])) ? $_POST["fecha_fin"] : '';
	$inventario_final = (isset($_POST["inventario_final"])) ? $_POST["inventario_final"] : '';
}else if ($op==2) {
	$fecha_inicio = (isset($_GET["fecha_inicio"])) ? $_GET["fecha_inicio"] : '';
	$fecha_fin = (isset($_GET["fecha_fin"])) ? $_GET["fecha_fin"] : '';
	$inventario_final = (isset($_GET["inventario_final"])) ? $_GET["inventario_final"] : '';
}



class DetalleModel{
    public static function estado_resultado($cuenta,$inicio = false,$fin = false){
		$total_final = 0.00;
		$total_debe = 0.00;
		$total_haber = 0.00;
		$sql = "";
		$sql .= 'SELECT p.fecha,p.idpartida,c.codigo,p.descripcion,if(dd.movimiento = "CARGO",dd.monto,0) as debe ,if(dd.movimiento = "ABONO",dd.monto,0) as haber FROM detallediario dd INNER JOIN catalogo c on dd.codigo=c.codigo INNER JOIN partida p ON dd.idpartida=p.idpartida WHERE p.cierre = 0 AND p.estado = 1 AND c.codigo LIKE "'.$cuenta.'%'.'"';
		if ($inicio !== false AND $fin !== false) {
			
			$sql .=  'AND p.fecha BETWEEN "'.$inicio.'" AND "'.$fin.'"';
		}

		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		$data = $query->fetchAll();


		foreach ($data as $d) {
			$total_final = ($total_debe + $d["debe"])-($total_haber +$d["haber"]);
			$total_debe = $total_debe + $d["debe"];
			$total_haber = $total_haber + $d["haber"];


		}

		$busqueda = strpos($total_final, "E");
			if ($busqueda !== false) {

				$total_final = 0.0;
			}
		return str_replace("-","", $total_final);
    }
    
    public static function balanceG($codigo){
		$sql = "";
		$sql .= 'SELECT * FROM catalogo 
        WHERE  codigo LIKE "'.$codigo.'%'.'"  AND nivel=3 AND codigo != 1107 AND codigo != 3102 AND codigo!=3105 ORDER BY codigo ASC';
		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
    }
    
    public static function libroMayor2($codigo,$busqueda,$inicio = false,$final = false){
		$sql = "";
		$sql .= 'SELECT p.fecha,p.idpartida,c.codigo,p.descripcion,if(dd.movimiento = "CARGO",dd.monto,0) as  debe ,if(dd.movimiento = "ABONO",dd.monto,0) as  haber,(SELECT nombre FROM saldo WHERE id=c.saldo) as saldo,c.nombre as cuenta   FROM detallediario dd INNER JOIN catalogo c on dd.codigo=c.codigo INNER JOIN partida p ON dd.idpartida=p.idpartida WHERE c.codigo LIKE "'.$codigo.'%'.'" AND p.estado=1 AND p.cierre !=2';
		if ($busqueda !== false) {
			$sql .=  ' AND c.nombre LIKE "'.'%'.$busqueda.'%'.'" ';
		}

		if ($inicio !== false AND $final !== false) {
			$sql .=  ' AND p.fecha BETWEEN "'.$inicio.'" AND "'.$final.'"';
		}

			$sql .= ' ORDER BY p.fecha ASC';
		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
    }
    
    public static function total($data){
		$total_debe = 0.00;
		$total_haber = 0.00;
		$total_final = 0.00;
		foreach ($data as $d) {
			$total_final = ($total_debe + $d["debe"])-($total_haber +$d["haber"]);
		
			$total_debe = $total_debe + $d["debe"];
			$total_haber = $total_haber + $d["haber"];


		}

			$busqueda = strpos($total_final, "E");
			if ($busqueda !== false) {

				$total_final = 0.0;
			}
		return $total_final;
		
    }
    
    public static function total2($data){
		$total_debe = 0.00;
		$total_haber = 0.00;
		$total_final = 0.00;
		foreach ($data as $d) {
			$total_final = ($total_haber +$d["haber"])-($total_debe + $d["debe"]);
		
			$total_debe = $total_debe + $d["debe"];
			$total_haber = $total_haber + $d["haber"];


		}

			$busqueda = strpos($total_final, "E");
			if ($busqueda !== false) {

				$total_final = 0.0;
			}
		return $total_final;
		
    }
    
    public static function prueba(){
		$sql = "";
		$sql .= 'SELECT * FROM partida WHERE cierre = 2';
		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		$cierreF = $query->fetchAll();

		if(count($cierreF)==1){
			return false;
		}else{
			return true;
		}
	}

}


