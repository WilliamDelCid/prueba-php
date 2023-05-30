$(document).ready(function(){
    tablaUsuario = $("#tablaUsuario").DataTable({
 
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
 
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    usuario = fila.find('td:eq(1)').text();
    contra = fila.find('td:eq(2)').text();
    $("#id1").val(id);
    $("#usuario1").val(usuario);
    $("#contraseña1").val(contra);
   
    $("#modalEditar").modal("show");  
    
});

//botón EDITAR    
$(document).on("click", ".btnEliminar", function(){
    fila = $(this).closest("tr");
    id2 = parseInt(fila.find('td:eq(0)').text());
    $("#id2").val(id2);
    $("#modalEliminar").modal("show");  
    
});

    
});




