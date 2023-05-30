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
                          <H2 style="color: white;">Nombre de la empresa</H2>
                          </div>
                            <div class="card-body">
                              
                            


                                  <div class="col-lg-4">
                                    <label for="">Nombre de la empresa</label>
                                    <input type="text" id="inventario_final" class="form-control" placeholder="Bears S.A de C.V">	
                                  </div>
                                  <div class="col-lg-4">
                                  <br>
                                  <form action="../vistas/inicio.php">
    <input type="submit" style="color: white; background-color: blue; width: 100px; height: 35px;" value="Guardar" />
</form>
                                  </div>
                          
            <!-- FIN--></div>
<?php
  require_once '../partes/inferior2.php';
?>

<script>
  $(document).on("click","#btn_busqueda4",function(){
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
      url : "../modelos/EstadoDeResultado.php?op=1",
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
      var url = "../modelos/EstadoDeResultado.php?fecha_inicio="+fecha_inicio + "&fecha_fin="+fecha_fin + "&inventario_final="+inventario_final+ "&op=2";
      window.location.href = url;
    }
 });

</script>