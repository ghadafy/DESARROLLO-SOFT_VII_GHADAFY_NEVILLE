<?php

require_once "config_pdo.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";

    if ($stmt = $pdo->prepare($sql)) {
        if ($stmt->execute([$nombre, $email, $id])) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "ERROR: No se pudo actualizar. " . $stmt->errorInfo()[2];
        }
    }
}


$sql = "SELECT id, nombre, email FROM usuarios";

if ($stmt = $pdo->prepare($sql)) {
    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Acciones</th></tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>
                        <form method='post' action=''>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='text' name='nombre' value='" . $row['nombre'] . "' required>
                            <input type='email' name='email' value='" . $row['email'] . "' required>
                            <input type='submit' name='update' value='Actualizar'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}
