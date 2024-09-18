<?php
// 1. Crear un arreglo asociativo de productos con su inventario
$inventario = [
    "laptop" => ["cantidad" => 50, "precio" => 800],
    "smartphone" => ["cantidad" => 100, "precio" => 500],
    "tablet" => ["cantidad" => 30, "precio" => 300],
    "smartwatch" => ["cantidad" => 25, "precio" => 150]
];

// 2. Función para mostrar el inventario
function mostrarInventario($inv)
{
    foreach ($inv as $producto => $info) {
        echo "$producto: {$info['cantidad']} unidades, Precio: {$info['precio']}<br>";
    }
}
echo '<br><br>';
// 3. Mostrar inventario inicial
echo "Inventario inicial:\n";
echo '<br><br>';
mostrarInventario($inventario);

// 4. Función para actualizar el inventario
function actualizarInventario(&$inv, $producto, $cantidad, $precio = null)
{
    if (!isset($inv[$producto])) {
        $inv[$producto] = ["cantidad" => $cantidad, "precio" => $precio];
    } else {
        $inv[$producto]["cantidad"] += $cantidad;
        if ($precio !== null) {
            $inv[$producto]["precio"] = $precio;
        }
    }
}

// 5. Actualizar inventario
actualizarInventario($inventario, "laptop", -5);  // Venta de 5 laptops
actualizarInventario($inventario, "smartphone", 50, 450);  // Nuevo lote de smartphones con precio actualizado
actualizarInventario($inventario, "auriculares", 100, 50);  // Nuevo producto


echo '<br><br>';
// 6. Mostrar inventario actualizado
echo "\nInventario actualizado:\n";
echo '<br><br>';
mostrarInventario($inventario);
echo '<br><br>';
// 7. Función para calcular el valor total del inventario
function valorTotalInventario($inv)
{
    $total = 0;
    foreach ($inv as $producto => $info) {
        $total += $info['cantidad'] * $info['precio'];
    }
    return $total;
}

// 8. Mostrar valor total del inventario
echo "\nValor total del inventario: $" . valorTotalInventario($inventario) . "\n";
echo '<br><br>';
// TAREA: Crea una función que encuentre y retorne el producto con el mayor valor total en inventario
// (cantidad * precio). Muestra el resultado.
// Tu código aquí

function mayorValor($inv)
{
    $mayor = 0;
    $producto = [];
    foreach ($inv as $prod => $datos) {
        $valor = $datos['cantidad'] * $datos['precio'];
        if ($valor >= $mayor) {
            $mayor = $valor;
            $producto['producto'] = $prod;
            $producto['cantidad'] = $datos['cantidad'];
            $producto['precio'] = $datos['precio'];
        }
    }
    return "El producto con mayor valor es: " . $producto['producto'] . ", con una cantidad de " . $producto['cantidad'] . " a una precio de " . $producto['precio'] . ", que arroja un valor de " . number_format($mayor, 2);
}

echo mayorValor($inventario);
