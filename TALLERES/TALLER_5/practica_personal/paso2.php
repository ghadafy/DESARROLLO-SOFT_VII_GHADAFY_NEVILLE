<?php
$inventario = [
    "laptop" => ["cantidad" => 50, "precio" => 800],
    "smartphone" => ["cantidad" => 100, "precio" => 500],
    "tablet" => ["cantidad" => 30, "precio" => 300],
    "smartwatch" => ["cantidad" => 25, "precio" => 150],
    "monitor" => ["cantidad" => 40, "precio" => 200],
    "teclado" => ["cantidad" => 60, "precio" => 40],
    "ratón" => ["cantidad" => 75, "precio" => 20],
    "impresora" => ["cantidad" => 20, "precio" => 250],
    "auriculares" => ["cantidad" => 90, "precio" => 70],
    "cámara" => ["cantidad" => 15, "precio" => 350],
    "micrófono" => ["cantidad" => 35, "precio" => 80],
    "altavoces" => ["cantidad" => 50, "precio" => 60],
    "disco duro" => ["cantidad" => 45, "precio" => 100],
    "SSD" => ["cantidad" => 55, "precio" => 120],
    "memoria USB" => ["cantidad" => 200, "precio" => 15],
    "router" => ["cantidad" => 30, "precio" => 90],
    "proyector" => ["cantidad" => 10, "precio" => 400],
    "cargador" => ["cantidad" => 80, "precio" => 30],
    "funda para laptop" => ["cantidad" => 70, "precio" => 25],
    "base de enfriamiento" => ["cantidad" => 50, "precio" => 35]
];

function mostrarInventario($arreglo)
{
    echo strtoupper("<strong>Inventario Inicial</strong><br>");
    foreach ($arreglo as $producto => $valor) {
        echo "Producto: " . $producto . " > Cantidad: " . $valor['cantidad'] . " a un precio de B/. " . $valor['precio'] . "<br>";
    }
}
mostrarInventario($inventario);
