<?php

$ciudades = [
    "Nueva York", "Londres", "París", "Tokio", "Sídney",
    "Berlín", "Madrid", "Roma", "Amsterdam", "Toronto",
    "Los Ángeles", "Dubái", "Hong Kong", "Singapur", "Seúl",
    "Buenos Aires", "Ciudad de México", "Barcelona", "Moscú", "Estocolmo",
    "Chicago", "Vancouver", "Lisboa", "Bangkok", "Múnich"
];


#imprimir el arreglo de diferentes modos
#forma 1 
function forma1($arreglo)
{
    echo "Forma 1 con print_r <br>";
    print_r($arreglo);
}


#forma2
function forma2($arreglo)
{
    echo "<br><br>Forma 2  con el ciclo for <br>";
    for ($i = 0; $i < count($arreglo); $i++) {
        if (!is_array($arreglo[$i])) {
            echo ($i + 1) . " - " . $arreglo[$i] . "<br>";
        } else {
            echo ($i + 1) . " - " . implode("  ", $arreglo[$i]) . "<br>";
        }
    }
}

#forma 3
function forma3($arreglo)
{
    echo "<br><br>Forma 3 con el ciclo while<br>";
    $i = 0;
    while ($i < count($arreglo)) {
        echo ($i + 1) . " - " . $arreglo[$i] . "<br>";
        $i++;
    }
}


#forma 4
function forma4($arreglo)
{
    echo "<br><br>Forma 4 con foreach <br>";
    foreach ($arreglo as $clave => $valor) {
        echo ($clave + 1) . " - " . $valor . "<br>";
    }
}

echo "Arreglo original";
forma4($ciudades);

/*
#agregar ciudades al arreglo
echo "<br><br>Agregando elementos al arreglo con array_push <br>";
array_push($ciudades, "Arraijan", ["Peze", "Colón"]);
forma2($ciudades);
*/

/*
#elimina la tercera ciudad
echo "<br><br>Eliminando la tercer aciudad del arreglo<br>";
array_splice($ciudades, 2, 1);
forma4($ciudades);
*/

/*
#insertar ciudad
echo "<br><br>Insertar una nueva ciudad en la quinta posicion<br>";
array_splice($ciudades, 5, 0, "Ciudad Bolivar");
forma4($ciudades);
*/

/*
function imprecionOrdenada($arreglo)
{
    echo "<br>Impresion ordenada<br>";
    rsort($arreglo);
    foreach ($arreglo as $valor) {
        echo $valor . "<br>";
    }
}

imprecionOrdenada($ciudades);
*/

//echo "<br>" . strlen("ghadafy");
$letra = "c";

function tarea1($arreglo, $letra)
{
    $cont = 0;
    foreach ($arreglo as $valor) {
        if (strtolower($letra) == strtolower($valor[0]))
            $cont++;
    }
    echo $cont;
}

tarea1($ciudades, $letra);
