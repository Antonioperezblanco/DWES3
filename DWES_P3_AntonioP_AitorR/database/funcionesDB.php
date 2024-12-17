<?php

include_once "../model/User.php";

function conectarBD(){
    $server = "127.0.0.1";
    $user = "root";
    $password = "Sandia4you";
    $db = "proyecto";

    $conexion = new mysqli($server, $user, $password, $db);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    } else {
        return $conexion;
    }
}
