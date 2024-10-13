<?php
include 'config_sesion.php';


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id !== false && $id > 0) {  // Validamos que el ID
    // Inicializamos el carrito 
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Añadimos producto al carrito
    if (!isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = 1;  // Añadimos la cantidad 1
    } else {
        $_SESSION['carrito'][$id]++;  // o la incrementamos
    }

    // Volvemos al carrito
    header("Location: ver_carrito.php");
    exit();
} else {
    echo "ID de producto no válido";
}
