<?php
require_once '../bd/conexion.php';
class DetalleModel{

	public static function listar(){

		$query = Conexion::Conectar()->prepare("SELECT * FROM detallediario");
		$query->execute();
		return $query->fetchAll();
	}

	public static function getPartida($partida){

		$query = Conexion::Conectar()->prepare("SELECT * FROM detallediario WHERE idpartida=:partida");
		$query->bindParam(":partida",$partida,PDO::PARAM_STR);
		$query->execute();
		return $query->fetchAll();
	}


	public static function agregarDetalle($data){
		$query = Conexion::Conectar()->prepare("INSERT INTO detallediario(codigo,idpartida,monto,movimiento) VALUES (:codigo,:id,:monto,:movimiento)");
		$query->bindParam(":id",$data["id"],PDO::PARAM_STR);
		$query->bindParam(":codigo",$data["codigo"],PDO::PARAM_STR);
		$query->bindParam(":monto",$data["monto"],PDO::PARAM_STR);
		$query->bindParam(":movimiento",$data["movimiento"],PDO::PARAM_STR);
		return $query->execute();
		
	}


	public static function editarDetalle($data){
		$query = Conexion::Conectar()->prepare("UPDATE detallediario SET monto=:monto,movimiento=:movimiento WHERE idpartida=:id AND codigo=:codigo");
		$query->bindParam(":id",$data["id"],PDO::PARAM_STR);
		$query->bindParam(":codigo",$data["codigo"],PDO::PARAM_STR);
		$query->bindParam(":monto",$data["monto"],PDO::PARAM_STR);
		$query->bindParam(":movimiento",$data["movimiento"],PDO::PARAM_STR);
		return $query->execute();
		
	}

	public static function comprobar($codigo,$partida){
		$query = Conexion::Conectar()->prepare("SELECT * FROM detallediario WHERE codigo=:codigo AND idpartida=:partida");
		$query->bindParam(":partida",$partida,PDO::PARAM_STR);
		$query->bindParam(":codigo",$codigo,PDO::PARAM_STR);
		$query->execute();
		return $query->fetch();
	}

	public static function sumaMovimiento($partida,$movimiento){
		$query = Conexion::Conectar()->prepare("SELECT SUM(monto) as total FROM detallediario WHERE idpartida=:partida AND movimiento=:movimiento");
		$query->bindParam(":partida",$partida,PDO::PARAM_STR);
		$query->bindParam(":movimiento",$movimiento,PDO::PARAM_STR);
		$query->execute();
		return $query->fetch();
	}

	public static function libroMayor($codigo,$busqueda,$inicio = false,$final = false){
		$sql = "";
		$sql .= 'SELECT p.fecha,p.idpartida,c.codigo,p.descripcion,if(dd.movimiento = "CARGO",dd.monto,0) as  debe ,if(dd.movimiento = "ABONO",dd.monto,0) as  haber,(SELECT nombre FROM saldo WHERE id=c.saldo) as saldo,c.nombre as cuenta   FROM detallediario dd INNER JOIN catalogo c on dd.codigo=c.codigo INNER JOIN partida p ON dd.idpartida=p.idpartida WHERE c.codigo LIKE "'.$codigo.'%'.'" AND p.estado=1';
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

	public static function estado_resultado2($cuenta,$inicio = false,$fin = false){
		$total_final = 0.00;
		$total_debe = 0.00;
		$total_haber = 0.00;
		$sql = "";
		$sql .= 'SELECT p.fecha,p.idpartida,c.codigo,p.descripcion,if(dd.movimiento = "CARGO",dd.monto,0) as debe ,if(dd.movimiento = "ABONO",dd.monto,0) as haber FROM detallediario dd INNER JOIN catalogo c on dd.codigo=c.codigo INNER JOIN partida p ON dd.idpartida=p.idpartida WHERE  c.codigo LIKE "'.'%'.$cuenta.'%'.'" AND p.estado = 1';
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

		return str_replace("-","", $total_final);
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


	public static function balanceG($codigo){
		$sql = "";
		$sql .= 'SELECT * FROM catalogo 
        WHERE  codigo LIKE "'.$codigo.'%'.'"  AND nivel=3 AND codigo != 1107 AND codigo != 3102 AND codigo!=3105 ORDER BY codigo ASC';
		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}


	public static function balanceG2($codigo){
		$sql = "";
		$sql .= 'SELECT * FROM catalogo 
        WHERE  codigo LIKE "'.$codigo.'%'.'" AND nivel=3 ORDER BY codigo ASC';
		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public static function balanceG3($codigo){
		$sql = "";
		$sql .= 'SELECT * FROM catalogo 
        WHERE  codigo LIKE "'.$codigo.'%'.'" AND nivel > 2 ORDER BY codigo ASC';
		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public static function gastos($codigo,$nivel){
		$sql = "";
		$sql .= 'SELECT * FROM catalogo 
        WHERE  codigo LIKE "'.$codigo.'%'.'"  AND nivel="'.$nivel.'" ORDER BY codigo ASC';
		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
	public static function gastos2($codigo){
		$sql = "";
		$sql .= 'SELECT * FROM catalogo 
        WHERE  codigo LIKE "'.'%'.$codigo.'%'.'" ORDER BY codigo ASC';
		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}


	public static function borrarDetalle($partida){
		$query = Conexion::Conectar()->prepare("DELETE FROM detallediario WHERE  idpartida=:id");
		$query->bindParam(":id",$partida,PDO::PARAM_INT);
		return $query->execute();
	}

	public static function reset_detalle(){
		$query = Conexion::Conectar()->prepare("ALTER TABLE partida AUTO_INCREMENT = 1");
		
		return $query->execute();
	}

}