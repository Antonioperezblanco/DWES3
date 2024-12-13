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

function existeMail($email):bool{

    $sql = "SELECT email FROM usuario WHERE email = ?";
    $c = conectarBD();
    $p = $c->prepare($sql);
    $p->bind_param("s", $email);
    $p->execute();
    $result = $p->get_result(); 
    return $result->num_rows > 0;

}

function existeNombre($nickname):bool{

    $sql = "SELECT nickname FROM usuario WHERE nickname = ?";
    $c = conectarBD();
    $p = $c->prepare($sql);
    $p->bind_param("s", $nickname);
    $p->execute();
    $result = $p->get_result(); 
    return $result->num_rows > 0;

}


function insertarUsuario($usuario) {
    $sql = "INSERT INTO `usuario` (nickname, email, pass) VALUES (?, ?, ?)";
    $conexion = conectarBD(); 
    $stmt = $conexion->prepare($sql); 
    
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $nickname = $usuario->getNickname();
    $email = $usuario->getEmail();
    $pass = $usuario->getPassword();
    

    $stmt->bind_param("sss", $nickname, $email, $pass);

    if (!$stmt->execute()) {
        echo "Error al insertar el usuario: " . $stmt->error . "<br>";
    } else {
        echo "Usuario insertado correctamente.<br>";
    }

    $stmt->close();
    $conexion->close();
}

function verificarPassEmail($email, $pass){
    $sql = "SELECT pass FROM usuario WHERE email = ?";
    $c= conectarBD();
    $p = $c->prepare($sql);
    $p->bind_param("s", $email);
    $p->execute();
    $result = $p->get_result();
    $passBD = $result->fetch_assoc();
        return password_verify($pass, $passBD["pass"]);
    }