<?php 
include_once '../modelos/mayor2.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

extract($_REQUEST);
        $codigos = [];
        $busqueda = false;
		if (isset($busqueda)) {
            
            $sql = "";
            $sql .= "SELECT * FROM catalogo WHERE nivel='".$nivel."'";
            if ($busqueda !== false) {
                $sql .= " AND nombre  LIKE '".'%'.$busqueda.'%'."' OR  codigo LIKE '".'%'.$busqueda.'%'."'";
            }
            $query = $conexion->prepare($sql);
            
            $query->execute();
            $codigos =  $query->fetchAll();
		}else{
            
            $sql = "";
            $sql .= "SELECT * FROM catalogo WHERE nivel='".$nivel."'";
            if ($busqueda !== false) {
                $sql .= " AND nombre  LIKE '".'%'.$busqueda.'%'."' OR  codigo LIKE '".'%'.$busqueda.'%'."'";
            }
            $query = $conexion->prepare($sql);
            
            $query->execute();
            $codigos =  $query->fetchAll();
		}
		


		$html = "";
		
		if (count($codigos) > 0) {
		$html .= "<h2 style='text-align:center; color:black'><strong>THE BEER S.A. </strong> <br></h2><h3 style='text-align:center;color:black''><br></h3><h4 style='text-align:center;color:black''>LIBRO MAYOR de cuenta nivel ".$nivel."</h4>";
		foreach ($codigos as $codigo) {
			$datos = [];
			
            $datos = Mayor::libroMayor($codigo["codigo"],false);
			
			 $cods = array_column($datos, "codigo");
			 $cods_distinct = array_unique($cods);
			
		if(count($cods_distinct) > 0){
           $id = $codigo["saldo"];
		
            $query = $conexion->prepare("SELECT nombre FROM saldo WHERE id=:id");
            $query->bindParam(":id",$id,PDO::PARAM_INT);
            $query->execute();
            $data4 = $query->fetch();
            
		$html .= "<br>";
		$html .= "<div class='panel-heading'>";
		$html .= "<div class='panel-title' style='font-weight:bold;'>";
		$html .= "<center style='color:black'>". " Cuenta : "."<strong>" . $codigo["nombre"].  " </center>";
		$html .= "</div>";
		$html .= "</div>";
		$html .= "<div class='panel-body'>";

		$html .= "<table class='table table-bordered table-striped table-condensed table-hover'  style='text-align:center;'>";
			$html .= "<tr style='background-color:#006400;color:white;border:black;'><th style='text-align:center;border:1px solid #FFFFFF;'>Fecha</th><th style='text-align:center;border:1px solid #74b9ff;'>Codigo</th><th style='text-align:center;border:1px solid #FFFFFF;'>Descripción</th><th style='text-align:center;border:1px solid #FFFFFF;'>Ref</th><th style='text-align:center;border:1px solid #FFFFFF;'>Debe</th><th style='text-align:center;border:1px solid #FFFFFF;'>Haber</th><th style='text-align:center;border:1px solid #FFFFFF;'>Saldo</th></tr>";
		$total_debe = 0.00;
		$total_haber = 0.00;
		$total_final = 0.00;
		$datos2 = [];
		
				 

                 $datos2 = Mayor::libroMayor($codigo["codigo"],false);
		
		foreach ($datos as $d) {
			
			$total_final = number_format(($total_debe + $d["debe"])-($total_haber +$d["haber"]), 2, ",", ".");


			$html .= "<tr><td>".$d["fecha"]."</td><td>".$d["codigo"]."</td><td>".$d["descripcion"]."</td><td>".$d["idpartida"]."</td><td> $ ".$d["debe"]."</td><td> $ ".$d["haber"]."</td><td> $ ".$total_final."</td></tr>";
			
			$total_debe = $total_debe + $d["debe"];
			$total_haber = $total_haber + $d["haber"];
		}

		$html .= "<tr><td style='font-weight:bold;font-size:1.1em;'>TOTAL</td><td></td><td></td><td></td><td style='font-weight:bold;font-size:1.1em;'> $ ".number_format($total_debe, 2, ",", ".") ."</td><td style='font-weight:bold;font-size:1.1em;'> $ ".number_format($total_haber, 2, ",", ".")."</td><td style='color:black'> $ ".str_replace("-","", $total_final)."</td></tr>";
			$html .= "</table>";
			$html .= "</div>";
		$html .= "</div>";
			
		}
			
		}
		
		}else{
			$html .= "<p style='text-align:center;color:red;font-size:1.2em;'><span class='glyphicon glyphicon-remove' style='font-size:1.3em;' aria-hidden='true'></span> No hay cuentas para mostrar</p>";
		}

		echo $html;		
	
	if (isset($_GET["nivel"]) OR isset($_GET["busqueda"])) {
		echo "<script>window.print();</script>";
	}
