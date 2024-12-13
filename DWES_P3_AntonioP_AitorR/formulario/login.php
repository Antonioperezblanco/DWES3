<?php
include_once "../funciones/securizar.php";
$nUsuario = $email = $password = "";
$nUsuarioErr = $emailErr = $passwordErr = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nUsuario = securizar($_POST["nombre"]);
    $email = isset($_POST["email"]) ? securizar($_POST["email"]) : '';
    $password = isset($_POST["pass"]) ? securizar($_POST["pass"]) : '';

    if (empty($nUsuario)) {
        $nUsuarioErr = "No puede estar vacío.";
        $error = true;
    }

    if (empty($email)) {
        $emailErr = "No puede estar vacío.";
        $error = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Formato de correo inválido.";
        $error = true;
    }

    if (empty($password)) {
        $passwordErr = "Rellena la contraseña.";
        $error = true;
    } elseif(!$nUsuario){
        if(!verificarPassEmail($email, $password)){
            $passwordErr = "El email o la contraseña es incorrecto";
            $error = true;
        }
    }

    setcookie("user", $nUsuario, time() + 5 * 60);
    setcookie("email", $email, time() + 5 * 60);

    if (!$error) {
        
        $_SESSION["u"] = $nUsuario;
        $_SESSION["email"] = $email;
        $_SESSION["origin"] = "login";
        header("Location: ./index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/formulario.css">
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
        <label>Selecciona una forma de registro</label>
        <br>
        <label>Nombre de usuario </label>
        <input type="radio" name="usuario" id="login">
        <label>Correo electrónico </label> 
        <input type="radio" name="usuario" id="corr">
        <br>

        <label id="labelInput">NOMBRE DE USUARIO</label>
        <input 
            type="text" 
            name="nombre" 
            id="login" 
            value="<?php echo $nUsuario ?>"
            class="<?php if(!empty($nUsuarioErr)) echo "is-invalid"; ?>"
        >
        <div class="invalid-feedback"><?php echo $nUsuarioErr ?></div>
        <br>

        <div class="mb-3 position-relative">
            <label for="pass" class="form-label">CONTRASEÑA:</label>
            <input 
                type="password" 
                name="pass" 
                id="pass" 
                class="<?php if(!empty($passwordErr)) echo 'is-invalid'; ?>"
            />
            <i class="fa-solid fa-eye" id="mostrar"></i>
            <div class="invalid-feedback"><?php echo $passwordErr ?></div>
        </div>

        <input type="submit">
        <input type="reset">
        <br>
        <label>¿No estás registrado? <a href="./singUpUser.php">Registrarse</a></label>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const mostrar = document.getElementById("mostrar");
    const con = document.getElementById("pass");
    const input = document.getElementById("nombre");
    const botonUsuario = document.getElementById("login");
    const botonCorreo = document.getElementById("corr");
    const label = document.getElementById("labelInput");

    mostrar.addEventListener("click", () => {
        if(con.type == "password") {
            con.type = "text";
            mostrar.className = "fa-solid fa-eye-slash";
        } else {
            con.type = "password";
            mostrar.className = "fa-solid fa-eye";
        }
    });
    botonUsuario.addEventListener("click", () => {
    label.textContent = "NOMBRE DE USUARIO"; 
    input.type = "text"; 
    input.name = "nombre";  
    input.value = "<?php echo $nUsuario; ?>";  
    input.className = "<?php if(!empty($nUsuarioErr)) echo 'is-invalid'; ?>";  
});
    
    botonCorreo.addEventListener("click", () => {
    label.textContent = "CORREO";  
    input.type = "email";  
    input.name = "email";  
    input.value = "<?php echo $email; ?>";  
    input.className = "<?php if(!empty($emailErr)) echo 'is-invalid'; ?>";  
});



    </script>
</body>
</html>
