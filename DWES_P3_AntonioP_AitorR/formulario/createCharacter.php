<?php
include_once "../funciones/securizar.php";
include_once "../database/funcionesDB.php";
include_once "../database/funcionesUsuarios.php";

$name = $weapon = "";
$choose = isset($_POST["choose"]) ? $_POST["choose"] : "0"; 
$nameErr = $chooseErr = $weaponErr = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = securizar($_POST["name"]);

    if (empty($name)) {
        $nameErr = "No puede estar vacío.";
        $error = true;
    }

    if ($choose == "0") {
        $chooseErr = "Elige un personaje";
        $error = true;
    }

    if ($choose == "warrior") {
        $weapon = isset($_POST["weapon"]) ? $_POST["weapon"] : "0";
        if ($weapon == "0") {
            $weaponErr = "Elige un arma";
            $error = true;
        }
    }

    setcookie("name", $name, time() + 5 * 60);

    if (!$error) {
        $_SESSION["u"] = $name;
        header("Location: ./index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <label for="choose">Character's role:</label>
    <select name="choose" id="choose">
        <option value="0" <?php if ($choose == "0") echo "selected"; ?>>Choose a role</option>
        <option value="warrior" <?php if ($choose == "warrior") echo "selected"; ?>>Warrior</option>
        <option value="mage" <?php if ($choose == "mage") echo "selected"; ?>>Mage</option>
        <option value="juggernaut" <?php if ($choose == "juggernaut") echo "selected"; ?>>Juggernaut</option>
    </select>
    <span style="color:red;"><?php echo $chooseErr; ?></span>
    <br>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
    <span style="color:red;"><?php echo $nameErr; ?></span>
    <br>

    <div id="weapon">
        <?php if ($choose == "warrior") { ?>
            <label for="weapon-select">Choose your weapon:</label>
            <select name="weapon" id="weapon-select">
                <option value="0">Choose a weapon</option>
                <option value="sword" <?php if ($weapon == "sword") echo "selected"; ?>>Sword</option>
                <option value="shield" <?php if ($weapon == "shield") echo "selected"; ?>>Shield</option>
            </select>
            <span style="color:red;"><?php echo $weaponErr; ?></span>
        <?php } ?>
    </div>
    <br>

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>

<script>
    const choose = document.getElementById('choose');
    const weaponContainer = document.getElementById('weapon');

    const warriorWeapons = ["Sword", "Shield"];

    choose.addEventListener("change", () => {
        weaponContainer.innerHTML = "";

        if (choose.value === "warrior") {
            const label = document.createElement("label");
            label.textContent = "Choose your weapon:";
            weaponContainer.appendChild(label);

            const select = document.createElement("select");
            select.name = "weapon";
            select.id = "weapon-select";

            // Opción por defecto
            const defaultOption = document.createElement("option");
            defaultOption.value = "0";
            defaultOption.textContent = "Choose a weapon";
            select.appendChild(defaultOption);

            // Opciones para warrior
            warriorWeapons.forEach(weapon => {
                const option = document.createElement("option");
                option.value = weapon.toLowerCase();
                option.textContent = weapon;
                select.appendChild(option);
            });

            weaponContainer.appendChild(select);
        }
    });
</script>
</body>
</html>
