<?php

/*Asi era con MSQLI

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'biblioteca';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
*/

//ASI ES CON PDO
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'biblioteca';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
