<?php
include_once '../bd/conexion.php';
class PartidaModel{
public static function editarPartida($data){
		$query = Conexion::Conectar()->prepare("UPDATE partida set fecha=:fecha,descripcion=:descripcion,cierre=:cierre WHERE idpartida=:id");
		$query->bindParam(":id",$data["id"],PDO::PARAM_STR);
		$query->bindParam(":fecha",$data["fecha"],PDO::PARAM_STR);
		$query->bindParam(":descripcion",$data["descripcion"],PDO::PARAM_STR);
		$query->bindParam(":cierre",$data["cierre"],PDO::PARAM_STR);
		return $query->execute();
		
    }		
    public static function comprobar($codigo,$partida){
		$query = Conexion::Conectar()->prepare("SELECT * FROM detallediario WHERE codigo=:codigo AND idpartida=:partida");
		$query->bindParam(":partida",$partida,PDO::PARAM_STR);
		$query->bindParam(":codigo",$codigo,PDO::PARAM_STR);
		$query->execute();
		return $query->fetch();
	}
}