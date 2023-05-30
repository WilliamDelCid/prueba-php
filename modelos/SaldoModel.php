<?php
require_once "../bd/conexion.php";
class SaldoModel{

	public static function get_nombre($id){

		$query = Conexion::Conectar()->prepare("SELECT nombre FROM saldo WHERE id=:id");
		$query->bindParam(":id",$id,PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		return $data["nombre"];
	}
}