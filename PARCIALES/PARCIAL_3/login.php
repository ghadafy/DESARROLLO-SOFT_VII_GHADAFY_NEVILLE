<?php
session_start();
$msj = "";

require_once 'requerimientos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['usuario']) && isset($_POST['pass'])) {


        //sanitizamos
        $usuario =  htmlspecialchars(trim($_POST['usuario']));
        $pass =  htmlspecialchars(trim($_POST['pass']));
        $tipo = $_POST['tipo'];

        //validamos
        if (strlen($usuario) >= 3 && strlen($pass) >= 5) {
            $usuario = $usuario;
            $pass = $pass;

            foreach ($credenciales as $datos) {
                if ($datos['usuario'] == $usuario &&  $datos['pass'] == $pass && $datos['tipo'] == $tipo) {
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['nombre'] = $datos['nombre'];
                    $_SESSION['tipo'] = $tipo;
                    header('Location:index.php');
                }
            }
        } else {
            $msj = "Usuario y/o contraseña incorrecta";
        }
    } else {
        $msj = "Datos no recibidos";
    }
} else {
    $msj = "Datos no recibidos";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>

<body>
    <H3>LOGIN</H3>
    <p><?php echo $msj; ?></p>
    <form action="" method="post">


        <label for="usuario">usuario</label><br>
        <input type="text" name="usuario" id="usuario"><br>
        <label for="pass">Password</label><br>
        <input type="password" name="pass" id="pass"><br>
        <label for="tipo">TIPO</label>
        <select name="tipo" id="tipo">
            <option value="1">Profesor</option>
            <option value="2">Estudiante</option>
        </select><br><br>

        <input type="submit" value="Entrar">


    </form>

</body>

</html>