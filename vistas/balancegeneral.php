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
$primer_dia_siguiente_anio = (date("Y")+1)."-01-01";
 ?>      
            <!-- INICIO-->
            <section>
                <div class="container">
                  <br>
                  <div class="row ">
                    <div class="col-md-12"> 
                        <div class="card">
                          <div class="card-header bg-primary text-white">
                          <H2 style="color: white;"><i class="fas fa-list"></i> Balance General</H2>
                          </div>
                            <div class="card-body">
                              
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label for="">Fecha Inicio</label> 
                                    <input type="date" id="fecha_inicio" class="form-control" value="<?php echo date("Y") . '-01-01'; ?>">
                                  </div>

                                  <div class="col-lg-4">
                                    <label for="">Fecha Fin</label>
                                    <input type="date" id="fecha_fin" class="form-control" value="<?php echo  date("Y-m-d",strtotime($primer_dia_siguiente_anio."- 1 days")); ?>">	
                                  </div>

                                  <div class="col-lg-4">
                                    <label for="">Inventario Final</label>
                                    <input type="number" id="inventario_final" class="form-control" placeholder="Ingrese la cantidad del inventario final">	
                                  </div>

                                  <input type="hidden" id="inventario_final3_hidden">  
                                </div>
                                <br>
                                <div class="row col-lg-12">
                                  <div class="col-lg-3"></div>
                                  <div class="col-lg-6">
                                    <button type="button" class="btn btn-success btn-block" id="btn_busqueda3"> <i class="fa fa-check"></i> Ver Balance General</button>
                                    <br>
                                    <button type="button" class="form-control btn btn-primary"  id="btn_imprimir3"> <span class="glyphicon glyphicon-print " aria-hidden="true"></span><i class="fas fa-print"></i> Imprimir Balance</button>
                                  </div>
                                  <div class="col-lg-3"></div>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10"  id="result3"></div>
                                <div class="col-lg-1"></div>
                            </div>
                            
                            <br>
                        </div>
                    </div>  
                  </div>

                  
                      

                    
                  </div>
                </div>
            </section>
            <!-- FIN-->
  
         
     
<?php
  require_once '../partes/inferior2.php';
?>
<script src="../sweetalert2/sweetalert2.all.min.js"></script>
<script>
  $(document).on("click","#btn_busqueda3",function(){
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    var inventario_final = $("#inventario_final").val();
    
    if (fecha_inicio=='' || fecha_fin=='' || inventario_final=='') {
      Swal.fire({
          type:'error',
          title:'Ingrese los campos faltantes!',
      });
    }else{
      $.ajax({
      method : "POST",
      url : "../modelos/BalanceGeneral.php?op=1",
      data:{
        fecha_inicio :fecha_inicio,
        fecha_fin:fecha_fin,
        inventario_final:inventario_final
      },success:function(response){

        $("#result3").html(response)
        $("#inventario_final3_hidden").val(inventario_final);
      }
      })
    }
  });


  $(document).on("click","#btn_imprimir3",function(){

    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    var inventario_final = $("#inventario_final").val();
    
    if (fecha_inicio=='' || fecha_fin=='' || inventario_final=='') {
      Swal.fire({
          type:'error',
          title:'Ingrese los campos faltantes!',
      });
    }else{
      var url = "../modelos/BalanceGeneral.php?fecha_inicio="+fecha_inicio + "&fecha_fin="+fecha_fin + "&inventario_final="+inventario_final+ "&op=2";
      window.location.href = url;
    }
   
    


 });

</script>