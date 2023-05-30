$(document).ready(function(){
  tablaPartida = $("#tablaPartida").DataTable({

  "language": {
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast":"Último",
              "sNext":"Siguiente",
              "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
      }
  });



$(document).on("click","#ver_partida",function(){
  var id = $(this).attr("data-id");
  $.ajax({
      type: 'POST',
      url: '../modelos/partidainfo.php',
      dataType: "json",
       data: {id,id},
      success: function(data){
   var html = "";
    html += "<table class='table table-bordered table-striped' >"
    html += "<thead class='bg-teal text-black' ><tr><th>Fecha</th><th>Asiento de Apertura</th></tr></thead>"
    html += "<tr><td>"+data[0].fecha+"</td><td>"+data[0].descripcion+"</td></tr>"
    html += "</table>"

    html += "<table class='table table-bordered table-striped'>"
    html += "<thead class='bg-teal text-black'><tr><th>Cuenta</th><th>Debe</th><th>Haber</th></tr></thead>"

    $.each(data,function(index,element){
      html += "<tr>"

      if (element.movimiento=="CARGO") {
        $cargo = element.monto;
        $valor = element.debe;
        
      } else {  
        $cargo = "⠀⠀⠀⠀";
      }
      if (element.movimiento=="ABONO") {
        $abono = element.monto;
      } else {
        $abono = "⠀⠀⠀⠀";
      }
      html += "<td>"+element.codigo + " - " + element.nombre +"</td><td>"+$cargo+"</td><td>"+$abono+"</td>"

      html +="</tr>"
      
    });
    
    
    html += "</table"
  
    $("#contenido_ver_partida").html(html);
  }
  });
 
});

//botón VER    
$(document).on("click", ".btnDesactivar", function(){
  estado = $(this).attr("data-id");
  fila = $(this).closest("tr");
  id2 = parseInt(fila.find('td:eq(0)').text());
  nombre2 = fila.find('td:eq(2)').text();
  if(estado==1){
  $("#estado").val("¿Desea Desactivar el Registro?");
  }else{ $("#estado").val("¿Desea Activar el Registro?");}
  $("#id2").val(id2);
  $("#nombre2").val(nombre2);
  $("#modalDesactivar").modal("show");  
  
});


  
});


$(document).on("click","#agregar_fila",function(){
  var elementos = $(".elemento");
  var tamanio = $(".elemento").length;
  var ultimo_elemento = elementos[tamanio-1];
  var numero = parseInt($(ultimo_elemento).attr("data-numero"))+1;
  var html = "";
  html += '<div class="row" id="fila"><div class="col-lg-4 col-md-5"><div class="form-group"><div class="row"><div class="col-lg-10" style="pad"><input type="text" name="cuenta" id="cuenta'+numero+'" class="form-control" disabled value=""><input type="hidden" data-numero="'+numero+'" class="elemento" id="cuenta_hidden_'+numero+'" name="cuenta_hidden[]"></div><div class="col-lm-6" style="padding-left: 15px;"><button type="button" data-numero="'+numero+'" data-toggle="modal" data-target="#modal_elegir_catalogo" id="seleccionar" class="btn btn-success ""> <i class="fas fa-check-square"></i> </button></div></div></div></div><div class="col-lg-3 col-md-3"><div class="form-group"><input type="text" placeholder="Ingresa la cantidad" name="cantidad[]" data-numero="'+numero+'" class="form-control cantidad" id="cantidad_'+numero+'"></div></div><div class="col-lg-3"><div class="form-group"><select data-numero="'+numero+'" name="movimiento[]" class="form-control" id="movimiento"><option value="">Seleccione</option><option value="ABONO">ABONO</option><option value="CARGO">CARGO</option></select></div></div></div>';
  $("#filas").append(html)

  
  });

$(document).on("click","#seleccionar",function(){
var numero = $(this).attr("data-numero");
$("#numeroS").val(numero)

});

$('#example4').DataTable({
'paging'      : true,
'lengthChange': false,
'searching'   : true,
'ordering'    : false,
"pageLength" : 5,
'autoWidth'   : true,
language: {
"decimal": "",
"emptyTable": "No hay información",
"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",

"infoFiltered": "(Filtrado de _MAX_ total entradas)",
"infoPostFix": "",
"thousands": ",",
"lengthMenu": "Mostrar _MENU_ Entradas",
"loadingRecords": "Cargando...",
"processing": "Procesando...",
"search": "Buscar:",
"zeroRecords": "Sin resultados encontrados",
"paginate": {
    "first": "Primero",
    "last": "Ultimo",
    "next": "Siguiente",
    "previous": "Anterior"
}
},
    dom: 'Bfrtip',
      buttons: [

          {
              extend: 'pdfHtml5',
               title : "Listado de Catalogo",
              exportOptions: {
                  columns: [ 0, 1 ]
              }
          }
  
      ]
  });
$(document).on("click","#select",function(event){
  var codigo = $(this).attr("data-codigo");
  var nombre = $(this).attr("data-nombre");
  var numero = $("#numeroS").val();
  var hiddens = $(".elemento")
  var hiddens_length = $(".elemento").length

  for(var i = 0; i < hiddens_length ;i++){
    if($(hiddens[i]).val() == codigo){
      alertify.error("Esta cuenta ya se encuentra en la Partida");
      return false;
    }

  }

  $("#cuenta" + numero).val(codigo + " - " + nombre);
  $("#cuenta_hidden_" + numero).val(codigo);
});


$(document).on("keyup",".cantidad",function(){
  sumar_movimiento()
});
$(document).on("change","#movimiento",function(){
 var numero = $(this).attr("data-numero");
 var valor = $(this).val();
 $("#cantidad_" + numero).attr("data-movimiento",valor);
 sumar_movimiento()
});


function sumar_movimiento(){
 var cantidad_cargo = 0.00;
 var cantidad_abono = 0.00;
 var cantidades = $(".cantidad")

 for(var i = 0; i < cantidades.length; i++){
   var cantidad_actual = $(cantidades[i]).val() === "" ? 0.00 : parseFloat($(cantidades[i]).val())

   if ($(cantidades[i]).attr("data-movimiento") == "CARGO") {
     cantidad_cargo = cantidad_cargo + cantidad_actual
   }else if($(cantidades[i]).attr("data-movimiento") == "ABONO"){
     cantidad_abono = cantidad_abono +  cantidad_actual
   }
 }

 $("#total_cargo").html(cantidad_cargo.toFixed(2))
 $("#total_abono").html(cantidad_abono.toFixed(2))
}


function alerta(type,titulo,texto,width= "40rem"){
  Swal.fire({
    type: type,
     title: titulo,
     width :  width
 })
}

$(document).on("keyup",".cantidad",function(){
  sumar_movimiento()
});
$(document).on("change","#movimiento",function(){
 var numero = $(this).attr("data-numero");
 var valor = $(this).val();
 $("#cantidad_" + numero).attr("data-movimiento",valor);
 sumar_movimiento()
});
