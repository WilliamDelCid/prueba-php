<?php 
require_once "../bd/conexion.php";
?>
<?php
require_once "../modelos/CatalogoModel.php";
require_once "../modelos/DetalleModel.php";
require_once "../modelos/SaldoModel.php";
require_once "../modelos/PartidaModel.php";

$partidas = PartidaModel::obtenerPartidas();

	foreach ($partidas as $partida) {
		DetalleModel::borrarDetalle($partida["idpartida"]);
		PartidaModel::borrarPartidas($partida["idpartida"]);

	}

	$partida_cierre = PartidaModel::obtenerPartidaCierre();
	$partida_cierre = $partida_cierre["idpartida"];
	
	$detalle_partida_cierre = DetalleModel::getPartida($partida_cierre);
	
	PartidaModel::reset_partida();
	DetalleModel::reset_detalle();

	$cierre = 0;
	$activo = 1;
	$fecha = date("Y-m-d");
	$descripcion = "INICIO DE OPERACIONES";

	$data_primera_partida = array("id" => 1,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo
							);
	$id_primera_partida = PartidaModel::agregarPartidaID($data_primera_partida);
	

	foreach ($detalle_partida_cierre as $dpc) {
		$movimiento = "ABONO";
			if ($dpc["movimiento"] == "ABONO") {
				$movimiento = "CARGO";
			}
					
			$agregar = array("id" => $id_primera_partida,
							  "codigo" => $dpc["codigo"],
							  "monto" => $dpc["monto"],
							  "movimiento" => $movimiento);

			DetalleModel::agregarDetalle($agregar);
	}



	DetalleModel::borrarDetalle($partida_cierre);
	PartidaModel::borrarPartidas($partida_cierre);


	echo "true";

