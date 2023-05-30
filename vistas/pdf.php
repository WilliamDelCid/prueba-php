<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La tiendita!!!</title>
    <meta name="keywords" content="la tienda, eliseoweb.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

       <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/script.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function verificar(pagina){

            var tamanio = document.getElementById('tamanio').value;
            var orientacion = document.getElementById('orientacion').value;
            
            window.open(pagina+'?orientacion='+orientacion+'&format='+tamanio, '_blank');

        }
    </script>
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h1>Configurar Reporte Clasificacion</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="productox.php" name="latienda" id="latienda" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" id="bandera" name="bandera">
                            <input type="hidden" id="baccion" name="baccion" value="<?php echo $id; ?>">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Tama&ntilde;o</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <select class="form-control" name="tamanio" id="tamanio">
                                            <option value="LETTER">Carta</option>
                                            <option value="LEGAL">Oficio</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Orientacion</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <select class="form-control" name="orientacion" id="orientacion">
                                            <option value="P">Vertical</option>
                                            <option value="L">Horizontal</option>
                                        </select>

                                    </div>
                                </div>
                            </div>                       


                            <div class="row">
                                <div class="col-lg-5">

                                </div>
                                <div class="col-lg-7">
                                    <button type="button" class="btn btn-info" onclick="verificar('../reportePDF/pdf.php')">Generar PDF</button>
                                </div>
                            </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>


    </div>

    
    <script src="assets/js/vendor/popper.min.js"></script>
   

</body>


</html>