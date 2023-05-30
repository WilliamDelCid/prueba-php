<?php

include "config.php";

$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);

if ($conexion->connect_errno) {
    echo "Error de conexion";
}
