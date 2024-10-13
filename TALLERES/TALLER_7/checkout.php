<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vaciar el carrito
    unset($_SESSION['carrito']);

    // Recordar el nombre del usuario por 24 horas
    $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']);
    setcookie('nombre_usuario', $nombre_usuario, time() + 86400, "/", "", true, true);

    echo "<br>Gracias por tu visita " . $nombre_usuario . '<br>';
    echo "<br><a href='productos.php'>Volver a la tienda</a><br><br>";
    echo "<a href='logout.php'>Cerrar Sesión</a>";
} else {
?>
    <h1>Finalizar compra</h1>
    <form method="POST" action="checkout.php">
        <label for="nombre_usuario">Nombre:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required>
        <button type="submit">Finalizar</button>
    </form>
<?php
}




?>