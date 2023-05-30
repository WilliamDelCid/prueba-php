
	<link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
	<link href="../css/theme.css" rel="stylesheet" media="print">
	<script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
	<script src="../js/main.js"></script>
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM catalogo";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

$html = "";
$html .= "<br>";
$html .= "<h3 style='text-align:center;'>CATALOGO DE CUENTAS</h3><br>"; 
$html .= "<h3 style='text-align:center;'>SISTEMA CONTABLE</h3><br>"; 

	
	$html.= "<br><table class='table'>"; 
	$html .= "<tr>";
	$html .="<td class='bg-primary text-dark'><strong>CODIGO</strong></td>";
	$html .= "<td class='bg-primary text-dark'><strong>CUENTA</strong></td>";
	$html .= "</tr>";
	
		foreach ($data as $dat) {	
			
			$html .= "<tr>";
			$html .= "<td class='text-dark'>".$dat["codigo"]."</td>";
			$html .= "<td class='text-dark'>".$dat["nombre"]."</td>";
			$html .= "</tr>";
 
			}
		
			
		echo $html;
		echo "<script>window.print();</script>";
	
		
	
