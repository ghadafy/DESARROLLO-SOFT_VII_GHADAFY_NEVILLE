<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';

function calcularDiferencia($fecha)
{
    $fechaNacimiento  = new DateTime($fecha);
    $fechaActual = new DateTime(date('Y-m-d'));
    $diferencia = $fechaNacimiento->diff($fechaActual);
    return $diferencia->y;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $datos = [];

    // Procesar y validar cada campo
    $campos = ['nombre', 'email', 'nacimiento', 'sitioweb', 'genero', 'intereses', 'comentarios'];
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            $valor = $_POST[$campo];
            $valorSanitizado = call_user_func("sanitizar" . ucfirst($campo), $valor);
            $datos[$campo] = $valorSanitizado;

            if (!call_user_func("validar" . ucfirst($campo), $valorSanitizado)) {
                $errores[] = "El campo $campo no es válido.";
            }
        }
    }

    // Procesar la foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        if (!validarFotoPerfil($_FILES['foto_perfil'])) {
            $errores[] = "La foto de perfil no es válida.";
        } else {
            //  $rutaDestino = 'uploads/' . basename($_FILES['foto_perfil']['name']);

            $nombreArchivo = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_FILENAME); //Nombre sin extension
            $marcaTiempo = date('YmdHis');  //Fecha-hora-minutos-segundo cuando se sube
            $extension =  pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION); //Extension
            $nuevoNombre = $nombreArchivo . '-' . $marcaTiempo . '.' . $extension;
            $rutaDestino = 'uploads/' . $nuevoNombre;


            if (file_exists($rutaDestino)) {
                echo "El archivo ya existe. Intente con otro.";
            } else {


                if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
                    $datos['foto_perfil'] = $rutaDestino;
                } else {
                    $errores[] = "Hubo un error al subir la foto de perfil.";
                }
            }
        }
    }

    // Mostrar resultados o errores
    if (empty($errores)) {
        echo "<h2>Datos Recibidos:</h2>";

        foreach ($datos as $campo => $valor) {
            if ($campo === 'intereses') {
                echo "$campo: " . implode(", ", $valor) . "<br>";
            } elseif ($campo === 'foto_perfil') {
                echo "$campo: <img src='$valor' width='100'><br>";
            } elseif ($campo === 'nacimiento') {
                echo "$campo: $valor<br>";
                echo "edad: " . calcularDiferencia($valor) . '<br>';
            } else {
                echo "$campo: $valor<br>";
            }
        }
    } else {
        echo "<h2>Errores:</h2>";
        foreach ($errores as $error) {

            echo "<p style='color:red;'>$error</p>";
        }
        include 'formulario.php';
    }
} else {
    echo "Acceso no permitido.";
}
