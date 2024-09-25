
<?php

$arreglo = array();

//Pido los valores
for ($i = 0; $i < 10; $i++) {
    $num = readline("Ingrese el valor " . ($i + 1) . ": ");
    array_push($arreglo, $num);
}





//Muestro los datos
$suma = 0;
$sumatoria = 0;

for ($j = 0; $j < 10; $j++) {

    if ($j < 5) {
        $arreglo[$j] = $arreglo[$j] + 2;
        $suma += $arreglo[$j];
    } else {
        $arreglo[$j] = $arreglo[$j] * 2;
        $suma += $arreglo[$j];
    }

    echo  "El valor " . ($j + 1) . " es: " . $arreglo[$j] . "\n";
}
echo "La suma total:  " . $suma . "\n";
