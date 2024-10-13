<?php
include 'config_sesion.php';

$productos = [
    1 => ["nombre" => "Producto A", "precio" => 10.00],
    2 => ["nombre" => "Producto B", "precio" => 15.00],
    3 => ["nombre" => "Producto C", "precio" => 20.00],
    4 => ["nombre" => "Producto D", "precio" => 25.00],
    5 => ["nombre" => "Producto E", "precio" => 30.00],
];

$total = 0;
?>

<h1>Carrito de compras</h1>
<ul>
    <?php if (!empty($_SESSION['carrito'])) : ?>
        <?php foreach ($_SESSION['carrito'] as $id => $cantidad) : ?>
            <li>
                <?php echo htmlspecialchars($productos[$id]['nombre']); ?> -
                Cantidad: <?php echo $cantidad; ?> -
                Subtotal: B/. <?php echo number_format($productos[$id]['precio'] * $cantidad, 2); ?>
                <a href="eliminar_carrito.php?id=<?php echo $id; ?>">Eliminar</a>
            </li>
            <?php $total += $productos[$id]['precio'] * $cantidad; ?>
            <?php $_SESSION['total'] = $total; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <li>El carrito está vacío.</li>
    <?php endif; ?>
</ul>

<h2>Total: B/. <?php echo number_format($total, 2); ?></h2>
<a href="productos.php">Seguir comprando</a><br>
<a href="checkout.php">Finalizar compra</a><br>