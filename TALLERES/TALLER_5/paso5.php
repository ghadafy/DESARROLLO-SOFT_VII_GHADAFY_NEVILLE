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
        echo "{$producto['nombre']} - {$producto['precio']} - Categorías: " . implode(", ", $producto['categorias']) . "<br>";
    }
}

echo "Productos de {$tiendaData['tienda']}:<br>";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], function ($total, $producto) {
    return $total + $producto['precio'];
}, 0);

echo "<br>Valor total del inventario: $$valorTotal<br>";

// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], function ($max, $producto) {
    return ($producto['precio'] > $max['precio']) ? $producto : $max;
}, $tiendaData['productos'][0]);

echo "<br>Producto más caro: {$productoMasCaro['nombre']} ({$productoMasCaro['precio']})<br>";

// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria)
{
    return array_filter($productos, function ($producto) use ($categoria) {
        return in_array($categoria, $producto['categorias']);
    });
}

$productosDeComputadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "<br>Productos en la categoría 'computadoras':<br>";
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
echo "<br>Datos actualizados de la tienda (JSON):<br>$jsonActualizado<br><br>";

// TAREA: Implementa una función que genere un resumen de ventas
// Crea un arreglo de ventas (producto_id, cliente_id, cantidad, fecha)
// y genera un informe que muestre:
// - Total de ventas
// - Producto más vendido
// - Cliente que más ha comprado
// Tu código aquí

//Arreglo de ventas
$ventas = [
    ["producto_id" => 1, "cliente_id" => 101, "cantidad" => 2, "fecha" => "2024-09-15"],
    ["producto_id" => 2, "cliente_id" => 102, "cantidad" => 1, "fecha" => "2024-09-16"],
    ["producto_id" => 3, "cliente_id" => 103, "cantidad" => 3, "fecha" => "2024-09-17"],
    ["producto_id" => 1, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2024-09-18"],
    ["producto_id" => 5, "cliente_id" => 101, "cantidad" => 1, "fecha" => "2024-09-18"]
];

// Función para generar el informe de ventas
function generarInformeVentas($ventas, $productos, $clientes)
{
    // Inicializar variables para el total de ventas, el producto más vendido y el cliente que más ha comprado
    $total_ventas = 0;
    $ventas_por_producto = [];
    $ventas_por_cliente = [];

    // Procesar cada venta
    foreach ($ventas as $venta) {
        // Encontrar el precio del producto
        $productoId = $venta['producto_id'];
        $clienteId = $venta['cliente_id'];
        $cantidad = $venta['cantidad'];

        $producto = array_values(array_filter($productos, function ($p) use ($productoId) {
            return $p['id'] == $productoId;
        }))[0];

        $total_ventas += $producto['precio'] * $cantidad;

        // Contar ventas por producto
        if (!isset($ventas_por_producto[$productoId])) {
            $ventas_por_producto[$productoId] = 0;
        }
        $ventas_por_producto[$productoId] += $cantidad;

        // Contar ventas por cliente
        if (!isset($ventas_por_cliente[$clienteId])) {
            $ventas_por_cliente[$clienteId] = 0;
        }
        $ventas_por_cliente[$clienteId] += $cantidad;
    }

    // Encontrar el producto más vendido
    $producto_mas_vendido_id = array_keys($ventas_por_producto, max($ventas_por_producto))[0];
    $producto_mas_vendido = array_values(array_filter($productos, function ($p) use ($producto_mas_vendido_id) {
        return $p['id'] == $producto_mas_vendido_id;
    }))[0];

    // Encontrar el cliente que más ha comprado
    $cliente_que_mas_compro_id = array_keys($ventas_por_cliente, max($ventas_por_cliente))[0];
    $cliente_que_mas_compro = array_values(array_filter($clientes, function ($c) use ($cliente_que_mas_compro_id) {
        return $c['id'] == $cliente_que_mas_compro_id;
    }))[0];

    // Mostrar el informe
    echo "<br>Informe de ventas:<br>";
    echo "Total de ventas: $total_ventas<br>";
    echo "Producto más vendido: {$producto_mas_vendido['nombre']} ({$ventas_por_producto[$producto_mas_vendido_id]} unidades)<br>";
    echo "Cliente que más ha comprado: {$cliente_que_mas_compro['nombre']} ({$ventas_por_cliente[$cliente_que_mas_compro_id]} productos)<br>";
}

// Llamar a la función para generar el informe
generarInformeVentas($ventas, $tiendaData['productos'], $tiendaData['clientes']);
