<style type="text/css">
    .formatocontenidotabla {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 0.75rem;
    }

    .titulo1 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 8mm;
    }

    .titulo2 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 6mm;
    }

    .titulo3 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 4mm;
    }

    #cabecera {
        background: #eee;
    }

    h2 {
        float: left;
    }

    h3 {
        float: left;
    }

    <?php
    $format = $_REQUEST['format'];
    $orientacion = $_REQUEST['orientacion'];
    
    if ($orientacion == 'P' && $format == 'LETTER') {
        echo 'table{	width: 190mm; }';
    }
    if ($orientacion == 'L' && $format == 'LETTER') {
        echo 'table{	width: 250mm; }';
    }
    if ($orientacion == 'P' && $format == 'LEGAL') {
        echo 'table{	width: 190mm; }';
    }
    if ($orientacion == 'L' && $format == 'LEGAL') {
        echo 'table{	width: 330mm; }';
    }
    ?>
</style>

<page backtop="45mm" backbottom="15mm" footer="page">
    <page_header>
        <?php
        include "../globals/conexion.php";

        date_default_timezone_set('America/El_Salvador');


        ?>
        <table border="0">
       
            <tr> 
               
            <img src="../images/Logi.jpg" style="position: absolute;" />
           
                <td style="width: 30%;  text-align: right;" class="titulotabla">Fecha : <?php echo date("d-m-Y"); ?></td>
            </tr>
            <tr>
                <td style="width: 70%; text-align: center;" class="titulo2"></td>
                <td style="width: 30%;  text-align: right;" class="titulotabla"></td>
            </tr>
            <tr>
                
                <td></td>
            </tr>
            <tr>

                <td></td>
            </tr>
            <tr>
                <td style="width: 100%;  text-align: center;" class="titulo2" colspan="2"><strong>  </strong></td>
    
            </tr>
            <tr>
                <td style="width: 100%;  text-align: center;" class="titulo2" colspan="2"><strong>  </strong></td>
    
            </tr>
            <tr>
                <td style="width: 100%;  text-align: center;" class="titulo2" colspan="2"><strong>Informe de Libro Mayor</strong></td>
    
            </tr>

        </table>
    </page_header>

    <?php

$nivel = $_REQUEST['nivel'];
    $result = $conexion->query("select c.codigo as codigo,c.nombre as nombre,c.nivel as nivel FROM catalogo c WHERE nivel=$nivel");
    if ($result) {
        while ($fila = $result->fetch_object()) {
            $idubicacion = $fila->nombre;
            $ubicacion = $fila->nombre;
         
            $contador = 1;
            

            echo "<p style='text-align:center;background:black;color:white;font-size: xxx-large;'>" . $ubicacion . "</p>";
            echo '<table border="1" rules="all" cellspacing=0 cellpadding=1>
                <tr>
                    <th style="width: 5%; text-align: center; height: 15px">#</th>
                    <th style="width: 5%; text-align: center;"> Fecha</th>
                    <th style="width: 15%; text-align: center;"> Descripción</th>
                    <th style="width: 5%; text-align: center;"> Cargo</th>
                    <th style="width: 5%; text-align: center;"> Abono</th>
                    <th style="width: 5%; text-align: center;"> Saldo</th>
                    
                </tr>';

            $result1 = $conexion->query("select ca.fecha as fecha,ca.descripcion as descrip,c.monto as monto,c.movimiento as movi FROM partida ca inner join detallediario c on ca.idpartida=c.idpartida inner join catalogo cat on c.codigo=cat.codigo WHERE cat.tipo=1");
            if ($result1) {
                while ($fila1 = $result1->fetch_object()) {
                    $a = "$ ";
                    if($fila1->movi=='CARGO'){
                        $cargo = $fila1->monto;
                    }else{
                        $cargo = "0.00";
                    }
                    $sum = $sum + $cargo;
                    if($fila1->movi=='ABONO'){
                        $abono = $fila1->monto;
                    }else{
                        $abono = "0.00";
                    }
                    $sum2 = $sum2+ $abono;
                    $fuc = $sum - $sum2;
                    echo '<tr>';
                    
                    echo '<td style="width: 5%; text-align: center; height: 15px">' . $contador++ . '</td>';
                    echo '<td style="width: 10%; text-align: center;">' . $fila1->fecha . '</td>';
                    echo '<td style="width: 40%; text-align: center;">' . $fila1->descrip . '</td>';
                    echo '<td style="width: 15%; text-align: center;">' . $a. $cargo . '</td>';
                    echo '<td style="width: 15%; text-align: center;">' . $a. $abono . '</td>';
                    echo '<td style="width: 15%; text-align: center;">' . $a. $fuc . '</td>';
                    echo '</tr>';
                }
 
                
            }

            echo '</table>';
            $b = "$";
            echo '<table border="1" rules="all" cellspacing=0 cellpadding=1>
            <tr>
                <th style="width: 5%; text-align: center; height: 15px">Total </th>
                <th style="width: 10%; text-align: center; height: 15px"> </th>
                <th style="width: 40%; text-align: center; height: 15px"> </th>
                <th style="width: 15%; text-align: center; height: 15px; color: red">' . $a. $sum . ' </th>
                <th style="width: 15%; text-align: center; height: 15px; color: red">' . $a. $sum2 . ' </th>
                <th style="width: 15%; text-align: center; color: red"> '.$b.$fuc .'</th>

                
            </tr>';

            echo '</table>';
        }
    }
    ?>
    <page_footer>
    </page_footer>
</page>