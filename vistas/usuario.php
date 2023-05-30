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

$consulta = "SELECT * FROM usuario";
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
                          <i class="fas fa-list"></i>   LISTA DE USUARIOS REGISTRADOS
                          </div>
                            <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 text-white">            
                                                  <button id="btnNuevo" type="button" class="btn btn-success btn-rounded btn-fw" data-toggle="modal" data-target="#modalNuevo">         
                                                        <i class="fas fa-plus-circle"></i>
                                                    Nuevo Usuario</button>    
                                                </div>    
                                            </div>
                                          <br><br>
                              <div class="table-responsive">
                                <table class="table" id="tablaCatalogo">
                                  <thead class="bg-primary text-white"> 
                                    <tr>
                                    <th>Código</th>
                                    <th>Usuario</th>
                                  
                                    <th>Acciones</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php                            
                                      foreach($data as $dat) {                                                        
                                      ?>
                                      <tr>
                                          <td><?php echo $dat["idusuario"]; ?></td>
                                          <td><?php echo $dat["usuario"]; ?></td>
                                         
                                          <td><div class="text-center">
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


<script type="text/javascript" src="../jsvistas/jsUsuario.js"></script>



<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger">
                  <h5 class="modal-title text-white" id="exampleModalCenterTitle"><i class="fa fa-trash"></i>   Eliminar Registro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <form id="formEliminarUsuario" method="POST" action="../modelos/usuario.php?op=3">
                <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label">Desea eliminar el registro?</label>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label text-right">Codigo:</label>
                    <div class="col-sm-10"><input type="text" class="form-control" id="id2" name="id2" readonly></div>
                  </div>
                    <br><br>
                </div>
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
              <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle"><i class="fa fa-plus"></i>  Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <form id="formNuevoUsuario" method="POST" action="../modelos/usuario.php?op=1">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" name="usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="contraseña" class="col-form-label">Contraseña:</label>
                                <input type="password" class="form-control" name="contraseña" required>
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
                    <h5 class="modal-title text-white" id="exampleModalLongTitle"><i class="fa fa-edit"></i>   Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <form id="formEditarUsuario" method="POST" action="../modelos/usuario.php?op=2">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id1" class="col-form-label">Id:</label>
                                <input type="number" class="form-control bg-white text-dark" id="id1" name="id1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="usuario1" name="usuario1">
                            </div>
                            <div class="form-group">
                                <label for="contraseña1" class="col-form-label">Contraseña:</label>
                                <input type="text" class="form-control" id="contraseña1" name="contraseña1">
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

