<?php

	require_once "modelos/PartidaModel.php";
	require_once "modelos/DetalleModel.php";
	class PartidaController{



		public static function listar(){

			$respuesta = PartidaModel::listar();
			return $respuesta;
		}
	

		public static function sgtePartida(){
			$respuesta = PartidaModel::sgtePartida();
			return $respuesta["id"] + 1;

		}

		public function getId($id){

		$data = PartidaModel::getId($id);
		return $data;

	}

	public static function sumaMovimiento($partida,$movimiento){
		$data = DetalleModel::sumaMovimiento($partida,$movimiento);
		return $data["total"];
	}

	public static function  comprobarCierre(){
			$respuesta = PartidaModel::comprobarCierre();
			if (!$respuesta) {
				return true;
			}else{
				return false;
			}

		}

	}


?>