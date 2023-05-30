<?php

require_once "../bd/conexion.php";
	class CatalogoController{

		public static function listar(){

			$respuesta = CatalogoModel::listar();
			return $respuesta;
		}

		public static function listar_tipo(){

			$respuesta = CatalogoModel::listar_tipo();
			return $respuesta;
		}

		public static function listar_saldo(){

			$respuesta = CatalogoModel::listar_saldo();
			return $respuesta;
		}

		public static function  comprobarCodigo($codigo){
			$respuesta = CatalogoModel::comprobarCodigo($codigo);
			if (!$respuesta) {
				return true;
			}else{
				return false;
			}

		}

		public static function  comprobarHijas($codigo){
			$respuesta = CatalogoModel::comprobarHijas($codigo);
			if (!$respuesta) {
				return true;
			}else{
				return false;
			}

		}

		public static function  obtenerHijas($codigo){
			$respuesta = CatalogoModel::comprobarHijas($codigo);
			return $respuesta;

		}


		public static function getCatalogoNivel(){

			return CatalogoModel::getCatalogoNivel();
		}
	}


?>