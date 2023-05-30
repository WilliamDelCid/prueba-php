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
                <td style="width: 100%;  text-align: center;" class="titulo2" colspan="2"><strong>Informe de Partidas</strong></td>
    
            </tr>

        </table>
    </page_header>

    <?php


    $result = $conexion->query("select p.idpartida as idubicacion,p.descripcion as ubicacion from  partida p  ORDER BY p.idpartida");
    if ($result) {
        while ($fila = $result->fetch_object()) {
            $idubicacion = $fila->idubicacion;
            $ubicacion = $fila->ubicacion;
         
            $contador = 1;
            

            echo "<p style='text-align:center;background:black;color:white;font-size: xxx-large;'>" . $ubicacion . "</p>";
            

            echo '<table border="1" rules="all" cellspacing=0 cellpadding=1>
                <tr>
                    <th style="width: 5%; text-align: center; height: 15px">#</th>
                    <th style="width: 15%; text-align: center;"> Codigo</th>
                    <th style="width: 15%; text-align: center;"> Debe</th>
                    <th style="width: 15%; text-align: center;"> Haber</th>
                </tr>';

            $result1 = $conexion->query("select dd.codigo as nombreclasificacion,dd.monto as nombreclasificacion1,dd.movimiento as nombreclasificacion2 from detallediario dd inner join partida p on p.idpartida=dd.idpartida  where p.idpartida=$idubicacion order by p.idpartida");
            if ($result1) {
                while ($fila1 = $result1->fetch_object()) {
                    $a = "$ ";
                    if($fila1->nombreclasificacion2=='CARGO'){
                        $cargo = $fila1->nombreclasificacion1;
                    }else{
                        $cargo = "0.00";
                    }
                    if($fila1->nombreclasificacion2=='ABONO'){
                        $abono = $fila1->nombreclasificacion1;
                    }else{
                        $abono = "0.00";
                    }
                    echo '<tr>';
                    
                    echo '<td style="width: 5%; text-align: center; height: 15px">' . $contador++ . '</td>';
                    echo '<td style="width: 30%; text-align: center;">' . $fila1->nombreclasificacion . '</td>';
                    echo '<td style="width: 30%; text-align: center;">' . $a. $cargo . '</td>';
                    echo '<td style="width: 30%; text-align: center;">' . $a. $abono . '</td>';
                    echo '</tr>';
                }
            }

            echo '</table>';
        }
    }
    ?>
    <page_footer>
    </page_footer>
</page>