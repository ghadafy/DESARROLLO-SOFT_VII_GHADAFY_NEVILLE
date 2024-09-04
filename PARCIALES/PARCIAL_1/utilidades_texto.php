<?php

function contar_palabras($texto)
{
    $cont = 0;
    $palabra = "";
    $palabras = [];
    $ind = 0;
    for ($i = 0; $i < strlen($texto); $i++) {
        if ($texto[$i] != " " || $i == strlen($texto) - 1) {
            $palabra .= $texto[$i];
        } else {
            $palabras[$ind] = $palabra;
            $palabra = "";
            $ind++;
        }
    }
    $cantidad = count($palabras) + 1;
    echo "La cadena tiene $cantidad palabras";
}



function contar_vocales($texto)
{
    $cont = 0;
    $vocales = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];

    for ($i = 0; $i < strlen($texto); $i++) {
        for ($j = 0; $j < 10; $j++) {
            if ($texto[$i] == $vocales[$j]) {
                $cont++;
            }
        }
    }
    echo "La cadena tiene $cont vocales";
}



function invertir_palabras($palabra)
{

    $nueva_palabra = "";
    $i = strlen($palabra) - 1;
    while ($i >= 0) {
        $nueva_palabra .= $palabra[$i];
        $i--;
    }

    echo "La cadena invertida es: " . $nueva_palabra;
}
