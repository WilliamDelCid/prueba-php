$(document).on("click","#cuentas_nivel",function(){
    var nivel = $(this).val();
  
    if (nivel.trim() == "") {
      $("#resultado").html("");
      return false;
    }
    $.ajax({
      method : "POST",
      url : "../modelos/mayor.php",
      data : {
        tipo : "combo",
        nivel : nivel
      },
      beforeSend:function(response){
              $("#resultado").html('<p class="centrar marTop"> <br>...<div class="lds-spinner" style="width:100%;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></p>');  
      },
      success:function(response){
    
         $("#resultado").html(response); 
      }
    })
   });

   $(document).on("click","#btn_imprimir",function(){
    var nivel = $("#cuentas_nivel").val()
    if (nivel == "") {
      return false;
    }
    var url = "../modelos/mayor.php?nivel="+nivel;
    
    window.location.href = url;


 });