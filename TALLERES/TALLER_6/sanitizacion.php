
<?php
function sanitizarNombre($nombre)
{
    return filter_var(trim($nombre), FILTER_SANITIZE_SPECIAL_CHARS);
}

function sanitizarEmail($email)
{
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}


function sanitizarNacimiento($nacimiento)
{
    return filter_var(trim($nacimiento), FILTER_SANITIZE_SPECIAL_CHARS);
}


/*
function sanitizarEdad($nacimiento)
{
    return filter_var($nacimiento, FILTER_SANITIZE_NUMBER_INT);
}
*/

function sanitizarSitioweb($sitioWeb)
{
    return filter_var(trim($sitioWeb), FILTER_SANITIZE_URL);
}

function sanitizarGenero($genero)
{
    return filter_var(trim($genero), FILTER_SANITIZE_SPECIAL_CHARS);
}

function sanitizarIntereses($intereses)
{
    return array_map(function ($interes) {
        return filter_var(trim($interes), FILTER_SANITIZE_SPECIAL_CHARS);
    }, $intereses);
}

function sanitizarComentarios($comentarios)
{
    return htmlspecialchars(trim($comentarios), ENT_QUOTES, 'UTF-8');
}
?>
        