<?php
include_once "../funciones/securizar.php";
include_once "../model/User.php";
include_once "../database/funcionesDB.php";
include_once "../database/funcionesUsuarios.php";
session_start();

$user = $password = $passwordConf = $email = "";
$userErr = $passwordErr = $confErr = $emailErr = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = securizar($_POST["user"]);
    $password = securizar($_POST["pass"]);
    $passwordConf = securizar($_POST["confPass"]);
    $email = securizar($_POST["email"]);

    if (empty($user)) {
        $userErr = "No puede estar vacío.";
        $error = true;
    } elseif(existeNombre($user)){
        $userErr = "Nombre de usuario ya existe.";
        $error = true;
    }

    if (empty($email)) {
        $emailErr = "No puede estar vacío.";
        $error = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Formato de correo inválido.";
        $error = true;
    } elseif(existeMail($email)){
        $emailErr = "Correo electrónico ya existe.";
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
        $_SESSION["email"] = $email;
        $_SESSION["origin"] = "signup";
        $usuario = new User($user, $email, $hashedPassword);
        insertarUsuario($usuario);
        header("Location: ./index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/formulario.css">
   
</head>
<body>

<div class="container">
    <div class="form-container">
        <h3 class="text-center mb-4">Registro</h3>

        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            
            <div class="mb-3">
                <label for="user" class="form-label" >USUARIO:</label>
                <input type="text" name="user" id="user" class="form-control <?php if(!empty($userErr)) echo 'is-invalid'; ?>" value="<?php echo $user ?>" />
                <div class="invalid-feedback"><?php echo $userErr ?></div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">CORREO ELECTRÓNICO:</label>
                <input type="email" name="email" id="email" class="form-control <?php if(!empty($emailErr)) echo 'is-invalid'; ?>" value="<?php echo $email ?>" />
                <div class="invalid-feedback"><?php echo $emailErr ?></div>
            </div>

            <div class="mb-3 position-relative">
                <label for="pass" class="form-label">CONTRASEÑA:</label>
                <input type="password" name="pass" id="pass" class="form-control <?php if(!empty($passwordErr)) echo 'is-invalid'; ?>" />
                <i class="fa-solid fa-eye" id="mostrar"></i>
                <div class="invalid-feedback"><?php echo $passwordErr ?></div>
            </div>

            <div class="mb-3 position-relative">
                <label for="confPass" class="form-label">CONFIRMAR CONTRASEÑA:</label>
                <input type="password" name="confPass" id="confPass" class="form-control <?php if(!empty($confErr)) echo 'is-invalid'; ?>" />
                <div class="invalid-feedback"><?php echo $confErr ?></div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar</button>
            <span>¿Ya estás registrado? <a href="./login.php">Iniciar sesión</a></span>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const mostrar = document.getElementById("mostrar");
    const con = document.getElementById("pass");
    const confCon = document.getElementById("confPass");

    mostrar.addEventListener("click", () => {
        if(con.type == "password") {
            con.type = "text";
            confCon.type = "text";
            mostrar.className = "fa-solid fa-eye-slash";
        } else {
            con.type = "password";
            confCon.type = "password";
            mostrar.className = "fa-solid fa-eye";
        }
    });
</script>
</body>
</html>