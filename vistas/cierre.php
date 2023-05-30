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


?>


<!-- TABLA-->
<section>
                <div class="container">
                  <br>
                  <div class="row ">
                    <div class="col-md-12"> 
                        <div class="card">

                        <div class="card-header bg-primary text-white">
                        <i class="icon fa fa-info"></i> <b> CIERRE CONTABLE </b>
                          </div>
                          <div class="card-body">
                            <div class="row">    
                               Al pulsar sobre el botón 'REALIZAR CIERRE CONTABLE' se liquidaran todas las cuentas del estado de resultado y no se podran ingresar mas partidas hasta el proximo periodo  
                            </div>

                            <div class="row">
                              <input type="hidden" id="inventario_final4_hidd">
                              <div class="col-lg-11">
                                <p style="text-align: center;"><button type="button" id="btn_busqueda4" class="btn btn-primary btn-lg">REALIZAR CIERRE CONTABLE</button></p>
                              </div>
                            </div>
                            <div class="row">
                              
                              <div class="col-lg-11">
                                <p style="text-align: center;" id="result">
                                  
                                </p>
                              </div>
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


<script src="../sweetalert2/sweetalert2.all.min.js"></script>

<script>
$(document).on("click","#btn_busqueda4",function(){
   Swal.fire({
            title: 'Inventario Final',
            html:
            '<div class="form-group"><label>Ingresa la Cantidad</label><input type="text" id="inventario_final" class="form-control" placeholder="Ingrese el Inventario Final">', 
            
            focusConfirm: false,
            showCancelButton: true,                         
            }).then((result) => {
              if (result.value) {   
                    var inventario_final = $("#inventario_final").val();         
                    if (inventario_final == "" || isNaN(inventario_final)) {
                      return false;
                    }  
    

                     $.ajax({
                      method : "POST",
                      url : "../modelos/Cierre.php",
                      data:{inventario_final:inventario_final},
                      success:function(response){
                     
                         window.location.href = '../vistas/inicio.php';
                       
                      }
                      })

              }
          });
 });

</script>
