<?php

require_once "../bd/conexion.php";
?>

<?php 

require_once "../modelos/DetalleModel.php";
require_once "../modelos/PartidaModel.php";
require_once "../modelos/CatalogoController.php";

extract($_REQUEST);
$html = "";


$ventas = DetalleModel::estado_resultado(5101);
	$devoluciones_sobre_ventas = DetalleModel::estado_resultado(4104);
	$rebajas_sobre_ventas = DetalleModel::estado_resultado(4105);

	$rebajas_y_devoluciones_sobre_ventas = $devoluciones_sobre_ventas + $rebajas_sobre_ventas;
	$ventas_netas = $ventas - $rebajas_y_devoluciones_sobre_ventas;
	
	$compras = DetalleModel::estado_resultado(4101);
	$gastos_sobre_compra = DetalleModel::estado_resultado(4102);
	$compras_totales = $compras + $gastos_sobre_compra;

	$devoluciones_sobre_compras = DetalleModel::estado_resultado(5103);
	$rebajas_sobre_compras = DetalleModel::estado_resultado(5102);

	$rebajas_y_devoluciones_sobre_compras = $devoluciones_sobre_compras + $rebajas_sobre_compras;

	$compras_netas = $compras_totales - $rebajas_y_devoluciones_sobre_compras;
	$inventario_inicial = DetalleModel::estado_resultado(1107);
	$mercaderia_disponible = $compras_netas + $inventario_inicial;

	$costo_venta = $mercaderia_disponible - $inventario_final; $utilidad_bruta =
	$ventas_netas - $costo_venta; $gasto_venta =
	DetalleModel::estado_resultado(4106);
	$gasto_administracion =
	DetalleModel::estado_resultado(4107);
	$gasto_financiero =
	DetalleModel::estado_resultado(4109);
	$gastos_operacion = $gasto_venta + $gasto_administracion + $gasto_financiero;
	$utilidad_operacion = $utilidad_bruta - $gastos_operacion; $otros_gastos =
	DetalleModel::estado_resultado(4108);
	$otros_productos =
	DetalleModel::estado_resultado(5202);
	$utilidad_antes_reserva = $utilidad_operacion - $otros_gastos +
	$otros_productos; $reserva_legal = $utilidad_antes_reserva * 0.07;
	$utilidad_antes_impuesto = $utilidad_antes_reserva - $reserva_legal;
	$porcentaje = 0.25; 
	if ($ventas > 25000) { 
		$porcentaje = 0.30; 
	}
	$impuesto_sobre_renta = $utilidad_antes_impuesto * $porcentaje;
	$utilidad_ejercicio = $utilidad_antes_impuesto - $impuesto_sobre_renta;

	
	$cierre = 1;
	$activo = 1;
	$fecha = date("Y-m-d");

	//PRIMERA PARTIDA

	$iva_debito_fiscal = DetalleModel::estado_resultado(2105);
	$iva_credito_fiscal = DetalleModel::estado_resultado(1109);

	echo "llego aqui";

	if ($iva_debito_fiscal > 0) { 

			$descripcion = "LIQUIDACION DE IVA ";
			$id_partida = PartidaModel::sgtePartida()["id"] + 1;
			$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo);
			$id_partida_ = PartidaModel::agregarPartidaID($data_partida);

				$ventas_netas3 = array("id" => $id_partida_,
							  "codigo" => 2105,
							  "monto" => $iva_debito_fiscal, 
							  "movimiento" => "CARGO");

		DetalleModel::agregarDetalle($ventas_netas3);


			if($iva_credito_fiscal > $iva_debito_fiscal){
					$ventas_netas3 = array("id" => $id_partida_,
							  "codigo" => 1109,
							  "monto" => $iva_debito_fiscal,
							  "movimiento" => "ABONO");

		DetalleModel::agregarDetalle($ventas_netas3);

			}else{
					if($iva_credito_fiscal==0){

						$ventas_netas3 = array("id" => $id_partida_,
							  "codigo" => 220101,
							  "monto" => $iva_debito_fiscal,
							  "movimiento" => "ABONO");
						DetalleModel::agregarDetalle($ventas_netas3);

					}else if($iva_credito_fiscal == $iva_debito_fiscal){

				$ventas_netas3 = array("id" => $id_partida_,
							  "codigo" => 1109,
							  "monto" => number_format($iva_credito_fiscal, 2, ',', ','),
							  "movimiento" => "ABONO");

				DetalleModel::agregarDetalle($ventas_netas3);
				
				}else{
					$ventas_netas3 = array("id" => $id_partida_,
							  "codigo" => 1109,
							  "monto" => number_format($iva_credito_fiscal, 2, ',', ','),
							  "movimiento" => "ABONO");

				DetalleModel::agregarDetalle($ventas_netas3);

				$diferencia = $iva_debito_fiscal - $iva_credito_fiscal;
				$ventas_netas3 = array("id" => $id_partida_,
							  "codigo" => 220101,
							  "monto" => number_format($diferencia, 2, ',', ','),
							  "movimiento" => "ABONO");

				DetalleModel::agregarDetalle($ventas_netas3);
				}

			}

	}



	//DETERMINAR VENTAS NETAS

	$descripcion = "DETERMINAR VENTAS NETAS";
	$id_partida = PartidaModel::sgtePartida()["id"] + 1;
		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);

		$ventas_netas1 = array("id" => $id_partida_,
							  "codigo" => 5101,
							  "monto" =>$rebajas_y_devoluciones_sobre_ventas,
							  "movimiento" => "CARGO");

		DetalleModel::agregarDetalle($ventas_netas1);

		$ventas_netas2 = array("id" => $id_partida_,
							  "codigo" => 4104,
							  "monto" => $devoluciones_sobre_ventas,
							  "movimiento" => "ABONO");

		DetalleModel::agregarDetalle($ventas_netas2);
		$ventas_netas3 = array("id" => $id_partida_,
							  "codigo" => 4105,
							  "monto" => $rebajas_sobre_ventas,
							  "movimiento" => "ABONO");

		DetalleModel::agregarDetalle($ventas_netas3);



		//DETERMINAR COMPRAS TOTALES


		$descripcion = "DETERMINAR COMPRAS TOTALES";

		$id_partida = PartidaModel::sgtePartida()["id"] + 1;

		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo
							);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);

		$compras1 = array("id" => $id_partida_,
							  "codigo" => 4101,
							  "monto" =>$gastos_sobre_compra,
							  "movimiento" => "CARGO");

		DetalleModel::agregarDetalle($compras1);

		$compras2 = array("id" => $id_partida_,
							  "codigo" => 4102,
							  "monto" => $gastos_sobre_compra,
							  "movimiento" => "ABONO");

		DetalleModel::agregarDetalle($compras2);



		//DETERMINAR COMPRAS NETAS

		$descripcion = "DETERMINAR COMPRAS NETAS";


		$id_partida = PartidaModel::sgtePartida()["id"] + 1;
		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo
							);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);

		$compras_netas2 = array("id" => $id_partida_,
							  "codigo" => 5103,
							  "monto" => $devoluciones_sobre_compras,
							  "movimiento" => "CARGO");

		DetalleModel::agregarDetalle($compras_netas2);
		$compras_netas3 = array("id" => $id_partida_,
							  "codigo" => 5102,
							  "monto" => $rebajas_sobre_compras,
							  "movimiento" => "CARGO");

		DetalleModel::agregarDetalle($compras_netas3);

		$compras_netas1 = array("id" => $id_partida_,
							  "codigo" => 4101,
							  "monto" =>$rebajas_y_devoluciones_sobre_compras,
							  "movimiento" => "ABONO");

		DetalleModel::agregarDetalle($compras_netas1);




		//LIQUIDAR INVENTARIO INICIAL

		$descripcion = "LIQUIDAR INVENTARIO INICIAL";

		$id_partida = PartidaModel::sgtePartida()["id"] + 1;
		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo
							);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);


		$liquidar_inventario_inicial1 = array("id" => $id_partida_,
							  "codigo" => 4101,
							  "monto" => $inventario_inicial,
							  "movimiento" => "CARGO");
			DetalleModel::agregarDetalle($liquidar_inventario_inicial1);


		$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => 1107,
							  "monto" => $inventario_inicial,
							  "movimiento" => "ABONO");

		DetalleModel::agregarDetalle($liquidar_inventario_inicial2);

		//APERTURAR INVENTARIO FINAL

		$descripcion = "APERTURAR INVENTARIO FINAL";


		$id_partida = PartidaModel::sgtePartida()["id"] + 1;
		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo
							);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);

		$liquidar_inventario_inicial1 = array("id" => $id_partida_,
							  "codigo" => 1107,
							  "monto" => $inventario_final,
							  "movimiento" => "CARGO");
			DetalleModel::agregarDetalle($liquidar_inventario_inicial1);


		$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => 4101,
							  "monto" => $inventario_final,
							  "movimiento" => "ABONO");

		DetalleModel::agregarDetalle($liquidar_inventario_inicial2);


		//LIQUIDAR CUENTA COMPRAS

		$descripcion = "LIQUIDAR CUENTA COMPRAS";

		$id_partida = PartidaModel::sgtePartida()["id"] + 1;
		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo
							);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);

		$liquidar_inventario_inicial1 = array("id" => $id_partida_,
							  "codigo" => 5101,
							  "monto" => $costo_venta,
							  "movimiento" => "CARGO");
			DetalleModel::agregarDetalle($liquidar_inventario_inicial1);


		$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => 4101,
							  "monto" => $costo_venta,
							  "movimiento" => "ABONO");

		DetalleModel::agregarDetalle($liquidar_inventario_inicial2);


		//DETERMINAR IMPUESTO

		$descripcion = "DETERMINAR IMPUESTO";

		$id_partida = PartidaModel::sgtePartida()["id"] + 1;
		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo
							);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);
			$ven = DetalleModel::estado_resultado2(5101);

		$liquidar_inventario_inicial1 = array("id" => $id_partida_,
							  "codigo" => 5101,
							  "monto" => $ven,
							  "movimiento" => "CARGO");
			DetalleModel::agregarDetalle($liquidar_inventario_inicial1);

			$liquidar_inventario_inicial1 = array("id" => $id_partida_,
							  "codigo" => 5202,
							  "monto" => $otros_productos,
							  "movimiento" => "CARGO");
			DetalleModel::agregarDetalle($liquidar_inventario_inicial1);

			$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => 2108,
							  "monto" => $impuesto_sobre_renta,
							  "movimiento" => "ABONO");

			DetalleModel::agregarDetalle($liquidar_inventario_inicial2);

			$perdidas_ganancias =  ($ven + $otros_productos) - $impuesto_sobre_renta;
			$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => 6101,
							  "monto" => $perdidas_ganancias,
							  "movimiento" => "ABONO");

			DetalleModel::agregarDetalle($liquidar_inventario_inicial2);


			//LIQUIDAR GASTOS

			$descripcion = "LIQUIDAR GASTOS";

		$id_partida = PartidaModel::sgtePartida()["id"] + 1;
		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo
							);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);

			

			$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => 3102,
							  "monto" => $reserva_legal,
							  "movimiento" => "ABONO");

			DetalleModel::agregarDetalle($liquidar_inventario_inicial2);

			$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => 4108,
							  "monto" => $otros_gastos,
							  "movimiento" => "ABONO");

			DetalleModel::agregarDetalle($liquidar_inventario_inicial2);


				$hijos_administracion = DetalleModel::gastos(4107,4);

				if (count($hijos_administracion)  > 0) {
					$total_administracion = 0.0;
					foreach ($hijos_administracion as $ha) {
						
						$codigo = $ha["codigo"];

						$saldo_mayor = DetalleModel::estado_resultado($codigo);
						if ($saldo_mayor > 0) {

							$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $codigo,
							  "monto" => $saldo_mayor,
							  "movimiento" => "ABONO");

							DetalleModel::agregarDetalle($liquidar_inventario_inicial2);

							$total_administracion = $total_administracion + $saldo_mayor;
						}
					}
				}
				

				$hijos_ventas = DetalleModel::gastos(4106,4);

				if (count($hijos_ventas) > 0) {
					$total_ventas = 0.0;
					foreach ($hijos_ventas as $hv) {
						
						$codigo = $hv["codigo"];

						$saldo_mayor = DetalleModel::estado_resultado($codigo);
						if ($saldo_mayor > 0) {

							$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $codigo,
							  "monto" => $saldo_mayor,
							  "movimiento" => "ABONO");

							DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
							$total_ventas = $total_ventas + $saldo_mayor;
						}
					}
				}


				$hijos_financiero = DetalleModel::gastos(4109,4);

				if (count($hijos_financiero) > 0) {
					$total_financiero = 0.0;
					foreach ($hijos_financiero as $hf) {
						
						$codigo = $hf["codigo"];

						$saldo_mayor = DetalleModel::estado_resultado($codigo);
						if ($saldo_mayor > 0) {

							$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $codigo,
							  "monto" => $saldo_mayor,
							  "movimiento" => "ABONO");

							DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
							$total_financiero = $total_financiero + $saldo_mayor;
						}
					}
				}



				$perdidas_ganancias = $reserva_legal + $otros_gastos + $total_administracion + $total_ventas + $total_financiero;


			$liquidar_inventario_inicial1 = array("id" => $id_partida_,
							  "codigo" => 6101,
							  "monto" => $perdidas_ganancias,
							  "movimiento" => "CARGO");
			DetalleModel::agregarDetalle($liquidar_inventario_inicial1);










			//DETERMINAR UTILIDAD DEL EJERCICIO


			$descripcion = "DETERMINAR UTILIDAD DEL EJERCICIO";

		$id_partida = PartidaModel::sgtePartida()["id"] + 1;
		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => $cierre,
							  "activo" => $activo
							);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);
		$perdidas_ganancias = DetalleModel::estado_resultado2(6101);
		$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => 6101,
							  "monto" => $perdidas_ganancias,
							  "movimiento" => "CARGO");

			DetalleModel::agregarDetalle($liquidar_inventario_inicial2);

			$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => 3105,
							  "monto" => $utilidad_ejercicio,
							  "movimiento" => "ABONO");

			DetalleModel::agregarDetalle($liquidar_inventario_inicial2);




			//CIERRE CONTABLE
			$descripcion = "CIERRE CONTABLE";

		$id_partida = PartidaModel::sgtePartida()["id"] + 1;
		$data_partida = array("id" => $id_partida,
							  "fecha" => $fecha ,
							  "descripcion" => $descripcion,
							  "cierre" => 2,
							  "activo" => $activo
							);
		$id_partida_ = PartidaModel::agregarPartidaID($data_partida);


			//PASIVO CORRIENTE
			$pasivo_corriente = DetalleModel::balanceG3(21);

			if (count($pasivo_corriente) > 0) {
				$cuentas_sin_hijas_pasivo_corriente = [];
				foreach ($pasivo_corriente as $pc) {

					$data = DetalleModel::libroMayor($pc["codigo"],false);
					$total_final = DetalleModel::total2($data);
					if(CatalogoController::comprobarHijas($pc["codigo"])){
					if ($total_final > 0) {
						$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $pc["codigo"],
							  "monto" => $total_final,
							  "movimiento" => "CARGO");

						DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
					}
				}else{
					$cuentas = CatalogoModel::obtenerCuentasSinHijas($pc["codigo"]);
					
					foreach ($cuentas as $cu) {
						$cuentas_sin_hijas_pasivo_corriente[] = $cu;
					}	
				}

				}
			}


		$unique_cuentas_sin_hijas_pasivo_corriente = array_unique($cuentas_sin_hijas_pasivo_corriente);
		if (count($unique_cuentas_sin_hijas_pasivo_corriente) > 0) {
			
			foreach ($unique_cuentas_sin_hijas_pasivo_corriente as $ucshpc) {
				$data = DetalleModel::libroMayor($ucshpc,false);
				$total_final = DetalleModel::total($data);

				if ($total_final > 0) {
					$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $ucshpc,
							  "monto" => $total_final,
							  "movimiento" => "ABONO");

					DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
				}
				
			}
			
		}
























			

			//PASIVO NO CORRIENTE
			$pasivo_no_corriente = DetalleModel::balanceG3(22);

			if (count($pasivo_no_corriente) > 0) {
				$cuentas_sin_hijas_pasivo_no_corriente = [];
				foreach ($pasivo_no_corriente as $pnc) {

					$data = DetalleModel::libroMayor($pnc["codigo"],false);
					$total_final = DetalleModel::total2($data);
					if(CatalogoController::comprobarHijas($pnc["codigo"])){
					if ($total_final > 0) {
						$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $pnc["codigo"],
							  "monto" => $total_final,
							  "movimiento" => "CARGO");

						DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
					}

				}else{

					$cuentas = CatalogoModel::obtenerCuentasSinHijas($pnc["codigo"]);
					
					foreach ($cuentas as $cu) {
						$cuentas_sin_hijas_pasivo_no_corriente[] = $cu;
					}	
				}

				}
			}

			$unique_cuentas_sin_hijas_pasivo_no_corriente = array_unique($cuentas_sin_hijas_pasivo_no_corriente);
		if (count($unique_cuentas_sin_hijas_pasivo_no_corriente) > 0) {
			
			foreach ($unique_cuentas_sin_hijas_pasivo_no_corriente as $ucshpnc) {
				$data = DetalleModel::libroMayor($ucshpnc,false);
				$total_final = DetalleModel::total($data);

				if ($total_final > 0) {
					$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $ucshpnc,
							  "monto" => $total_final,
							  "movimiento" => "ABONO");

					DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
				}
				
			}
			
		}
			

				$hijos_administracion = DetalleModel::gastos(1205,4);

				if (count($hijos_administracion)  > 0) {
					$total_administracion = 0.0;
					foreach ($hijos_administracion as $ha) {
						
						$codigo = $ha["codigo"];

						$saldo_mayor = DetalleModel::estado_resultado($codigo);
						if ($saldo_mayor > 0) {

							$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $codigo,
							  "monto" => $saldo_mayor,
							  "movimiento" => "CARGO");

							DetalleModel::agregarDetalle($liquidar_inventario_inicial2);

							$total_administracion = $total_administracion + $saldo_mayor;
						}
					}
				}
				

			//CAPITAL

			$cuentas = DetalleModel::balanceG2(31);
			if (count($cuentas) > 0) {
				foreach ($cuentas as $cuenta) {	
				
					$data = DetalleModel::libroMayor($cuenta["codigo"],false);

					$total_final = DetalleModel::total2($data);
					if ($total_final > 0) {

						$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $cuenta["codigo"],
							  "monto" => $total_final,
							  "movimiento" => "CARGO");

						DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
					}
				} 
			}


		$activo_corriente = DetalleModel::balanceG3(11);

		if (count($activo_corriente) > 0) {
			$cuentas_sin_hijas_activo_corriente = [];
			foreach ($activo_corriente as $ac) {

				$data = DetalleModel::libroMayor($ac["codigo"],false);
				$total_final = DetalleModel::total($data);

				if(CatalogoController::comprobarHijas($ac["codigo"])){
					if ($total_final > 0) {
					$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $ac["codigo"],
							  "monto" => $total_final,
							  "movimiento" => "ABONO");

					DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
					}
				}else{

					$cuentas = CatalogoModel::obtenerCuentasSinHijas($ac["codigo"]);
					
					foreach ($cuentas as $cu) {
						$cuentas_sin_hijas_activo_corriente[] = $cu;
					}


				
				}

				

				
			}
		}

		$unique_cuentas_sin_hijas_activo_corriente = array_unique($cuentas_sin_hijas_activo_corriente);
		if (count($unique_cuentas_sin_hijas_activo_corriente) > 0) {
			
			foreach ($unique_cuentas_sin_hijas_activo_corriente as $ucshac) {
				$data = DetalleModel::libroMayor($ucshac,false);
				$total_final = DetalleModel::total($data);

				if ($total_final > 0) {
					$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $ucshac,
							  "monto" => $total_final,
							  "movimiento" => "ABONO");

					DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
				}
				
			}
			
		}
		













		$activo_no_corriente = DetalleModel::balanceG3(12); 

		if (count($activo_no_corriente) > 0) {
			$cuentas_sin_hijas_activo_no_corriente = [];
			foreach ($activo_no_corriente as $anc) {

				$data = DetalleModel::libroMayor($anc["codigo"],false);
				$total_final = DetalleModel::total($data);
				if(CatalogoController::comprobarHijas($anc["codigo"])){
				if ($total_final > 0) {
					$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $anc["codigo"],
							  "monto" => $total_final,
							  "movimiento" => "ABONO");
 
					DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
				}
			}else{
				$cuentas = CatalogoModel::obtenerCuentasSinHijas($anc["codigo"]);
					
					foreach ($cuentas as $cu) {
						$cuentas_sin_hijas_activo_no_corriente[] = $cu;
					}
			}
			}
		}



		$unique_cuentas_sin_hijas_activo_no_corriente = array_unique($cuentas_sin_hijas_activo_no_corriente);
		if (count($unique_cuentas_sin_hijas_activo_no_corriente) > 0) {
			
			foreach ($unique_cuentas_sin_hijas_activo_no_corriente as $ucshanc) {
				$data = DetalleModel::libroMayor($ucshanc,false);
				$total_final = DetalleModel::total($data);

				if ($total_final > 0) {
					$liquidar_inventario_inicial2 = array("id" => $id_partida_,
							  "codigo" => $ucshanc,
							  "monto" => $total_final,
							  "movimiento" => "ABONO");

					DetalleModel::agregarDetalle($liquidar_inventario_inicial2);
				}
				
			}
			
		}

		echo $inventario_final;
		echo "true";
		