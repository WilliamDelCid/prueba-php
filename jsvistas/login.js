$('#formLogin').submit(function(e){
    e.preventDefault();
    var usuario = $.trim($("#usuario").val());    
    var password =$.trim($("#password").val());    
     
    if(usuario.length == "" || password == ""){
       Swal.fire({
           type:'warning',
           title:'Debe ingresar un Usuario y/o Contraseña',
       });
       return false; 
     }else{
         $.ajax({
            url:"bd/login.php",
            type:"POST",
            datatype: "json",
            data: {usuario:usuario, password:password}, 
            success:function(data){               
                if(data == "null"){
                    Swal.fire({
                        type:'error',
                        title:'Usuario y/o Contraseña incorrecta',
                    });
                }else{
                    Swal.fire({
                        type:'success',
                        title:'¡Conexión exitosa!',
                        confirmButtonColor:'#3085d6',
                        confirmButtonText:'Ingresar'
                    }).then((result) => {
                        if(result.value){
                            //window.location.href = "vistas/pag_inicio.php";
                            window.location.href = "vistas/inicio.php";
                        }
                    })
                    
                }
            }    
         });
     }     
 });