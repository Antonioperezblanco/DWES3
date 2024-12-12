<?php
include_once "../funciones/securizar.php";
session_start();

$user = $password = $passwordConf = "";
$userErr = $passwordErr = $confErr = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = securizar($_POST["user"]);
    $password = securizar($_POST["pass"]);
    $passwordConf = securizar($_POST["confPass"]);

    if (empty($user)) {
        $userErr = "No puede estar vacío.";
        $error = true;
    }

    if (empty($password)) {
        $passwordErr = "Rellena la contraseña.";
        $error = true;
    } elseif (strlen($password) < 8 || strlen($password) > 20) {
        $passwordErr = "Debe tener entre 8 y 20 caracteres.";
        $error = true;
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/", $password)) {
        $passwordErr = "Debe contener al menos una letra y un número.";
        $error = true;
    }

    if (empty($passwordConf)) {
        $confErr = "Rellena este campo.";
        $error = true;
    } elseif ($password !== $passwordConf) {
        $confErr = "Las contraseñas no coinciden.";
        $error = true;
    }

    setcookie("user", $user, time() + 5 * 60);

    if (!$error) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION["u"] = $user;
        $_SESSION["origin"] = "signup";
        header("Location: ./index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>
<body>
<?php echo var_dump($_POST);

?>


<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
    <label>USUARIO:</label>
    <input type="text" name="user"
    value="<?php echo $user?>"
    class="<?php if(!empty($userErr)) echo "error"?>">
    <label><?php echo $userErr ?></label>
    <br>
    <label>CONTRASEÑA:</label>
    <input type="password" name="pass" id="pass"
    class="<?php if(!empty($passwordErr)) echo "error"?>">
    <i class="fa-solid fa-eye" id="mostrar"></i>
    <label><?php echo $passwordErr ?></label>
    <br>
    <label>CONFIRMAR CONTRASEÑA:</label>
    <input type="password" name="confPass" id="confPass"
    class="<?php if(!empty($confErr)) echo "error"?>">
    <label><?php echo $confErr ?></label>
    <br>

    <input type="submit">


</form>
    <script>
        const mostrar = document.getElementById("mostrar");
        const con = document.getElementById("pass");
        const confCon = document.getElementById("confPass");

        mostrar.addEventListener("click", () => {
            if(con.type=="password"){
                con.type="text";
                confCon.type="text";
                mostrar.className="fa-solid fa-eye-slash"
            } else{
                con.type="password"
                confCon.type="password";
                mostrar.className = "fa-solid fa-eye"; 

            }
        }
    )
    </script>
</body>
</html>