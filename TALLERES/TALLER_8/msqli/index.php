<?php
$msj = "";
if (isset($_GET['msj'])) {
    $msj = urldecode($_GET['msj']);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestión de Biblioteca</title>
</head>

<body>
    <h1>Gestión de Biblioteca con MSQLI</h1>
    <h3><?php echo $msj; ?></h3>
    <ul>
        <li><a href="libros.php">Gestión de Libros</a></li>
        <li><a href="usuarios.php">Gestión de Usuarios</a></li>
        <li><a href="prestamos.php">Gestión de Préstamos</a></li>
    </ul>
</body>

</html>