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

$html .= "<h3 style='text-align:center;'>THE BEER S.A. </h3><br>"; 
$html .= "<h3 style='text-align:center;'>ESTADO DE RESULTADO</h3><br>"; 
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

	$costo_venta = $mercaderia_disponible - $inventario_final; $utilidad_bruta =
	$ventas_netas - $costo_venta; $gasto_venta =
	DetalleModel::estado_resultado(4106,$fecha_inicio,$fecha_fin);
	$gasto_administracion =
	DetalleModel::estado_resultado(4107,$fecha_inicio,$fecha_fin);
	$gasto_financiero =
	DetalleModel::estado_resultado(4109,$fecha_inicio,$fecha_fin);
	$gastos_operacion = $gasto_venta + $gasto_administracion + $gasto_financiero;
	$utilidad_operacion = $utilidad_bruta - $gastos_operacion; $otros_gastos =
	DetalleModel::estado_resultado(4108,$fecha_inicio,$fecha_fin);
	$otros_productos =
	DetalleModel::estado_resultado(5202,$fecha_inicio,$fecha_fin);
	$utilidad_antes_reserva = $utilidad_operacion - $otros_gastos +
	$otros_productos; $reserva_legal = $utilidad_antes_reserva * 0.07;
	$utilidad_antes_impuesto = $utilidad_antes_reserva - $reserva_legal;
	$porcentaje = 0.25; if ($ventas > 25000) { $porcentaje = 0.25; }
	$impuesto_sobre_renta = $utilidad_antes_impuesto * $porcentaje;
	$utilidad_ejercicio = $utilidad_antes_impuesto - $impuesto_sobre_renta; $html
	.= "<table class='table table-bordered table-striped table-hover'>"; $html .=
	"<tr>"; $html .= "<td>VENTAS</td>"; $html .= "<td></td>"; $html .= "<td> $
	".number_format($ventas, 2, ',', ',')."</td>"; $html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>( - ) REBAJAS Y DEVOLUCIONES / VENTAS</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ".number_format($rebajas_y_devoluciones_sobre_ventas, 2, ',', ',')."</td>";

	$html .= "</tr>";


	$html .= "<tr>";
	$html .= "<td>( = ) VENTAS NETAS </td>";
	$html .= "<td></td>";
	$html .= "<td> $ ".number_format($ventas_netas, 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td> ( - ) COSTO DE VENTA</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ".number_format($costo_venta, 2, ',', ',')."</td>";
	$html .= "</tr>";


	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;COMPRAS</td>";
	$html .= "<td> $ ".number_format($compras, 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;( + ) GASTOS / COMPRA</td>";
	$html .= "<td> $ ". number_format($gastos_sobre_compra, 2, ',', ',')."</td>";
	$html .= "</tr>";


	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;( = ) COMPRAS TOTALES</td>";
	$html .= "<td> $ ".  number_format($compras_totales, 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;( - ) REBAJAS Y DEVOLUCIONES / COMPRAS</td>";
	$html .= "<td> $ ".  number_format($rebajas_y_devoluciones_sobre_compras, 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;( = ) COMPRAS NETAS</td>";
	$html .= "<td> $ ". number_format($compras_netas  , 2, ',', ',')."</td>";
	$html .= "</tr>";


	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;( + ) INVENTARIO INICIAL</td>";
	$html .= "<td> $ ". number_format($inventario_inicial  , 2, ',', ',')."</td>";
	$html .= "</tr>";


	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;( = ) MERCADERIA DISPONIBLE</td>";
	$html .= "<td> $ ".  number_format($mercaderia_disponible , 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;( - ) INVENTARIO FINAL </td>";
	$html .= "<td> $ ". number_format($inventario_final  , 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>( = ) UTILIDAD BRUTA</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ".  number_format($utilidad_bruta , 2, ',', ',')."</td>";
	$html .= "</tr>";


	$html .= "<tr>";
	$html .= "<td>( - ) GASTOS DE OPERACION</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ". number_format($gastos_operacion  , 2, ',', ',')."</td>";
	$html .= "</tr>";


	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;GASTO DE VENTA</td>";
	$html .= "<td> $ ". number_format($gasto_venta  , 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;GASTO DE ADMINISTRACION</td>";
	$html .= "<td> $ ".  number_format($gasto_administracion , 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;GASTO FINANCIERO</td>";
	$html .= "<td> $ ".  number_format($gasto_financiero , 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>( = ) UTILIDAD DE OPERACION</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ".  number_format($utilidad_operacion , 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>( - ) OTROS GASTOS</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ". number_format($otros_gastos  , 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>( + ) OTROS INGRESOS</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ".  number_format($otros_productos , 2, ',', ',')."</td>";
	$html .= "</tr>";


	$html .= "<tr>";
	$html .= "<td>( = ) UTILIDAD ANTES DE LA RESERVA</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ". number_format($utilidad_antes_reserva  , 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>( - ) RESERVA LEGAL ( 7% )</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ".  number_format(round($reserva_legal,2) , 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>( = ) UTILIDAD ANTES DEL IMPUESTO</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ".   number_format(round($utilidad_antes_impuesto,2), 2, ',', ',')."</td>";
	$html .= "</tr>";


	$html .= "<tr>";
	$html .= "<td>( - ) IMPUESTO SOBRE RENTA</td>";
	$html .= "<td></td>";
	$html .= "<td> $ ".   number_format(round($impuesto_sobre_renta,2), 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "<tr>";
	$html .= "<td>( = ) UTILIDAD O PERDIDA DEL EJERCICIO</td>";
	$html .= "<td></td>";
	$html .= "<td style='color:black'> $ ".number_format(round($utilidad_ejercicio,2), 2, ',', ',')."</td>";
	$html .= "</tr>";

	$html .= "</table>";

	if (isset($_GET["fecha_inicio"]) AND isset($_GET["fecha_fin"])) {

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
	}else{
		echo $html;
	}
