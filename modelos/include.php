<?php 
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
 ?>