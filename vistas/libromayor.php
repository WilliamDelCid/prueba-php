<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}

?>
<?php
 require_once '../partes/superior2.php';
?>

<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT DISTINCT c.nivel FROM detallediario dd INNER JOIN catalogo c ON dd.codigo=c.codigo ORDER BY c.nivel ASC";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);



?>
  		
          <!-- start: content -->
          <div id="container">

          <div class="col-md-12" style="padding:20px; ">
				<div class="panel panel-primary" >
			<div class="panel-title" style="color: gold; font-size: xxx-large; font-family: Brush Script MT; background-color: black;" >⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀Libro Mayor</div>

		<div class="panel-body">
				<div class="aligncenter">
				
	<div class="col-lg-13">

		<label for="" style="color: black; font-size: x-large; ">Seleccione el nivel para mostrar su Mayorización</label> <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<div class="row">
		<div class="col-lg-12">


	<select name="" id="cuentas_nivel" >
		<option value="">SELECCIONAR NIVEL</option>
		<?php $numero_mayor = max($data); 
		?>

		<?php for ($i=1; $i <= $numero_mayor["nivel"] ; $i++) { ?> 
			<option value="<?php echo $i; ?>">Nivel <?php echo $i; ?></option>
		<?php } ?>
	
	</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button  style="background-image: url(../images/8.png); height:40px; width:100px; " class="btn  btn-primary cuentas_nivel"  id="btn_imprimir"></button>



	</div>
	
</div>
		</div>


		  </div>
		 
	<div class="col-lg-12" id="resultado">
		
	</div>

		  <?php
  require_once '../partes/inferior2.php';
?>
<script type="text/javascript">
  function verificar(pagina) {

    var tamanio = document.getElementById('tamanio').value;
	var orientacion = document.getElementById('orientacion').value;
	var nivel = document.getElementById('niveleleccion').value;

    window.open(pagina   + '?orientacion=' + orientacion + '&format=' + tamanio + '&nivel=' + nivel);

  }
</script>
<div class="modal  fade" id="modal_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">

  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h4 class="modal-title">PDF</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>

      <form action="productox.php" name="latienda" id="latienda" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" id="bandera" name="bandera">


        <input type="hidden" id="baccion" name="baccion" value="<?php echo $id; ?>">

        <table  class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="text-align: center;">Tama&ntilde;o</th>
              <th style="text-align: center;">Orientaci&oacute;n</th>
			  <th style="text-align: center;">Nivel</th>
              <th style="text-align: center;">Imprimir</th>
              
            </tr>
          </thead>
          <tbody>
          <td>
          <select class="form-control" name="tamanio" id="tamanio">
                                            <option value="LETTER">Carta</option>
                                            <option value="LEGAL">Oficio</option>
                                        </select>
          </td>
          <td>  <select class="form-control" name="orientacion" id="orientacion">
                                            <option value="P">Vertical</option>
                                            <option value="L">Horizontal</option>
                                        </select></td>
										<td>  <select class="form-control" name="niveleleccion" id="niveleleccion">
										    <option value="1">Nivel 1</option>
                                            <option value="2">Nivel 2</option>
											<option value="3">Nivel 3</option>
											<option value="4">Nivel 4</option>
											<option value="5">Nivel 5</option>
											<option value="6">Nivel 6</option>
                                        </select></td>								
  
                                        <td style="text-align: center;"> <button type="button" class="btn btn-info" onclick="verificar('../reportePDF/pdf2.php')">Generar PDF</button>
                                        </td>
</form>
</div>

</div>

</div>

<script src="assets/js/vendor/popper.min.js"></script>


<script type="text/javascript" src="../jsvistas/jsMayor.js"></script>
