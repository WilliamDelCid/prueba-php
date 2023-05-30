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

$consulta = "SELECT COUNT(*) AS cont FROM usuario";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$contusuarios = $resultado->fetch(PDO::FETCH_OBJ);

$consulta1 = "SELECT COUNT(*) AS cont FROM catalogo";
$resultado1 = $conexion->prepare($consulta1);
$resultado1->execute();
$contcatalogo = $resultado1->fetch(PDO::FETCH_OBJ);
?>
  		
          <!-- start: content -->
            <div id="content">
            
                <div class="col-md-12" style="padding:20px;">
                
                    <div class="col-md-12 padding-0">
                        <div class="col-md-8 padding-0">
                        <div class="col-md-8 padding-0">
                        <img  style="position: absolute; left: 380px;" src="../images/1245.png"  />
                        </div>
                            <div class="col-md-12 padding-0">
                            
                                <div class="col-md-6">
                                    <div class="panel box-v1">
                                    

                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-list icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div> <br><br><br><br><br><br><br><br><br>
                                      <div class="panel-body bg-success text-center">
                                        <h1 style="color: white;"></h1>
                                        
                                       
                                      </div>

                                    </div>
                                </div>
 
                               

                                


                            
                        </div>

                    </div>




                </div>
      		  </div>
          <!-- end: content -->

     
<?php
  require_once '../partes/inferior2.php';
?>