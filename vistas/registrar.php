<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de Usuario</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="../asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="../asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="../asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="../asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="../asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="../asset/img/logo.png">
  <style type="text/css">
  .img-bg-mine{
    background: url('../asset/img/1.jpg') no-repeat center center fixed;  background-size: 1300px; background-color: #9b9b9b;
  }
  </style>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body id="mimin" class="dashboard form-signin-wrapper">

      <div class="container">

     
        <form action="../modelos/usuario.php?op=4" method="POST" class="form-signin"> 
          <div class="panel periodic-login">
          <div class="login-logo">
                      <img src="../asset/img/12.png" width="300" class="text-center">
                      <img src="../asset/img/LogoSC.png" width="300" class="text-center">
           </div>
           
              <div class="panel-body text-center">
                  <p class="atomic-mass">Registro de Usuario</p>
               

                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="usuario" required >
                    <span class="bar"></span>
                    <label>Usuario</label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" name="contraseña" required>
                    <span class="bar"></span>
                    <label>Contraseña</label>
                  </div>

                  <button type="submit" class="btn col-md-12 btn-success"><i class="fa fa-check"></i> Registrar</button>
              
              </div>
         
                <div class="text-center" style="padding:5px;">
                    <a href="../index.php">Ya tengo un Usuario?</a>
                </div>
          </div>
        </form>

      </div>

      <!-- end: Content -->
      <!-- start: Javascript -->
      <script src="../asset/js/jquery.min.js"></script>
      <script src="../asset/js/jquery.ui.min.js"></script>
      <script src="../asset/js/bootstrap.min.js"></script>

      <script src="../asset/js/plugins/moment.min.js"></script>
      <script src="../asset/js/plugins/icheck.min.js"></script>

      <!-- custom -->
      <script src="../asset/js/main.js"></script>
      <script type="text/javascript">
       $(document).ready(function(){
         $('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
       });
     </script>
     <!-- end: Javascript -->
   </body>
   </html>