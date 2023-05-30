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
                        <i class="icon fa fa-info"></i> <b> INICIO DE OPERACIONES </b>
                          </div>
                          <div class="card-body">
                            <div class="row">    
                            Al pulsar sobre el botón 'INICIAR OPERACIONES' se eliminarán todas las partidas para iniciar un nuevo periodo.
                            </div>

                            <div class="row">
                              <input type="hidden" id="inventario_final4_hidd">
                              <div class="col-lg-11">
                                <p style="text-align: center;"><button type="button" id="iniciar_operaciones" class="btn btn-primary btn-lg">REALIZAR INICIO DE OPERACIONES</button></p>
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
$(document).on("click","#iniciar_operaciones",function(){
   Swal.fire({
    title: 'Deseas Iniciar las Operaciones ?',
    text: "Al pulsar se eliminarán las partidas anteriores e iniciará un nuevo periodo",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, iniciar operaciones',
    cancelButtonText: 'Cancelar',
    width : "40rem"
}).then((result) => {
  if (result.value) {
    $.ajax({
      method : "POST",
      url : "../modelos/IniciarOperaciones.php",
      data : {
        iniciar_operaciones : true
      },
      success:function(response){
        if (response.trim() === "true") {
                        window.location.href = '../vistas/inicio.php';
        }else{
          alert("Hubo un error al iniciar operaciones")
        }
      }
  })

  }
})
 });


</script>
