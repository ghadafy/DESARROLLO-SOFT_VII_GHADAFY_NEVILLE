<?php

function contar_palabras($texto)
{
    $cont = 0;
    $palabra = "";
    $palabras = [];
    $ind = 0;
    for ($i = 0; $i < strlen($texto); $i++) {
        if ($texto[$i] != " ") {
            $palabra .= $palabra . $texto[$i];
        } else {
            $palabras[$ind] = $palabra;
            $palabra = "";
            $ind++;
        }
    }
    print_r($palabras);
}

function contar_vocales($texto)
{
    $vocales = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
    //foreach($texto)


}

function invertir_palabras($texto)
{
}

$cadena = "Estoy en clases de PHP";
echo contar_palabras($cadena);
