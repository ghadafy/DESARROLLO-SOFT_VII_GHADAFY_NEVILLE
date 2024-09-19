<?php
// 1. Crear un string JSON con datos de una tienda en línea
$jsonDatos = '
{
    "tienda": "ElectroTech",
    "productos": [
        {"id": 1, "nombre": "Laptop Gamer", "precio": 1200, "categorias": ["electrónica", "computadoras"]},
        {"id": 2, "nombre": "Smartphone 5G", "precio": 800, "categorias": ["electrónica", "celulares"]},
        {"id": 3, "nombre": "Auriculares Bluetooth", "precio": 150, "categorias": ["electrónica", "accesorios"]},
        {"id": 4, "nombre": "Smart TV 4K", "precio": 700, "categorias": ["electrónica", "televisores"]},
        {"id": 5, "nombre": "Tablet", "precio": 300, "categorias": ["electrónica", "computadoras"]}
    ],
    "clientes": [
        {"id": 101, "nombre": "Ana López", "email": "ana@example.com"},
        {"id": 102, "nombre": "Carlos Gómez", "email": "carlos@example.com"},
        {"id": 103, "nombre": "María Rodríguez", "email": "maria@example.com"}
    ]
}
';

// 2. Convertir el JSON a un arreglo asociativo de PHP
$tiendaData = json_decode($jsonDatos, true);

// 3. Función para imprimir los productos
function imprimirProductos($productos)
{
    foreach ($productos as $producto) {
        echo "{$producto['nombre']} - {$producto['precio']} - Categorías: " . implode(", ", $producto['categorias']) . "\n";
    }
}

echo "Productos de {$tiendaData['tienda']}:\n";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], function ($total, $producto) {
    return $total + $producto['precio'];
}, 0);

echo "\nValor total del inventario: $$valorTotal\n";

// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], function ($max, $producto) {
    return ($producto['precio'] > $max['precio']) ? $producto : $max;
}, $tiendaData['productos'][0]);

echo "\nProducto más caro: {$productoMasCaro['nombre']} ({$productoMasCaro['precio']})\n";

// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria)
{
    return array_filter($productos, function ($producto) use ($categoria) {
        return in_array($categoria, $producto['categorias']);
    });
}

$productosDeComputadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "\nProductos en la categoría 'computadoras':\n";
imprimirProductos($productosDeComputadoras);

// 7. Agregar un nuevo producto
$nuevoProducto = [
    "id" => 6,
    "nombre" => "Smartwatch",
    "precio" => 250,
    "categorias" => ["electrónica", "accesorios", "wearables"]
];
$tiendaData['productos'][] = $nuevoProducto;

// 8. Convertir el arreglo actualizado de vuelta a JSON
$jsonActualizado = json_encode($tiendaData, JSON_PRETTY_PRINT);
echo "\nDatos actualizados de la tienda (JSON):\n$jsonActualizado\n";

// TAREA: Implementa una función que genere un resumen de ventas
// Crea un arreglo de ventas (producto_id, cliente_id, cantidad, fecha)
// y genera un informe que muestre:
// - Total de ventas
// - Producto más vendido
// - Cliente que más ha comprado
// Tu código aquí

// 9. Crear un arreglo de ventas
$ventas = [
    ["producto_id" => 1, "cliente_id" => 101, "cantidad" => 2, "fecha" => "2024-09-15"],
    ["producto_id" => 2, "cliente_id" => 102, "cantidad" => 1, "fecha" => "2024-09-16"],
    ["producto_id" => 3, "cliente_id" => 103, "cantidad" => 3, "fecha" => "2024-09-17"],
    ["producto_id" => 1, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2024-09-18"],
    ["producto_id" => 5, "cliente_id" => 101, "cantidad" => 1, "fecha" => "2024-09-18"]
];

// 10. Función para generar el informe de ventas
function generarInformeVentas($ventas, $productos, $clientes)
{
    // Inicializar variables para el total de ventas, el producto más vendido y el cliente que más ha comprado
    $totalVentas = 0;
    $ventasPorProducto = [];
    $ventasPorCliente = [];

    // Procesar cada venta
    foreach ($ventas as $venta) {
        // Encontrar el precio del producto
        $productoId = $venta['producto_id'];
        $clienteId = $venta['cliente_id'];
        $cantidad = $venta['cantidad'];

        $producto = array_values(array_filter($productos, function ($p) use ($productoId) {
            return $p['id'] == $productoId;
        }))[0];

        $totalVentas += $producto['precio'] * $cantidad;

        // Contar ventas por producto
        if (!isset($ventasPorProducto[$productoId])) {
            $ventasPorProducto[$productoId] = 0;
        }
        $ventasPorProducto[$productoId] += $cantidad;

        // Contar ventas por cliente
        if (!isset($ventasPorCliente[$clienteId])) {
            $ventasPorCliente[$clienteId] = 0;
        }
        $ventasPorCliente[$clienteId] += $cantidad;
    }

    // Encontrar el producto más vendido
    $productoMasVendidoId = array_keys($ventasPorProducto, max($ventasPorProducto))[0];
    $productoMasVendido = array_values(array_filter($productos, function ($p) use ($productoMasVendidoId) {
        return $p['id'] == $productoMasVendidoId;
    }))[0];

    // Encontrar el cliente que más ha comprado
    $clienteQueMasHaCompradoId = array_keys($ventasPorCliente, max($ventasPorCliente))[0];
    $clienteQueMasHaComprado = array_values(array_filter($clientes, function ($c) use ($clienteQueMasHaCompradoId) {
        return $c['id'] == $clienteQueMasHaCompradoId;
    }))[0];

    // Mostrar el informe
    echo "\nResumen de ventas:\n";
    echo "Total de ventas: $$totalVentas\n";
    echo "Producto más vendido: {$productoMasVendido['nombre']} ({$ventasPorProducto[$productoMasVendidoId]} unidades)\n";
    echo "Cliente que más ha comprado: {$clienteQueMasHaComprado['nombre']} ({$ventasPorCliente[$clienteQueMasHaCompradoId]} productos)\n";
}

// 11. Llamar a la función para generar el informe
generarInformeVentas($ventas, $tiendaData['productos'], $tiendaData['clientes']);
