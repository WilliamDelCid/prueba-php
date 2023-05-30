<?php
require_once DOCUMENT_ROOT."models/connection.php";
class CatalogoModel{

	public static function listar(){

		$query = Connection::connect()->prepare("SELECT * FROM catalogo");
		$query->execute();
		return $query->fetchAll();
	}

	public static function listar_codigo($codigo){
		$query = Connection::connect()->prepare("SELECT * FROM catalogo WHERE codigo=:codigo");
		$query->bindParam(":codigo",$codigo,PDO::PARAM_STR);
		$query->execute();
		return $query->fetch();
	}

	public static function listar_saldo(){

		$query = Connection::connect()->prepare("SELECT * FROM saldo");
		$query->execute();
		return $query->fetchAll();
	}
	public static function listar_tipo(){

		$query = Connection::connect()->prepare("SELECT * FROM tipo");
		$query->execute();
		return $query->fetchAll();
	}

	public static function comprobarCodigo($codigo){
		$query = Connection::connect()->prepare("SELECT * FROM detallediario WHERE codigo=:codigo");
		$query->bindParam(":codigo",$codigo,PDO::PARAM_STR);
		$query->execute();
		return $query->fetch();
	}

	public static function comprobarHijas($codigo){
		$query = Connection::connect()->prepare("SELECT * FROM catalogo  WHERE codigo LIKE '".$codigo."_%'");
		$query->execute();
		return $query->fetchAll();
	}

public static function obtenerCuentasSinHijas($codigo){
		$cuentas_sin_hijas = [];
		
		$registros = self::comprobarHijas($codigo);
		$indice = 0;
		
		if (count($registros) > 0) {
			foreach ($registros as $registro) {
				
				if (count(self::comprobarHijas($registro["codigo"])) > 0) {
					self::obtenerCuentasSinHijas($registro["codigo"]);
				}else{
					$cuentas_sin_hijas[] = $registro["codigo"];
				}
				
			}
		}
		


		return $cuentas_sin_hijas;


		
				
		
	}

	public static function agregarCatalogo($data){
		$query = Connection::connect()->prepare("INSERT INTO catalogo(codigo,nombre,tipo,nivel,saldo) VALUES (:codigo,:nombre,:tipo,:nivel,:saldo)");
		$query->bindParam(":codigo",$data["codigo"],PDO::PARAM_STR);
		$query->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$query->bindParam(":tipo",$data["tipo"],PDO::PARAM_INT);
		$query->bindParam(":nivel",$data["nivel"],PDO::PARAM_INT);
		$query->bindParam(":saldo",$data["saldo"],PDO::PARAM_INT);
		return $query->execute();
		
	}

	public static function actualizarCatalogo($data){
		$query = Connection::connect()->prepare("UPDATE catalogo SET nombre=:nombre,tipo=:tipo,nivel=:nivel,saldo=:saldo WHERE codigo=:codigo");
		$query->bindParam(":codigo",$data["codigo"],PDO::PARAM_STR);
		$query->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$query->bindParam(":tipo",$data["tipo"],PDO::PARAM_INT);
		$query->bindParam(":nivel",$data["nivel"],PDO::PARAM_INT);
		$query->bindParam(":saldo",$data["saldo"],PDO::PARAM_INT);
		return $query->execute();
		
	}

	public static function eliminarCatalogo($id){
		$query = Connection::connect()->prepare("DELETE FROM catalogo WHERE codigo=:codigo");
		$query->bindParam(":codigo",$id,PDO::PARAM_STR);
		return $query->execute();
	}

	public static function getCatalogoNivel(){
		$query = Connection::connect()->prepare("SELECT * FROM catalogo WHERE nivel > 2");
		$query->execute();
		return $query->fetchAll();
	}

	public static function get_catalogo_nivel($nivel,$busqueda){
		$sql = "";
		$sql .= "SELECT * FROM catalogo WHERE nivel='".$nivel."'";
		if ($busqueda !== false) {
			$sql .= " AND nombre  LIKE '".'%'.$busqueda.'%'."' OR  codigo LIKE '".'%'.$busqueda.'%'."'";
		}
		$query = Connection::connect()->prepare($sql);
		
		$query->execute();
		return $query->fetchAll();
	}
}


?>