<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}
?>
<head>
	<link rel="stylesheet" type="text/css" href="../alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../alertifyjs/css/themes/default.css">

	<script src="../jquery-3.2.1.min.js"></script>
	<script src="../alertifyjs/alertify.js"></script>
  </head>
<?php
  require_once '../partes/superior2.php';
?>
<div id="container" style="background-color: lightblue; color: black; font-size: 18px;">
<div class="col-md-12" style="padding:20px;">
                  <div class="panel panel-default">
	<form  id="frm_editar_partida" method="POST" action="../modelos/partida.php?op=2">
	<input type="hidden"   id="contador" name="contador">
	<div class="panel-body">
        
    <?php
	$id = $_GET['id'];
    //INICIAMOS LA CONEXION A LA BASE
	 include_once '../bd/conexion.php';
	 $objeto = new Conexion();
     $conexion = $objeto->Conectar();
     
     //esta será para la el obtener el array
	 $query ="SELECT p.fecha,p.descripcion,c.codigo,c.nombre,dd.monto,dd.movimiento   FROM partida p  INNER JOIN detallediario dd ON p.idpartida=dd.idpartida INNER JOIN catalogo c ON dd.codigo=c.codigo WHERE p.idpartida=$id";
	 $resultado=$conexion->prepare($query);
	 $resultado->execute();
	 $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	 ?>
	
<div class="panel-heading" style="background-color: lightseagreen;">
 		<div class="panel-title" style="color: black; font-family: Times New Roman; font-size: 26px; text-align: center;">Editar Partida  <?php echo $id; ?> </div>
 	</div>

 	<div class="panel-body">
 		
	<input type="hidden" name="id_partida" value="<?php  echo $id; ?>">
<div class="row">
	<div class="col-lg-7 col-md-7">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title">
					 <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>⠀⠀⠀
				</div>
			</div>
			<div class="panel-body">
				
		
			</div>
			
		</div>
		
		
	</div>





		<div class="col-lg-2 col-md-2">
		
		
	</div>
	
	</div>



<?php 	

$primer_dia_siguiente_anio = (date("Y")+1)."-01-01";

 ?>



            
















<div class="row">
	<div class="col-lg-4">
		<label>Seleccione una cuenta </label>
	</div>
	<div class="col-lg-3">
		<label>Cantidad</label>
	</div>
	<div class="col-lg-3">
		<label>Tipo de Movimiento</label>
	</div>
	<button class="btn btn-primary" id="agregar_fila" type="button"> <span class=" glyphicon glyphicon-plus" aria-hidden="true"></span> AGREGAR</button>
	&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" type="button" id="quitar_fila"> <span class=" glyphicon glyphicon-remove" aria-hidden="true"></span> QUITAR</button>
					
</div>

<div id="filas">

	<?php $numero = 1; ?>
	<?php foreach ($data as $d): ?>
		<div class="row bd" id="fila">
	<div class="col-lg-4">
		<div class="form-group">
			<div class="row">
				<div class="col-lg-10" >
						<input type="text" name="cuenta" id="cuenta<?php echo $numero; ?>" class="form-control" disabled value="<?php echo $d["codigo"] . " - " . $d["nombre"]; ?>">
						<input type="hidden" class="elemento" data-numero="<?php echo $numero; ?>" id="cuenta_hidden_<?php echo $numero; ?>" value="<?php echo $d['codigo']; ?>"  name="cuenta_hidden[]">
				</div>	
						
			</div>
		
		</div>
	</div>
	<div class="col-lg-3">
		<div class="form-group">
			<input type="number" min="1" step="any" name="cantidad[]" class="form-control cantidad" id="cantidad_<?php echo $numero; ?>" data-numero="<?php echo $numero; ?>" value="<?php echo $d["monto"] ?>"  <?php if($d["movimiento"] == "ABONO") { echo 'data-movimiento="ABONO"' ;} ?>   <?php if($d["movimiento"] == "CARGO") { echo 'data-movimiento="CARGO"' ;} ?> >
		</div>
	</div>
	<div class="col-lg-3">
		<div class="form-group">
			<select name="movimiento[]" class="form-control" id="movimiento" data-numero="<?php echo $numero; ?>">
				<option  value="">Seleccione</option>
				<option <?php if($d["movimiento"] == "ABONO") { echo 'selected' ;} ?> value="ABONO">ABONO</option>
				<option  <?php if($d["movimiento"] == "CARGO") { echo 'selected' ;} ?> value="CARGO">CARGO</option>
			</select>
			
		</div>
	</div>
	
</div>

	<?php $numero++; ?>
	<?php endforeach ?>
	</div>
	<div class="row">
	
<div class="col-lg-11">
	<div class="row">


		
		
			<div class="col-lg-6">
				<div class="form-group">
			<label>Asiento de Apertura</label>
			<textarea placeholder="Escribe una descripcion de la partida" name="descripcion" id="descripcion" class="form-control"><?php echo $data[0]["descripcion"] ?> </textarea> 
		</div>
			</div>
			<div class="col-lg-2">
				<div class="form-group">
			<label>Fecha </label>
		
			
	

			
			<input type="date" min="<?php echo date("Y") . '-01-01'; ?>" max='<?php echo  date("Y-m-d",strtotime($primer_dia_siguiente_anio."- 1 days")); ?>' name="fecha" id="fecha" class="form-control" value="<?php echo $data[0]["fecha"] ?>" >
		
		</div>
			</div><?php $consullta2 ="SELECT SUM(monto) as total FROM detallediario WHERE idpartida=:partida  AND movimiento='CARGO'";
				$resultado2=$conexion->prepare($consullta2);
				$resultado2->bindParam(":partida",$id,PDO::PARAM_STR);
				$resultado2->execute();
				$data2=$resultado2->fetchAll();?>
				<h4><label id="total_cargo" style="color: lightblue;"><?php echo $data2[0]["total"]; ?></label></h4>

				&nbsp;&nbsp;&nbsp;&nbsp;

				<?php $consullta3 ="SELECT SUM(monto) as total FROM detallediario WHERE idpartida=:partida  AND movimiento='ABONO'";
				$resultado3=$conexion->prepare($consullta3);
				$resultado3->bindParam(":partida",$id,PDO::PARAM_STR);
				$resultado3->execute();
				$data3=$resultado3->fetchAll();?>
              		<h4><label style="color: lightblue;" id="total_abono"><?php  foreach($data3 as $dat) { echo $dat["total"];} ?></label></h4>

              		
            	</div>
            	<div class="icon">
            		<span class="glyphicon glyphicon-usd"></span>
            	</div>
	</div>




	
</div>
			
		
</div>
 
	<a class="btn btn-warning" href="../vistas/partida.php"> <span class=" glyphicon glyphicon-arrow-left " aria-hidden="true"></span> VOLVER</a>				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
  
	<button class="btn btn-success" type="submit" id="procesar"> <span class=" glyphicon glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> PROCESAR</button>

</form>
</div>






 	</div>



 </div>

	</div>
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
        alertify.success("Estos registros se encuentran en la Base de datos,no se pueden eliminar");
        
       }
       
     }else{
       if(!$(ultimo_elemento).hasClass("bd")){
        alertify.success("Solo puedes quitar las filas que agregaste");
       
        
     }else{
      alertify.success("Estos registros se encuentran en la Base de datos,no se pueden eliminar");
     }
     }
     
 
 })
 $(document).on("click","#seleccionar",function(){
  var numero = $(this).attr("data-numero");
  $("#numeroS").val(numero)

});


 $(document).on("submit","#frm_editar_partida",function(event){
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
          alertify.error("Debe existir CARGO Y ABONO ");
          return false;
        }else{
            if(cantidad_abono.toFixed(2) != cantidad_cargo.toFixed(2)){
              alertify.error("La cantidad total de CARGO no es igual a la cantidad total de ABONO !");
          return false;
       }
		}
		var formData = new FormData($("#frm_editar_partida")[0]);
      formData.append("agregar",true)
      $.ajax({
        method: "POST",
        url : "../modelos/partida.php?op=2",
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