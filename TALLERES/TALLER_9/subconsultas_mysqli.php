<?php
echo "CONSULTA CON MYSQLI<br>";

require_once "config_mysqli.php";

// 1. Productos que tienen un precio mayor al promedio de su categoría


$sql = "SELECT p.nombre, p.precio, c.nombre AS categoria, AVG(p2.precio) AS promedio_categoria
        FROM productos p
        JOIN categorias c ON p.categoria_id = c.id
        JOIN productos p2 ON p.categoria_id = p2.categoria_id
        GROUP BY p.id
        HAVING p.precio > AVG(p2.precio)";


$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Producto: {$row['nombre']}, Precio: {$row['precio']}, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: {$row['promedio_categoria']}<br>";
    }
    mysqli_free_result($result);
}



$sql = "SELECT c.nombre, c.email,
        SUM(v.total) AS total_compras,
        (SELECT AVG(total) FROM ventas) AS promedio_ventas
        FROM clientes c
        JOIN ventas v ON c.id = v.cliente_id
        GROUP BY c.id
        HAVING SUM(v.total) > (SELECT AVG(total) FROM ventas)";


$result = mysqli_query($conn, $sql);


if ($result) {
    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Cliente: {$row['nombre']}, Total compras: {$row['total_compras']}, ";
        echo "Promedio general: {$row['promedio_ventas']}<br>";
    }
    mysqli_free_result($result);
}


// 1. Encontrar los productos que nunca se han vendido

//Esta consulta no es optima



$sql = "SELECT p.nombre, p.precio
        FROM productos p
        LEFT JOIN detalles_venta dv ON p.id = dv.producto_id
        WHERE dv.producto_id IS NULL";


$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos no vendidos:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Producto: {$row['nombre']}, Precio: {$row['precio']}<br> ";
    }
    mysqli_free_result($result);
}


// 2. Listar las categorías con el número de productos y el valor total del inventario.

//Esta cosnulta no es optima



$sql = "SELECT c.nombre, COUNT(p.id) AS cantidad, SUM(p.precio * p.stock) AS valor
        FROM categorias c
        LEFT JOIN productos p ON p.categoria_id = c.id
        GROUP BY c.id";


$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Categorias con total de productos y valor total en inventario:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Categorias: {$row['nombre']}, Cantidad de Productos: {$row['cantidad']}, Valor Inventario: {$row['valor']}<br> ";
    }
    mysqli_free_result($result);
}


// 3. Encontrar los clientes que han comprado todos los productos de una categoría específica.



$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Clientes que han comprado todos los productos de una categoría específica:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Cliente: {$row['nombre']}, Cantidad de Productos: {$row['cantidad']}, Valor: {$row['valor']}<br> ";
    }
    mysqli_free_result($result);
}


// 4. Calcular el porcentaje de ventas de cada producto respecto al total de ventas.



$sql = "SELECT p.nombre AS nom, 
               SUM(dv.subtotal) AS subtotal_venta, 
               (SELECT SUM(subtotal) FROM detalles_venta) AS total_ventas
        FROM detalles_venta dv 
        JOIN productos p ON dv.producto_id = p.id
        GROUP BY p.id";




$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Calcular el porcentaje de ventas de cada producto respecto al total de ventas:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        $porcentaje = number_format(($row['subtotal_venta'] / $row['total_ventas']) * 100, 2); // Calcula el porcentaje
        echo "Producto: {$row['nom']}, Ventas de este producto: {$row['subtotal_venta']}, Porcentaje de ventas: {$porcentaje}%<br>";
    }
    mysqli_free_result($result);
}


mysqli_close($conn);
