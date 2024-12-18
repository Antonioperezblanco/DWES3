<?php
include_once $_SERVER ["DOCUMENT_ROOT"] . "/DWES_P3_AntonioP_AitorR/database/funcionesDB.php";

function insertMage(Mage $mage){
    $conectar = conectarBD();
    $sql = "INSERT INTO mage (name, hp, damage, lvl, numBattle, dodge, health, id, id_user) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conectar->prepare($sql);
    
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conectar->error);
    }

    $name = $mage->getName();
    $hp = $mage->getHp();
    $damage = $mage->getDamage();
    $lvl = $mage->getLevel();
    $numBattle = $mage->getNumBattle();
    $dodge = $mage->getDodge();
    $health = $mage->getHealth();
    $id_user = $mage->getIdUser();

    $stmt->bind_param("siiiisii", $name, $hp, $damage, $lvl, $numBattle, $dodge, $health, $id_user);

    if (!$stmt->execute()) {
        echo "Error al insertar el Mago: " . $stmt->error . "<br>";
    } else {
        echo "Mago insertado correctamente.<br>";
    }

    $stmt->close();
    $conectar->close();
}
function insertJuggernaut(Juggernaut $juggernaut){
    $conectar = conectarBD();
    $sql = "INSERT INTO juggernaut (name, hp, damage, lvl, numBattle, resistance, id_user) VALUES(?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conectar->prepare($sql);
    
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conectar->error);
    }

    $name = $juggernaut->getName();
    $hp = $juggernaut->getHp();
    $damage = $juggernaut->getDamage();
    $lvl = $juggernaut->getLevel();
    $numBattle = $juggernaut->getNumBattle();
    $resistance = $juggernaut->getResistance();
    $id_user = $juggernaut->getIdUser();

    $stmt->bind_param("siiiiii", $name, $hp, $damage, $lvl, $numBattle, $resistance, $id, $id_user);

    if (!$stmt->execute()) {
        echo "Error al insertar el Juggernaut: " . $stmt->error . "<br>";
    } else {
        echo "Jaggernaut insertado correctamente.<br>";
    }

    $stmt->close();
    $conectar->close();
}
function insertWarrior(Warrior $warrior){
    $conectar = conectarBD();
    $sql = "INSERT INTO warrior (name, hp, damage, lvl, numBattle, weapon, id_user) VALUES(?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conectar->prepare($sql);
    
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conectar->error);
    }

    $name = $warrior->getName();
    $hp = $warrior->getHp();
    $damage = $warrior->getDamage();
    $lvl = $warrior->getLevel();
    $numBattle = $warrior->getNumBattle();
    $weapon = $warrior->getWeapon();
    $id_user = $warrior->getIdUser();

    $stmt->bind_param("siiiisi", $name, $hp, $damage, $lvl, $numBattle, $weapon, $id, $id_user);

    if (!$stmt->execute()) {
        echo "Error al insertar el guerrero: " . $stmt->error . "<br>";
    } else {
        echo "Guerrero insertado correctamente.<br>";
    }

    $stmt->close();
    $conectar->close();
}


?>