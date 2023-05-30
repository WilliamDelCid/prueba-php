<?php
session_start();

if ($_SESSION["s_usuario"] === null) {
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
$consulta = "SELECT * FROM partida";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$cierre1 = "SELECT * FROM partida WHERE cierre=2";
$algo = $conexion->prepare($cierre1);
$algo->execute();
$cierre = $algo->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
  <div class="container">
    <br>
    <div class="row ">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-primary text-white">
          <H2 style="color: white;"><i class="fas fa-list"></i> Lista de Partidas</H2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12 text-white">
                <?php if (!$cierre) { ?>
                  <a href="../vistas/nuevaPartida.php" class="btn btn-success btn-rounded btn-fw fas fa-plus-circle">Nueva Partida</a>
                <?php } ?>
                <button type="button" class="btn btn-dark btn-rounded btn-fw fas fa-plus-circle" data-numero="1" id="pdf" data-toggle="modal" data-target="#modal_pdf">Generar PDF </button>
              </div>

            </div>
            <br><br>
            <div class="responsive-table">
              <table class="table" id="tablaPartida">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>Nro</th>
                    <th>Fecha</th>
                    <th>Asiento de Apertura</th>
                    <th> ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀Acciones</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  foreach ($data as $dat) {

                  ?>
                    <tr>
                      <td><?php echo $dat["idpartida"]; ?></td>
                      <td><?php echo $dat["fecha"]; ?></td>
                      <td><?php echo $dat["descripcion"]; ?></td>
                      <td>
                        <div class="text-center">

                          <button class="btn btnVer" style="background-color:#1b9e1d;border: 0px !important;color:white;" data-id="<?php echo $dat["idpartida"]; ?>" id="ver_partida" data-toggle="modal" data-target="#modal-default">Ver Detalle</button>
                          <?php if (!$cierre) { ?>
                            <a href="editarPartida.php?id=<?php echo $dat['idpartida']; ?>"><button class='btn btn-primary btnEditar'>Editar</button></a>

                            <button class='btn btn-danger btnDesactivar' data-id="<?php echo $dat["estado"]; ?>">Desactivar</button>
                          <?php
                          }
                          ?>
                        </div>
                      </td>
                    </tr>

                  <?php
                  }
                  ?>

                </tbody>
              </table>
            </div>




          </div>
        </div>





      </div>
    </div>
</section>
<!-- end: content -->

<?php
require_once '../partes/inferior2.php';
?>


<script type="text/javascript" src="../jsvistas/jsPartida.js"></script>




<div class="modal fade" id="modalDesactivar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="exampleModalCenterTitle"><i class="fa fa-trash"></i> Cambiar el estado de la Partida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="formDesactivar" method="POST" action="../modelos/partida.php?op=3">
        <div class="modal-body">
          <div class="form-group">

            <input type="text" class="form-control" style="border: 0;  background-color: #eee;" id="estado" name="estado" readonly>
            <div class="row">
              <div class="col">
                <label class="col-form-label">Codigo:</label>
              </div>
              <div class="col">
                <input type="text" class="form-control bg-white text-dark" id="id2" name="id2" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="col-form-label">Asiento de la Partida:</label>
              </div>
              <div class="col">
                <input type="text" class="form-control bg-white text-dark" id="nombre2" name="nombre2" readonly>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
          <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal  fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalCenterTitle"><i class="fa fa-eye"></i>DETALLES DE LA PARTIDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_ver_partida">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>

</div>
<script type="text/javascript">
  function verificar(pagina) {

    var tamanio = document.getElementById('tamanio').value;
    var orientacion = document.getElementById('orientacion').value;

    window.open(pagina + '?orientacion=' + orientacion + '&format=' + tamanio, '_blank');

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
  
                                        <td style="text-align: center;"> <button type="button" class="btn btn-info" onclick="verificar('../reportePDF/pdf.php')">Generar PDF</button>
                                        </td>
</form>
</div>

</div>

</div>

<script src="assets/js/vendor/popper.min.js"></script>