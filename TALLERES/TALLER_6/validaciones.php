<?php
function validarNombre($nombre)
{
    return !empty($nombre) && strlen($nombre) <= 50;
}

function validarEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/*
function validarEdad($nacimiento)
{
    echo '**********<br>';

    return ;
}
*/


function validarNacimiento($nacimiento)
{
    $tiempo = strtotime($nacimiento);
    $fechaNacimiento  = new DateTime($nacimiento);
    $fechaActual = new DateTime(date('Y-m-d'));
    $diferencia = $fechaNacimiento->diff($fechaActual);
    return ($nacimiento == date('Y-m-d', $tiempo)) && ($diferencia->y >= 10) && ($diferencia->y <= 120);
}



function validarSitioweb($sitioWeb)
{
    return empty($sitioWeb) || filter_var($sitioWeb, FILTER_VALIDATE_URL);
}

function validarGenero($genero)
{
    $generosValidos = ['masculino', 'femenino', 'otro'];
    return in_array($genero, $generosValidos);
}

function validarIntereses($intereses)
{
    $interesesValidos = ['deportes', 'musica', 'lectura'];
    return !empty($intereses) && count(array_intersect($intereses, $interesesValidos)) === count($intereses);
}

function validarComentarios($comentarios)
{
    return strlen($comentarios) <= 500;
}

function validarFotoPerfil($archivo)
{
    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
    $tamanoMaximo = 1 * 1024 * 1024; // 1MB

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    if (!in_array($archivo['type'], $tiposPermitidos)) {
        return false;
    }

    if ($archivo['size'] > $tamanoMaximo) {
        return false;
    }

    return true;
}
