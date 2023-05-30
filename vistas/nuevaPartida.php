<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}

?>


<?php
  require_once '../partes/superior2.php';
?>
<head>
	<link rel="stylesheet" type="text/css" href="../alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../alertifyjs/css/themes/default.css">

	<script src="../jquery-3.2.1.min.js"></script>
	<script src="../alertifyjs/alertify.js"></script>
  </head>


<div id="container" style="background-color: lightblue; color: black; font-size: 18px;">
	
<div class="col-md-12" style="padding:25px;">
                  <div class="panel panel-default">
	<form  id="frm_agregar_partida" method="POST" action="../modelos/partida.php?op=1">
	<input type="hidden"   id="contador" name="contador">
	<div class="panel-body">
	 <?php
	 include_once '../bd/conexion.php';
	 $objeto = new Conexion();
	 $conexion = $objeto->Conectar();
	 $consu ="SELECT idpartida  FROM partida ORDER BY idpartida DESC  LIMIT 1";
	 $resultado2 = $conexion->prepare($consu);
	 $resultado2->execute();
	 $da=$resultado2->fetchAll(PDO::FETCH_ASSOC);
	 ?>
	<div class="row">
		<div class="col-lg-12">
			 <div class="panel panel-primary">
 	<div class="panel-heading" style="background-color: lightseagreen;">
 		<div class="panel-title" style="color: black; font-family: Times New Roman; font-size: 26px; text-align: center;">NUEVA PARTIDA  <?php foreach ($da as $dax){echo $dax["idpartida"]+1; } ?></div>
 	</div>

 
	<input type="hidden" name="id_partida" value="<?php foreach ($da as $dax){echo $dax["idpartida"]+1; } ?>">


<?php 	

$primer_dia_siguiente_anio = (date("Y")+1)."-01-01";

 ?>




	


<div class="row">
	<div class="col-lg-4 col-md-5">
		<label>Seleccione una cuenta</label>
	</div>
	<div class="col-lg-3">
		<label>Cantidad</label>
	</div>
	<div class="col-lg-2 " >
		<label>Tipo de Movimiento</label>
	</div>
	</div>

<div id="filas">
	<div class="row" id="fila">
	<div class="col-lg-4 col-md-5">
		<div class="form-group">
			<div class="row">
				<div class="col-lg-10 col-md-10">
						<input type="text"  name="cuenta" id="cuenta1" class="form-control" disabled value=" ">
						<input type="hidden" class="elemento" data-numero="1" id="cuenta_hidden_1" name="cuenta_hidden[]">
						
				</div>	
					<div class="col-lg-1 col-md-1">
					<button type="button" class="btn btn-success" data-numero ="1" id="seleccionar"  data-toggle="modal" data-target="#modal_elegir_catalogo"> <i class="fas fa-check-square"></i> </button>
				</div>		
			</div>
		
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="form-group">
			<input type="number" step="any" placeholder="Ingresa la cantidad" min="1" name="cantidad[]" class="form-control cantidad" id="cantidad_1" data-numero="1">
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="form-group">
			<select name="movimiento[]" class="form-control" id="movimiento" data-numero="1">
				<option value="">Seleccione</option>
				<option value="ABONO">ABONO</option>
				<option value="CARGO">CARGO</option>
			</select>
			
		</div>
	</div>
	<button style="width: 105px; height: 40px;"  class="btn btn-danger" id="agregar_fila" type="button">Nueva Fila </button>
	&nbsp;&nbsp;<button style="width: 105px; height: 40px;"  class="btn btn-primary" type="button" id="quitar_fila">Quitar Fila</button>

</div>
</div>

	</div>
</div>



 	</div>






 </div>
</div>

<div class="row">
	
<div class="col-lg-11">
	<div class="row">

		<div class="col-lg-8">
				<div class="form-group">
			<label>Asiento de Apertura</label>
			<textarea placeholder="Escribe una descripcion de la partida" name="descripcion" id="descripcion" class="form-control"></textarea> 
		</div>

			</div>

			<div class="col-lg-4">
				<div class="form-group">
			<label>Fecha</label>

			<input style="width : 160px;" type="date"  max='<?php echo  date("Y-m-d",strtotime($primer_dia_siguiente_anio."- 1 days")); ?>' name="fecha" id="fecha" class="form-control" value="<?php echo date("Y-m-d"); ?>" >

              <h4><label style="width:100%;text-align: center; color: lightblue;" id="total_cargo">0.00</label></h4>
			  <h4><label style="width:100%;text-align: center; color: lightblue;" id="total_abono">0.00</label></h4>
 
            </div>

          </div>
		
		
	
		
	</div>


</div>



</div>
	<div class="col-lg-16 col-md-16">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title">
					 <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
				</div>
			</div>
			<div class="panel-body">
				<a class="btn btn-warning" href="../vistas/partida.php"> <span class=" glyphicon glyphicon-arrow-left " aria-hidden="true"></span> Atras</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		
				<button class="btn btn-success" type="submit" id="procesar"> <span class=" glyphicon glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
			</div>
			
		</div>
		
		
	</div>
	
	
			




</form>
</div></div>

</div>


<div class="modal  fade" id="modal_elegir_catalogo">

	
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form method="post" id="frmCatalogo">
              <div class="modal-header">
			  <h4 class="modal-title">Seleccione una Cuenta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                
              </div>
              <div class="modal-body " id="contenido_elegir_catalogo">
              	<input type="hidden" id="numeroS">
                   <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
              <table id="example4" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                
                  <th>Acciones</th>
                </tr>
                </thead>
				<tbody>
                    <?php
           
                $consulta = "SELECT * FROM catalogo WHERE nivel > 2";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                ?>
                        <?php foreach ($data as $dat){ ?>
                                <tr>
                            <td><?php echo $dat["codigo"]; ?></td>
                                <td><?php echo $dat["nombre"]; ?></td>
                                <td>

                                    <?php
                                   
                                    $query ="SELECT * FROM catalogo  WHERE codigo LIKE '".$dat['codigo']."_%'";
                                    $resultado3 = $conexion->prepare($query);
                                    $resultado3->execute();
                                    $data2= $resultado3->fetchAll();
                                    
                                    if ( empty($data2)){ ?>
                                            <button id="select" data-nombre="<?php echo $dat["nombre"] ?>" data-dismiss="modal" data-codigo='<?php echo $dat["codigo"]; ?>'><i style="font-size: 2.1em; " class="fas fa-check-square"></i></button>
                                    <?php } ?>
                                
                                    
                                </td>
                                
                                </tr>
            
                                    <?php } ?>
                    </tbody>



              </table>
            </div>
          </div>
          
              </div>
              <div class="modal-footer">
               
                <button type="button"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                
              </div>
              </form>
            </div>
          
          </div>

    </div>
	<?php
  require_once '../partes/inferior2.php';
?>
<script src="../sweetalert2/sweetalert2.all.min.js"></script>
<script>

$(document).on("click","#quitar_fila",function(){

    var elementos = $("#filas #fila");
     var tamanio = $("#filas #fila").length;
     var ultimo_elemento = elementos[tamanio-1];
     
 
     if (tamanio > 1) {
        if(!$(ultimo_elemento).hasClass("bd")){
         $(ultimo_elemento).remove()
          sumar_movimiento()
       }else{
        Swal.fire({
          type:'error',
		  title:'Advertencia',
        text: 'Estos registros se encuentran en la Base de datos,no se pueden eliminar',
        width : '40rem'
      });
        
       }
       
     }else{
       if(!$(ultimo_elemento).hasClass("bd")){
        Swal.fire({
          type:'error',
		  title:'Advertencia',
        text: 'Solo puedes quitar las filas que agregaste',
        width : '40rem'
      });
       
        
     }else{
      Swal.fire({
		type:'error',
		title:'Advertencia',
        text: 'Estos registros se encuentran en la Base de datos,no se pueden eliminar',
        width : '40rem'
    });

      
     }
     }
     
 
 })


 $(document).on("submit","#frm_agregar_partida",function(event){
    event.preventDefault();
    var movimiento = $("#filas #movimiento");
    var cantidad = $("#filas .cantidad");
     var codigo = $("#filas .elemento")
    var longitud = $("#filas .elemento").length;
    var errores = 0;
    var cantidad_cargo = 0.00;
    var cantidad_abono = 0.00;
    var existe_cargo = false;
    var existe_abono = false;
      if ($("#fecha").val() === "" || $("#descripcion").val() === "") {
        errores++;
      }

    for(var i = 0; i < longitud;i++){
    if ($(movimiento[i]).val() === "" || $(cantidad[i]).val() === "" || $(codigo[i]).val() === "") {
        
        errores++;
             

      }
    }

    if (errores > 0) {
      alertify.success("Para procesar la informacion,debes completar todos los campos !");
        return false;
    }else{


         
         for(var i = 0; i < longitud;i++){
             if ($(movimiento[i]).val() === "CARGO") {
              cantidad_cargo = cantidad_cargo + parseFloat($(cantidad[i]).val())
              existe_cargo = true;
        }

            if ($(movimiento[i]).val() === "ABONO") {
              cantidad_abono = cantidad_abono + parseFloat($(cantidad[i]).val())
              existe_abono = true;
            }

         }
       
        if(!existe_abono || !existe_cargo){
          alertify.error("Debe existir CARGO Y ABONO");    
          return false;
        }else{
            if(cantidad_abono.toFixed(2) != cantidad_cargo.toFixed(2)){
              alertify.error("La cantidad total de CARGO no es igual a la cantidad total de ABONO");  
          

          return false;
       }
		}

		var formData = new FormData($("#frm_agregar_partida")[0]);
      formData.append("agregar",true)
      $.ajax({
        method: "POST",
        url : "../modelos/partida.php?op=1",
        data : formData,
         processData: false,
        contentType: false,
        success:function(response){
         if (response.trim() === "true") {
          Swal.fire({
            title: 'OPERACIÓN EXITOSA',
            text: "La partida se registró correctamente",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK',
             width :  "40rem"
            }).then((result) => {
            if (result.value) {
              window.location.href = "../vistas/partida.php";
            }
          })
          
         }else{

	window.location.href = "../vistas/partida.php";
           
         } 
        }
      })
    }
	
	

    

});
 
 </script>
<script type="text/javascript" src="../jsvistas/jsPartida.js"></script>