<?php
include_once "../funciones/securizar.php";
include_once "../database/funcionesDB.php";
include_once "../database/funcionesUsuarios.php";
$nUsuario = $email = $password = "";
$nUsuarioErr = $emailErr = $passwordErr = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nUsuario = isset($_POST["nombre"]) ? securizar($_POST["nombre"]) : '' ;
    $email = isset($_POST["email"]) ? securizar($_POST["email"]) : '';
    $password = securizar($_POST["pass"]);

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
        if(!existeNombre($nUsuario) || !verificarPassEmail($email, $password)){
            $nUsuarioErr = "Tienes que introducir un nombre de usuario existente";
            $error = true;
        }
    } elseif(!$email){
        if(!verificarPassName($nUsuario, $password)){
            $passwordErr = "El nombre o la contraseña es incorrecto";
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
    <div class="form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h3 class="text-center">Iniciar Sesión</h3>

            <div class="mb-3">
                <div class="row">
                <label class="cabecera">FORMA DE INICIO</label>
                <div class="form-check col-6">
                    <input type="radio" class="cabecera form-check-input" name="usuario" id="login">
                    <label for="login" class="form-check-label">Nombre de usuario</label>
                </div>
                <div class="form-check col-6">
                    <input type="radio" class="form-check-input" name="usuario" id="corr">
                    <label for="corr" class="form-check-label">Correo electrónico</label>
                </div>
            </div>
            </div>

            <div class="mb-3">
                <label id="labelInput" class="cabecera">NOMBRE DE USUARIO: </label>
                <input 
                    type="text" 
                    name="nombre" 
                    id="nombre" 
                    value="<?php echo $nUsuario; ?>"
                    class="form-control <?php if (!empty($nUsuarioErr)) echo 'is-invalid'; ?>">
                <div class="invalid-feedback"><?php echo $nUsuarioErr; ?></div>
            </div>

            <div class="mb-3 position-relative">
                <label for="pass" class="cabecera form-label">CONTRASEÑA:</label>
                <input 
                    type="password" 
                    name="pass" 
                    id="pass" 
                    class="form-control <?php if (!empty($passwordErr)) echo 'is-invalid'; ?>">
                <i class="fa-solid fa-eye" id="mostrar"></i>
                <div class="invalid-feedback"><?php echo $passwordErr; ?></div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <button type="reset" class="btn btn-secondary">Restablecer</button>
            </div>

            <p class="mt-3 text-center">
                ¿No estás registrado? <a href="./singUpUser.php">Registrarse</a>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const mostrar = document.getElementById("mostrar");
        const con = document.getElementById("pass");
        const input = document.getElementById("nombre");
        const botonUsuario = document.getElementById("login");
        const botonCorreo = document.getElementById("corr");
        const label = document.getElementById("labelInput");

        mostrar.addEventListener("click", () => {
            if (con.type === "password") {
                con.type = "text";
                mostrar.className = "fa-solid fa-eye-slash";
            } else {
                con.type = "password";
                mostrar.className = "fa-solid fa-eye";
            }
        });

        botonUsuario.addEventListener("click", () => {
            label.textContent = "NOMBRE DE USUARIO: "; 
            input.type = "text"; 
            input.name = "nombre";  
            input.value = "<?php echo $nUsuario; ?>";  
            input.className = "form-control <?php if (!empty($nUsuarioErr)) echo 'is-invalid'; ?>";  
        });

        botonCorreo.addEventListener("click", () => {
            label.textContent = "CORREO: ";  
            input.type = "email";  
            input.name = "email";  
            input.value = "<?php echo $email; ?>";  
            input.className = "form-control <?php if (!empty($emailErr)) echo 'is-invalid'; ?>";  
        });
    </script>
</body>
</html>