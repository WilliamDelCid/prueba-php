$(document).ready(function(){
    tablaCatalogo = $("#tablaCatalogo").DataTable({
 
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
        },

    
        "aaSorting": []

   
    });


      
 
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    op=4;
    fila = $(this).closest("tr");
    id = fila.find('td:eq(0)').text();

    $.ajax({
        type: 'POST',
         url: '../modelos/catalogo.php?op=4',
         dataType: "json",
         data: {id:id, op:op},
         success: function(data){
           console.log(data);
           codigo = data[0].codigo;            
            nombre = data[0].nombre;
            tipo = data[0].tipo;
            nivel = data[0].nivel;
            saldo = data[0].saldo;
            $("#id1").val(codigo);
            $("#nombre1").val(nombre);
            $("#tipo1 > option[value="+tipo+"]").attr("selected", true);
            $("#nivel1").val(nivel);
            $("#saldo1 > option[value="+saldo+"]").attr("selected", true);
         }
 
     });
     
   
    $("#modalEditar").modal("show");  
    
});

//botón ELIMINAR    
$(document).on("click", ".btnEliminar", function(){
    fila = $(this).closest("tr");
    id2 = fila.find('td:eq(0)').text();
    $("#id2").val(id2);
    $("#modalEliminar").modal("show");  
    
});

//botón VER    
$(document).on("click", ".btnVer", function(){
    op=5;
    fila = $(this).closest("tr");
    id = fila.find('td:eq(0)').text();

    $.ajax({
        type: 'POST',
         url: '../modelos/catalogo.php?op='+op,
         dataType: "json",
         data: {id:id, op:op},
         success: function(data){
           console.log(data);
           codigo = data[0].codigo;            
            nombre = data[0].nombre;
            tipo = data[0].tipo;
            nivel = data[0].nivel;
            saldo = data[0].saldo;
            $("#modalVerbody").html("<label  class='col-form-label'><b>CUENTA</b></label><br><br>"
                                +"<label  class='col-form-label'><b>Codigo:</b> "+codigo+"</label><br>"                             
                                +"<label  class='col-form-label'><b>Nombre:</b> "+nombre+"</label><br>"
                                +"<label  class='col-form-label'><b>Tipo:</b> "+tipo+"</label><br>"
                                +"<label  class='col-form-label'><b>Nivel:</b> "+nivel+"</label><br>"
                                +"<label  class='col-form-label'><b>Saldo:</b> "+saldo+"</label>");
   
         }
 
     });
     
   
    $("#modalVer").modal("show");  
    
})

    
});






