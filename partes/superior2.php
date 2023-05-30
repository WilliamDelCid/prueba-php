<!DOCTYPE html>
<html lang="en">
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <link rel="shortcut icon" href="../images/LogoSC.png" />
    <title>Sistema Contable </title>

    <!-- Fontfaces CSS-->
    <link href="../css/font-face.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">


</head>

<body  onload="crearReloj()">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block bg-dark">
            <div class="section__content section__content--p35">
                <div class="header3-wrap ">
                    <div class="header__logo">
                        <a href="../vistas/inicio.php">
                            <img src="../images/1.png" width="285"  alt="Sistema Contable" />
                        </a>
                        
                    </div>
                   
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            
                            <li>
                                <a href="../vistas/inicio.php">
                                    <i class="fas fa-home text-white"></i>
                                    <span class="bot-line text-white"></span>Inicio</a>
                            </li>
                            <li class="has-sub">
                                <a href="../vistas/catalogo.php">
                                <i class="fas fa-book"></i>
                                    
                                    <span class="bot-line"></span>Catálogo</a>
                                <ul class="header3-sub-list list-unstyled">
                                 
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-book"></i>
                                    <span class="bot-line"></span>Libros</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="../vistas/partida.php">Libro Diario</a>
                                    </li>
                                    <li>
                                        <a href="../vistas/libromayor.php">Libro Mayor</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-bar-chart-o"></i>
                                    <span class="bot-line"></span>Estados Financieros</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="../vistas/estadoderesultado.php">Estado de Resultados</a>
                                    </li>
                                    <li>
                                        <a href="../vistas/balancegeneral.php">Balance General</a>
                                    </li>

                           
                                </ul>
                            </li>
                             
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-user-plus"></i>
                                    <span class="bot-line"></span>Registros</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="../vistas/saldo.php">Saldo</a>
                                    </li>
                                    <li>
                                        <a href="../vistas/tipo.php">Tipo de Saldo</a>
                                    </li>
                                    <li>
                                        <a href="../vistas/usuario.php">Usuarios</a>
                                    </li>
                                 
                                    


                         
                            
                           
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div id="reloj" class="text-white"></div>
                        
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                            
                                <div class="image">
                                    <img src="../images/user.png" alt="John Doe" />
                                </div>
                                <div class="content" >
                                    <a style="color: white;" class="js-acc-btn" href="#"><?php if($_SESSION["s_usuario"] === null){
                                                echo "Iniciar Sesion";
                                            }else{  echo $_SESSION["s_usuario"];
                                            }?></a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                
                                   
                                    <div class="account-dropdown__footer">
                                        <a href="../bd/logout.php">
                                            <i class="zmdi zmdi-power"></i>Cerrar Sesion</a>
                                            </div>

                                            <div class="account-dropdown__footer">
                                    <?php 
                                     $consulta = "SELECT * FROM partida WHERE cierre=2";
                                     $resultado = $conexion->prepare($consulta);
                                     $resultado->execute();
                                     $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                    if ($data==null) {
                                    ?>
                                        <li>
                                            <a href="../vistas/cierre.php"><i class="zmdi zmdi-folder-person"></i>Cierre Contable</a>
                                        </li>
                                   <?php }else if ($data!=null) {?>
                                        <li>
                                            <a href="../vistas/iniciooperaciones.php"><i class="zmdi zmdi-folder-person"></i>Inicio de Operaciones</a>
                                        </li>
                                    <?php }?>
                                    <li>
                                            <a href="../vistas/nombre.php"><i class="zmdi zmdi-file"></i>Nombre de la Empresa</a>
                                        </li>
                                </ul>
                            </li>
                            </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                
                
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">john doe</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">john doe</a>
                                    </h5>
                                    <span class="email">johndoe@example.com</span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-account"></i>Account</a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="#">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->
        <script type="text/javascript" src="../jsvistas/jsReloj.js"></script>