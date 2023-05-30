<?php
//if(isset($_POST["generar"])){
    //Incluimos la librería
    require_once 'php/html2pdf.class.php';
     
    //Recogemos el contenido de la vista
    ob_start(); 
    require_once '../docs/reportelibrocxpmensual.php';
    $html=ob_get_clean(); 
 
    //Pasamos esa vista a PDF
     
    //Le indicamos el tipo de hoja y la codificación de caracteres P L
    $mipdf=new HTML2PDF('L','Letter','es','true','UTF-8', array(10, 10, 10, 20));
	
 
    //Escribimos el contenido en el PDF
    $mipdf->writeHTML($html);
	
 
    //Generamos el PDF
    $mipdf->Output('PdfGeneradoPHP.pdf');
 
//}
?>