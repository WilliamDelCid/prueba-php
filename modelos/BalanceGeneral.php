<?php
include_once 'balancegeneralmodel.php';

if ($op==2) {
?>
	<link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
	<link href="../css/theme.css" rel="stylesheet" media="print">
	<script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
	<script src="../js/main.js"></script>
<?php
}

$html = "";

$html .= "<h3 style='text-align:center;'>THE BEER S.A.</h3><br>"; 
$html .= "<h3 style='text-align:center;'>BALANCE GENERAL</h3><br>"; 
$html .= "<h4 style='text-align:center;'>DEL ".date("d-m-Y", strtotime($fecha_inicio))." AL ". date("d-m-Y", strtotime($fecha_fin))."</h4>"; 

	$ventas = DetalleModel::estado_resultado(5101,$fecha_inicio,$fecha_fin);
	$devoluciones_sobre_ventas = DetalleModel::estado_resultado(4104,$fecha_inicio,$fecha_fin);
	$rebajas_sobre_ventas = DetalleModel::estado_resultado(4105,$fecha_inicio,$fecha_fin);

	$rebajas_y_devoluciones_sobre_ventas = $devoluciones_sobre_ventas + $rebajas_sobre_ventas;
	$ventas_netas = $ventas - $rebajas_y_devoluciones_sobre_ventas;
	
	$compras = DetalleModel::estado_resultado(4101,$fecha_inicio,$fecha_fin);
	$gastos_sobre_compra = DetalleModel::estado_resultado(4102,$fecha_inicio,$fecha_fin);
	$compras_totales = $compras + $gastos_sobre_compra;

	$devoluciones_sobre_compras = DetalleModel::estado_resultado(5103,$fecha_inicio,$fecha_fin);
	$rebajas_sobre_compras = DetalleModel::estado_resultado(5102,$fecha_inicio,$fecha_fin);

	$rebajas_y_devoluciones_sobre_compras = $devoluciones_sobre_compras + $rebajas_sobre_compras;

	$compras_netas = $compras_totales - $rebajas_y_devoluciones_sobre_compras;
	$inventario_inicial = DetalleModel::estado_resultado(1107,$fecha_inicio,$fecha_fin);
	$mercaderia_disponible = $compras_netas + $inventario_inicial;

	$costo_venta = $mercaderia_disponible - $inventario_final; 
	$utilidad_bruta = $ventas_netas - $costo_venta; 

	$gasto_venta =
	DetalleModel::estado_resultado(4106,$fecha_inicio,$fecha_fin);
	$gasto_administracion =
	DetalleModel::estado_resultado(4107,$fecha_inicio,$fecha_fin);
	$gasto_financiero =
	DetalleModel::estado_resultado(4109,$fecha_inicio,$fecha_fin);
	$gastos_operacion = $gasto_venta + $gasto_administracion + $gasto_financiero;
	$utilidad_operacion = $utilidad_bruta - $gastos_operacion; 
	$otros_gastos = DetalleModel::estado_resultado(4108,$fecha_inicio,$fecha_fin);
	$otros_productos = DetalleModel::estado_resultado(5202,$fecha_inicio,$fecha_fin);
	$utilidad_antes_reserva = $utilidad_operacion - $otros_gastos +
	$otros_productos; 
	$reserva_legal = $utilidad_antes_reserva * 0.07;
	$utilidad_antes_impuesto = $utilidad_antes_reserva - $reserva_legal;
	$porcentaje = 0.25; 
	if ($ventas > 25000) { 
		$porcentaje = 0.25; 
	}
	$impuesto_sobre_renta = $utilidad_antes_impuesto * $porcentaje;
	$utilidad_ejercicio = $utilidad_antes_impuesto - $impuesto_sobre_renta;

	
	$html.= "<br><table class='table'>"; 
	$html .= "<tr>";
	$html .="<td class='bg-primary text-white'><strong>ACTIVO CORRIENTE</strong></td>";
	$html .= "<td class='bg-primary text-white'></td>";
	$html .= "</tr>";
	$cuentas = DetalleModel::balanceG(11);
	$cuentaA = 0.0;
	$total_activo_corriente = 0.0;
		foreach ($cuentas as $cuenta) {	
			
			$html .= "<tr>";
			
			$data = DetalleModel::libroMayor2($cuenta["codigo"],false,$fecha_inicio,$fecha_fin);
			$total_final = DetalleModel::total($data);
			$total_final = str_replace("-","",$total_final);
			if($total_final>0.00){

			$html .= "<td class='text-dark'>".$cuenta["nombre"]."</td>";
			$busqueda = strpos($cuenta["nombre"], "(CR)");
			if ($busqueda !== false) {
				$total_activo_corriente = $total_activo_corriente - $total_final;
			}else{
				$total_activo_corriente = $total_activo_corriente + $total_final;
			}
			
			$html .= "<td class='text-dark'> $ ".number_format($total_final   , 2, '.', ',') ."</td>";
			$html .= "</tr>";
 
			}
		}
			$html .= "<tr class='col-lg-11'>";
			$html .= "<td class='text-dark'>INVENTARIO  </td>";
			$html .= "<td class='text-dark'> $ ". number_format($inventario_final  , 2, '.', ',')."</td>";
			$html .= "</tr>";

			$html .= "<tr>";
			$html .= "<td class='text-dark bg-light'><b>TOTAL ACTIVO CORRIENTE</b>  </td>";
			$html .= "<td class='text-primary bg-light'><b> $ ". number_format($inventario_final + $total_activo_corriente , 2, '.', ',')."</b></td>";
			$html .= "</tr>";

			$html .= "<tr>";
			$html .="<td></td>";
			$html .= "<td></td>";
			$html .= "</tr>";

			
			$html .= "<tr>";
			$html .="<td class='bg-primary text-white'><strong>ACTIVO NO CORRIENTE</strong></td>";
			$html .= "<td class='bg-primary text-white'></td>";
			$html .= "</tr>";
				$cuentas = DetalleModel::balanceG(12);
				$total_activo_no_corriente = 0.0;
				$cadena = "";
				foreach ($cuentas as $cuenta) {
					$html .= "<tr>";
					$data = DetalleModel::libroMayor2($cuenta["codigo"],false,$fecha_inicio,$fecha_fin);
					$total_final = DetalleModel::total($data);
					$total_final = str_replace("-","",$total_final);
					if($total_final>0.00){
						$html .= "<td class='text-dark'>".$cuenta["nombre"]."</td>";
					$busqueda2 = strpos($cuenta["nombre"], "(CR)");
					if ($busqueda2 !== false) {
						$total_activo_no_corriente = $total_activo_no_corriente - $total_final;
						$cadena .= $total_activo_no_corriente . " -" . $total_final;
					}else{
						$total_activo_no_corriente = $total_activo_no_corriente + $total_final;
						$cadena .= $total_activo_no_corriente . " + " . $total_final;
					}


			$html .= "<td class='text-dark'> $ ".number_format($total_final   , 2, '.', ',') ."</td>";
			$html .= "</tr>";
		}
		}

			$html .= "<tr>";
			$html .= "<td class='text-dark bg-light'><b>TOTAL ACTIVO NO CORRIENTE</b> </td>";
			$html .= "<td class='text-primary bg-light'><b> $ ". number_format($total_activo_no_corriente , 2, '.', ',')."</b></td>";
			$html .= "</tr>";

			$html .= "<tr>";
			$html .="<td></td>";
			$html .= "<td></td>";
			$html .= "</tr>";

			$html .= "<tr>";
						$html .= "<td class='text-dark bg-warning'><b>TOTAL ACTIVOS  </b></td>";
						$html .= "<td class='text-dark bg-warning'><b> $ ". number_format($total_activo_no_corriente + $total_activo_corriente+$inventario_final , 2, '.', ',')."</b></td>";
						$html .= "</tr>";

			$html .= "<tr>";
			$html .="<td></td>";
			$html .= "<td></td>";
			$html .= "</tr>";

			$html .= "<tr>";
			$html .="<td class='bg-primary text-white'><strong>PASIVO CORRIENTE</strong></td>";
			$html .= "<td class='bg-primary text-white'></td>";
			$html .= "</tr>";
					$cuentas = DetalleModel::balanceG(21);
					$total_pasivo_corriente = 0.0;
				foreach ($cuentas as $cuenta) {
					
						$html .= "<tr>";
					
					$data = DetalleModel::libroMayor2($cuenta["codigo"],false,$fecha_inicio,$fecha_fin);

					$total_final2 = DetalleModel::total2($data);

					if($total_final2 > 0.00){
					$html .= "<td class='text-dark'>".$cuenta["nombre"]."</td>";	
					$html .= "<td class='text-dark'> $ ".str_replace("-","",number_format($total_final2   , 2, '.', ',')) ."</td>";
					$html .= "</tr>";
					$total_pasivo_corriente = $total_pasivo_corriente + $total_final2;
					}
				}
					if(DetalleModel::prueba()){

						$html .= "<tr>";
					$html .= "<td class='text-dark'>IMPUESTO SOBRE RENTA </td>";
					$html .= "<td class='text-dark'> $ ". number_format($impuesto_sobre_renta  , 2, '.', ',')."</td>";
					$html .= "</tr>";

					$html .= "<tr>";
					$html .= "<td class='text-dark bg-light'><b>TOTAL PASIVO CORRIENTE</b> </td>";
					$html .= "<td class='text-primary bg-light'><b> $ ". number_format($total_pasivo_corriente + $impuesto_sobre_renta , 2, '.', ',')."</b></td>";
					$html .= "</tr>";
					}else{
						$html .= "<tr>";
					$html .= "<td class='text-dark bg-light'><b>TOTAL PASIVO CORRIENTE </b></td>";
					$html .= "<td class='text-primary bg-light'><b> $ ". number_format($total_pasivo_corriente , 2, '.', ',')."</b></td>";
					$html .= "</tr>";
					}

					$html .= "<tr>";
					$html .="<td></td>";
					$html .= "<td></td>";
					$html .= "</tr>";

					$html .= "<tr>";
					$html .="<td class='bg-primary text-white'><strong>PASIVO NO CORRIENTE</strong></td>";
					$html .= "<td class='bg-primary text-white'></td>";
					$html .= "</tr>";
							$cuentas = DetalleModel::balanceG(22);
							$total_pasivo_no_corriente = 0.0;
						foreach ($cuentas as $cuenta) {
							
								$html .= "<tr>";
							
							$data = DetalleModel::libroMayor2($cuenta["codigo"],false,$fecha_inicio,$fecha_fin);
							$total_final = DetalleModel::total2($data);
							if($total_final > 0.00){
							$html .= "<td class='text-dark'>".$cuenta["nombre"]."</td>";
							$total_pasivo_no_corriente = $total_pasivo_no_corriente + $total_final;
							$html .= "<td class='text-dark'> $ ".str_replace("-","",number_format($total_final   , 2, '.', ',')) ."</td>";
							$html .= "</tr>";
							}
							
						}

			$html .= "<tr>";
			$html .= "<td class='text-dark bg-light'><b>TOTAL PASIVO NO CORRIENTE </b></td>";
			$html .= "<td class='text-primary bg-light'><b> $ ". number_format($total_pasivo_no_corriente , 2, '.', ',')."</b></td>";
			$html .= "</tr>";

			$html .= "<tr>";
			$html .="<td></td>";
			$html .= "<td></td>";
			$html .= "</tr>";

			$html .= "<tr>";
						$html .= "<td class='text-dark bg-warning'><b>TOTAL PASIVOS  </b></td>";
						$html .= "<td class='text-dark bg-warning'><b> $ ". number_format($total_pasivo_no_corriente +$impuesto_sobre_renta+ $total_pasivo_corriente , 2, '.', ',')."</b></td>";
						$html .= "</tr>";

			$html .= "<tr>";
			$html .="<td></td>";
			$html .= "<td></td>";
			$html .= "</tr>";	

			$html .= "<tr>";
			$html .="<td class='bg-primary text-white'><strong>CAPITAL</strong></td>";
			$html .= "<td class='bg-primary text-white'></td>";
			$html .= "</tr>";
					$cuentas = DetalleModel::balanceG(31);
					$total_capital = 0.0;
				foreach ($cuentas as $cuenta) {	
						$html .= "<tr>";
					
					$data = DetalleModel::libroMayor2($cuenta["codigo"],false,$fecha_inicio,$fecha_fin);
					$total_final_capital = DetalleModel::total2($data);
					$total_capital=$total_capital+$total_final_capital;
					if($total_final_capital>0.00){
					$html .= "<td class='text-dark'>".$cuenta["nombre"]."</td>";
					$html .= "<td class='text-dark'> $ ".str_replace("-","",number_format($total_final_capital   , 2, '.', ',')) ."</td>";
					$html .= "</tr>";
				}
				}  
				$html .= "<tr>";
					$html .= "<td class='text-dark'>RESERVA LEGAL </td>";
					$html .= "<td class='text-dark'> $ ". number_format($reserva_legal  , 2, '.', ',')."</td>";
					$html .= "</tr>";
				$html .= "<tr>";
					$html .= "<td class='text-dark'>UTILIDAD DEL EJERCICIO </td>";
					$html .= "<td class='text-dark'> $ ". number_format($utilidad_ejercicio  , 2, '.', ',')."</td>";
					$html .= "</tr>";
		

			$html .= "<tr>";
				$html .= "<td class='text-dark bg-warning'><b>TOTAL CAPITAL </b> </td>";
				$html .= "<td class='text-dark bg-warning'><b> $ ". number_format($total_capital + $reserva_legal+$utilidad_ejercicio , 2, '.', ',')."</b></td>";
			$html .= "</tr>";
	$html .= "</table>";

	$html .= "<br><table class='table'>";
			$html .= "<tr>";
				$html .= "<td class='text-dark bg-light'><b>TOTAL ACTIVOS </b> </td>";
				$html .= "<td class='text-primary bg-light'><b> $ ". number_format($total_activo_no_corriente + $total_activo_corriente+$inventario_final , 2, '.', ',')."</b></td>";
				$html .= "<td class='text-dark bg-light'><b>TOTAL PASIVOS + CAPITAL </b> </td>";
				$html .= "<td class='text-primary bg-light'><b> $ ". number_format($total_pasivo_no_corriente +$impuesto_sobre_renta+ $total_pasivo_corriente+$total_capital + $reserva_legal+$utilidad_ejercicio , 2, '.', ',')."</b></td>";
			$html .= "</tr>";
	$html .= "</table>";



	if ($op==2) {

		$html .= "<div class='row'>";
		$html .= "<div class='col-lg-4'>";
		$html .= "<p style='text-align:center;'>F__________________________</p>";
		$html .= "<p style='text-align:center;'>Contador</p>";
		$html .= "</div>";
		$html .= "<div class='col-lg-4'>";
		$html .= "<p style='text-align:center;'>F__________________________</p>";
		$html .= "<p style='text-align:center;'>Representante Legal</p>";
		$html .= "</div>";
		$html .= "<div class='col-lg-4'>";
		$html .= "<p style='text-align:center;'>F__________________________</p>";
		$html .= "<p style='text-align:center;'>Auditor Externo</p>";
		$html .= "</div>";
		$html .= "</div>";
		echo $html;
		echo "<script>window.print();</script>";
	}else if ($op==1){
		$html .= "<br><br><br><div class='row'>";
		$html .= "<div class='col-lg-4'>";
		$html .= "<p style='text-align:center;' class='text-dark'>F__________________________</p>";
		$html .= "<p style='text-align:center;' class='text-dark'>Contador</p>";
		$html .= "</div>";
		$html .= "<div class='col-lg-4'>";
		$html .= "<p style='text-align:center;' class='text-dark'>F__________________________</p>";
		$html .= "<p style='text-align:center;' class='text-dark'>Representante Legal</p>";
		$html .= "</div>";
		$html .= "<div class='col-lg-4'>";
		$html .= "<p style='text-align:center;' class='text-dark'>F__________________________</p>";
		$html .= "<p style='text-align:center;' class='text-dark'>Auditor Externo</p>";
		$html .= "</div>";
		$html .= "</div>";
		echo $html;
	}
