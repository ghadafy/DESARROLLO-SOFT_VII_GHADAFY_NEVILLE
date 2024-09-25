<?php
$ventas = [
    "Norte" => [
        "Producto A" => [100, 120, 140, 110, 130],
        "Producto B" => [85, 95, 105, 90, 100],
        "Producto C" => [60, 55, 65, 70, 75]
    ],
    "Sur" => [
        "Producto A" => [80, 90, 100, 85, 95],
        "Producto B" => [120, 110, 115, 125, 130],
        "Producto C" => [70, 75, 80, 65, 60]
    ],
    "Este" => [
        "Producto A" => [110, 115, 120, 105, 125],
        "Producto B" => [95, 100, 90, 105, 110],
        "Producto C" => [50, 60, 55, 65, 70]
    ],
    "Oeste" => [
        "Producto A" => [90, 85, 95, 100, 105],
        "Producto B" => [105, 110, 100, 115, 120],
        "Producto C" => [80, 85, 75, 70, 90]
    ]
];

$venta_mayor = 0;
$prod = "";
$reg = "";
$resultados = array();
foreach ($ventas as $region => $productos) {
    echo $region . '<br>';
    foreach ($productos as $producto => $venta) {
        $venta_producto = array_sum($venta);
        echo $producto . " -> " . $venta_producto . '<br>';
        if ($venta_producto >= $venta_mayor) {
            $venta_mayor = $venta_producto;
            $prod = $producto;
            $reg = $region;
            array_push($resultados, [$reg => [$prod => $venta_mayor]]);
        }
    }
}
echo "<br>La venta mayor fue de " . $venta_mayor . " y corresponde a " . $prod . ' en la region ' . $reg . '<br>';
print_r($resultados);
