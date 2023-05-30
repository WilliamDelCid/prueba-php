<?php
require_once DOCUMENT_ROOT."models/connection.php";
class PartidaModel{

	public static function listar(){

		$query = Connection::connect()->prepare("SELECT * FROM partida");
		$query->execute();
		return $query->fetchAll();
	}

	public static function getId($id){
		$query = Connection::connect()->prepare("SELECT p.fecha,p.descripcion,c.codigo,c.nombre,dd.monto,dd.movimiento   FROM partida p  INNER JOIN detallediario dd ON p.idpartida=dd.idpartida INNER JOIN catalogo c ON dd.codigo=c.codigo WHERE p.idpartida=:id");
		$query->bindParam(":id",$id,PDO::PARAM_STR);
		$query->execute();
		return $query->fetchAll();
	}

	public static function sgtePartida(){
		$query = Connection::connect()->prepare("SELECT idpartida as id FROM partida ORDER BY idpartida DESC  LIMIT 1");
		$query->execute();
		return $query->fetch();
	}

	public static function agregarPartida($data){
		$query = Connection::connect()->prepare("INSERT INTO partida(idpartida,fecha,descripcion,cierre,estado) VALUES (:id,:fecha,:descripcion,:cierre,:activo)");
		$query->bindParam(":id",$data["id"],PDO::PARAM_STR);
		$query->bindParam(":fecha",$data["fecha"],PDO::PARAM_STR);
		$query->bindParam(":descripcion",$data["descripcion"],PDO::PARAM_STR);
		$query->bindParam(":cierre",$data["cierre"],PDO::PARAM_STR);
		$query->bindParam(":activo",$data["activo"],PDO::PARAM_INT);
		return $query->execute();
		
	}

	public static function agregarPartidaID($data){
		$cn = Connection::connect();
		$query = $cn->prepare("INSERT INTO partida(idpartida,fecha,descripcion,cierre,estado) VALUES (:id,:fecha,:descripcion,:cierre,:activo)");
		$query->bindParam(":id",$data["id"],PDO::PARAM_STR);
		$query->bindParam(":fecha",$data["fecha"],PDO::PARAM_STR);
		$query->bindParam(":descripcion",$data["descripcion"],PDO::PARAM_STR);
		$query->bindParam(":cierre",$data["cierre"],PDO::PARAM_STR);
		$query->bindParam(":activo",$data["activo"],PDO::PARAM_INT);
		if($query->execute()){
			return $cn->lastInsertId(); 
		}
		
	}
	public static function editarPartida($data){
		$query = Connection::connect()->prepare("UPDATE partida set fecha=:fecha,descripcion=:descripcion,cierre=:cierre WHERE idpartida=:id");
		$query->bindParam(":id",$data["id"],PDO::PARAM_STR);
		$query->bindParam(":fecha",$data["fecha"],PDO::PARAM_STR);
		$query->bindParam(":descripcion",$data["descripcion"],PDO::PARAM_STR);
		$query->bindParam(":cierre",$data["cierre"],PDO::PARAM_STR);
		return $query->execute();
		
	}


	public static function cambiar_estado($estado,$id){
		$query = Connection::connect()->prepare("UPDATE partida SET estado=:estado WHERE idpartida=:id");
		$query->bindParam(":id",$id,PDO::PARAM_INT);
		$query->bindParam(":estado",$estado,PDO::PARAM_INT);
		return $query->execute();
		
	}

	public static function comprobarCierre(){
		$query = Connection::connect()->prepare("SELECT * FROM partida WHERE cierre=2");
		$query->execute();
		return $query->fetch();
	}


	public static function obtenerPartidas(){
		$query = Connection::connect()->prepare("SELECT * from partida WHERE  cierre <> 2");
		$query->execute();
		return $query->fetchAll();
		
	}

	public static function obtenerPartidaCierre(){
		$query = Connection::connect()->prepare("SELECT * from partida WHERE  cierre = 2");
		$query->execute();
		return $query->fetch();
		
	}

	public static function borrarPartidas($id){
		$query = Connection::connect()->prepare("DELETE FROM partida WHERE  idpartida=:id");
		$query->bindParam(":id",$id,PDO::PARAM_INT);
		return $query->execute();
	}



	public static function reset_partida(){
		$query = Connection::connect()->prepare("ALTER TABLE partida AUTO_INCREMENT = 1");
		
		return $query->execute();
	}
}