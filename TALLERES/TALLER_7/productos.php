<?php

$productos = [
    1 => ["nombre" => "Producto A", "precio" => 10.00],
    2 => ["nombre" => "Producto B", "precio" => 15.00],
    3 => ["nombre" => "Producto C", "precio" => 20.00],
    4 => ["nombre" => "Producto D", "precio" => 25.00],
    5 => ["nombre" => "Producto E", "precio" => 30.00],
];
?>

<h1>Lista de productos</h1>
<ul>
    <?php foreach ($productos as $id => $producto) : ?>
        <li>
            <?php echo htmlspecialchars($producto['nombre']); ?> - B/. <?php echo number_format($producto['precio'], 2); ?>
            <a href="agregar_al_carrito.php?id=<?php echo $id; ?>">Añadir al carrito</a>
        </li>
    <?php endforeach; ?>
</ul>

<a href="ver_carrito.php">Ver carrito</a>