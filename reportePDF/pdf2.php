<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

require_once 'php/html2pdf.class.php';

    //Recogemos el contenido de la vista

$orientacion='L';
$format='LETTER';
$nivel='1';
$margen=array(15,15, 15, 15);
ob_start();

require_once '../docs/reporteClasificacion2.php';	
	$nombreFichero="Reporte-clasificacion-".date("HisdmY").".pdf";	


$html=ob_get_clean(); 

    //Pasamos esa vista a PDF

    //Le indicamos el tipo de hoja y la codificación de caracteres P L
$mipdf=new HTML2PDF($orientacion,$format,'es','true','UTF-8', $margen);


    //Escribimos el contenido en el PDF
$mipdf->writeHTML($html);


    //Generamos el PDF

$mipdf->Output($nombreFichero);

//}
?>