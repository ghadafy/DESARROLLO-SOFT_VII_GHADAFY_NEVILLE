<?php

require_once "config_mysqli.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "ERROR: No se pudo ejecutar la actualización. " . mysqli_error($conn);
        }
    }

    mysqli_stmt_close($stmt);
}


$sql = "SELECT id, nombre, email FROM usuarios";
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Acciones</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
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
