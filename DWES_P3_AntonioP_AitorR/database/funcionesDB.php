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

function createTableMage(){
    $conexion = conectarBD();
    $sql = "CREATE TABLE IF NOT EXISTS mage (name VARCHAR (50), HP INT, damage INT, lvl INT, numBattle INT, dodge BOOLEAN, health INT, id_user INT,FOREIGN KEY (id_user) REFERENCES usuario(id), id INT PRIMARY KEY AUTO_INCREMENT)";
    if (mysqli_query($conexion, $sql)) {
        echo "Tabla 'mage' creada correctamente.";
    } else {
        echo "Error al crear la tabla: " . mysqli_error($conexion);
    }
}
function createTableJuggernaut(){
    $conexion = conectarBD();
    $sql = "CREATE TABLE IF NOT EXISTS juggernaut (name VARCHAR (50), HP INT, damage INT, lvl INT, numBattle INT, resistance INT, id_user INT, FOREIGN KEY (id_user) REFERENCES usuario(id), id INT PRIMARY KEY AUTO_INCREMENT)";
    if (mysqli_query($conexion, $sql)) {
        echo "Tabla 'juggernaut' creada correctamente.";
    } else {
        echo "Error al crear la tabla: " . mysqli_error($conexion);
    }
}
function createTableWarrior(){
    $conexion = conectarBD();
    $sql = "CREATE TABLE IF NOT EXISTS warrior (name VARCHAR (50), HP INT, damage INT, lvl INT, numBattle INT, weapon VARCHAR(10), id_user INT, FOREIGN KEY (id_user) REFERENCES usuario(id), id INT PRIMARY KEY AUTO_INCREMENT)";
    if (mysqli_query($conexion, $sql)) {
        echo "Tabla 'warrior' creada correctamente.";
    } else {
        echo "Error al crear la tabla: " . mysqli_error($conexion);
    }
}


function createTableUsuario(){
    $conexion = conectarBD();
    $sql = "CREATE TABLE IF NOT EXISTS usuario (nickname VARCHAR (50),pass VARCHAR(255), id INT PRIMARY KEY AUTO_INCREMENT, email VARCHAR (50))";
    if (mysqli_query($conexion, $sql)) {
        echo "Tabla 'usuario' creada correctamente.";
    } else {
        echo "Error al crear la tabla: " . mysqli_error($conexion);
    }
}
