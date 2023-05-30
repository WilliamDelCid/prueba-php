
<?php
include_once '../bd/conexion.php';

class Mayor{


	public static function libroMayor($codigo,$busqueda,$inicio = false,$final = false){
		$sql = "";
		$sql .= 'SELECT p.fecha,p.idpartida,c.codigo,p.descripcion,if(dd.movimiento = "CARGO",dd.monto,0) as  debe ,if(dd.movimiento = "ABONO",dd.monto,0) as  haber,(SELECT nombre FROM saldo WHERE id=c.saldo) as saldo,c.nombre as cuenta   FROM detallediario dd INNER JOIN catalogo c on dd.codigo=c.codigo INNER JOIN partida p ON dd.idpartida=p.idpartida WHERE c.codigo LIKE "'.$codigo.'%'.'" AND p.estado=1';
		if ($busqueda !== false) {
			$sql .=  ' AND c.nombre LIKE "'.'%'.$busqueda.'%'.'" ';
		}

		if ($inicio !== false AND $final !== false) {
			$sql .=  ' AND p.fecha BETWEEN "'.$inicio.'" AND "'.$final.'"';
		}

			$sql .= ' ORDER BY p.fecha ASC';
		$query = Conexion::Conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	
}