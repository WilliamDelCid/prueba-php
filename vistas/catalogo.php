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

$consulta = "SELECT * FROM catalogo";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
      
      
            <!-- TABLA-->
            <section>
                <div class="container">
                  <br>
                  <div class="row ">
                    <div class="col-md-12"> 
                        <div class="card">
                          <div class="card-header bg-primary text-white">
                           <H2 style="color: white;"><i class="fas fa-list"></i> Catálogo de Cuentas</H2>
                          </div>
                            <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 text-white">            
                                                  <button id="btnNuevo" type="button" class="btn btn-success btn-rounded btn-fw" data-toggle="modal" data-target="#modalNuevo">         
                                                        <i class="fas fa-plus-circle"></i>
                                                    Nueva Cuenta</button>    
                                                </div>    
                                            </div>
                                            <div class="row text-right">
                                              <div class="col-lg-12 text-white">
                                                <button class="btn btn-primary" id="btnPDF"><i class="fas fa-print"></i> PDF LISTA CATALOGO</button>
                                              </div>
                                            </div>
                                          <br><br>
                              <div class="table-responsive">
                                <table class="table" id="tablaCatalogo">
                                  <thead class="bg-primary text-white"> 
                                    <tr>
                                      <th>Código</th>
                                      <th>Nombre</th>
                                      <th>Acciones</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php                            
                                      foreach($data as $dat) {                                                        
                                      ?>
                                      <tr>
                                          <td><?php echo $dat["codigo"]; ?></td>
                                          <td><?php echo $dat["nombre"]; ?></td> 
                                          <td><div class="text-center">
                                                      <button class='btn btn-info btnVer'><i class="fa fa-search"></i></button>
                                                      <button class='btn btn-primary btnEditar'><i class="fa fa-edit"></i></button>
                                                      <button class='btn btn-danger btnEliminar'><i class="fa fa-trash"></i></button>
                                          </div></td>
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
                </div>
            </section>
            <!-- END TABLA-->
  
         
     
<?php
  require_once '../partes/inferior2.php';
?>

<script type="text/javascript" src="../jsvistas/jsCatalogo.js"></script>

<script>
    $(document).on("click","#btnPDF",function(){


      var url = "../modelos/listadoCatalogo.php";
      window.location.href = url;

    });

</script>




      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger">
                  <h5 class="modal-title text-white" id="exampleModalCenterTitle"><i class="fa fa-trash"></i>   Eliminar Registro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <form id="formEliminarCuenta" method="POST" action="../modelos/catalogo.php?op=3">
                <div class="modal-body">
                  <div class="form-group">
                    <label class="col-form-label">Desea eliminar el registro?</label>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label text-right">Codigo:</label>
                    <div class="col-sm-10"><input type="text" class="form-control" id="id2" name="id2" readonly></div>
                  </div>
                   
                
        
                </div>
                <br><br>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
                  <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Confirmar</button>
                </div>
                </form>
              </div>
            </div>
    </div>

    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
            <?php 
              $consulta2 = "SELECT * FROM tipo";
              $resultado2 = $conexion->prepare($consulta2);
              $resultado2->execute();
              $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);

              $consulta3 = "SELECT * FROM saldo";
              $resultado3 = $conexion->prepare($consulta3);
              $resultado3->execute();
              $data3=$resultado3->fetchAll(PDO::FETCH_ASSOC);
            ?>
              <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle"><i class="fa fa-plus"></i>  Agregar Cuenta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <form id="formNuevaCuenta" method="POST" action="../modelos/catalogo.php?op=1">
                        <div class="modal-body">
                            <div class='form-group'>
                                <label>Código</label>
                                <input type='text' required  name='id' id='id' class='form-control'>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo" class="col-form-label">Tipo</label>
                                <select class="form-control" id="tipo" name="tipo">
                                    <option value="0">Seleccione un Tipo</option>
                                    <?php foreach($data2 as $tipo) {?>
                                        <option value="<?php echo $tipo['id']?>"><?php echo $tipo['nombre'] ?></option>
                                    <?php }?>
                                </select>
                            </div>  
                            <div class='form-group'>
                                <label>Nivel</label>
                                <input type='number' min="1" required name='nivel' id='nivel' class='form-control'>
                            </div> 
                            <div class="form-group">
                                <label for="tipo" class="col-form-label">Saldo</label>
                                <select class="form-control" id="saldo" name="saldo">
                                    <option value="0">Seleccione un Saldo</option>
                                    <?php foreach($data3 as $saldo) {?>
                                        <option value="<?php echo $saldo['id']?>"><?php echo $saldo['nombre'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                        </div>
                    </form>
              </div>
            </div>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="display: none;">                             
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle"><i class="fa fa-edit"></i>   Editar Cuenta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <form id="formEditarReferencia" method="POST" action="../modelos/catalogo.php?op=2">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id1" class="col-form-label">Código</label>
                                <input type="number" class="form-control bg-white text-dark" id="id1" name="id1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre1" name="nombre1">
                            </div>
                            <div class="form-group">
                                <label for="tipo" class="col-form-label">Tipo</label>
                                <select class="form-control" id="tipo1" name="tipo1">
                                  <option value="0">Seleccione </option>
                                    <?php foreach($data2 as $tipo) {?>
                                        <option value="<?php echo $tipo['id']?>"><?php echo $tipo['nombre'] ?></option>
                                    <?php }?>
                                </select>
                            </div> 
                            <div class='form-group'>
                                <label>Nivel</label>
                                <input type='number' min="1" required name='nivel1' id='nivel1' class='form-control'>
                            </div> 
                            <div class="form-group">
                                <label for="tipo" class="col-form-label">Saldo</label>
                                <select class="form-control" id="saldo1" name="saldo1">
                                <option value="0">Seleccione </option>
                                    <?php foreach($data3 as $saldo) {?>
                                        <option value="<?php echo $saldo['id']?>"><?php echo $saldo['nombre'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Guardar</button>
                        </div>
                    </form>
              </div>
            </div>
    </div>
    <div class="modal fade" id="modalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-info">
                  <h5 class="modal-title text-white" id="exampleModalCenterTitle"><i class="fa fa-search"></i>   Detalles de la Cuenta</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                
                <div class="modal-body" id="modalVerbody">        
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
                </div>
            
              </div>
            </div>
    </div>


