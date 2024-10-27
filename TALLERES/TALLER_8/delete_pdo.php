<?php

require_once "config_pdo.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM usuarios WHERE id = ?";

    if ($stmt = $pdo->prepare($sql)) {
        if ($stmt->execute([$id])) {
            echo "Usuario eliminado con éxito.";
        } else {
            echo "ERROR: No se pudo eliminar. " . $stmt->errorInfo()[2];
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
                            <input type='submit' name='delete' value='Eliminar'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}
