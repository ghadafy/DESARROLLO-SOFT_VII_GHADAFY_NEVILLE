<h1><?php echo isset($prestamo) ? 'Editar Préstamo con MSQLI' : 'Agregar Préstamo con MSQLI'; ?></h1>
<form action="prestamos.php?action=<?php echo isset($prestamo) ? 'edit&id=' . $prestamo['id'] : 'add'; ?>" method="POST">
    <label for="usuario_id">Usuario:</label>
    <select name="usuario_id" required>
        <option value="">Seleccione un usuario</option> <!-- Opción vacía inicial -->
        <?php
        // Conectar a la base de datos y obtener usuarios
        require_once "config.php";
        $sql = "SELECT id, nombre FROM usuarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Verificar si el usuario actual es el que se está editando
                $selected = (isset($prestamo) && $prestamo['usuario_id'] == $row['id']) ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['nombre']}</option>";
            }
        } else {
            echo "<option value=''>No hay usuarios registrados</option>";
        }
        ?>
    </select><br>

    <label for="libro_id">Libro:</label>
    <select name="libro_id" required>
        <option value="">Seleccione un libro</option> <!-- Opción vacía inicial -->
        <?php
        // Obtener libros
        $sql = "SELECT id, titulo FROM libros";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Verificar si el libro actual es el que se está editando
                $selected = (isset($prestamo) && $prestamo['libro_id'] == $row['id']) ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['titulo']}</option>";
            }
        } else {
            echo "<option value=''>No hay libros registrados</option>";
        }
        ?>
    </select><br>

    <label for="fecha_devolucion">Fecha de Devolución:</label>
    <input type="date" name="fecha_devolucion" value="<?php echo isset($prestamo) ? $prestamo['fecha_devolucion'] : ''; ?>" required><br>

    <button type="submit"><?php echo isset($prestamo) ? 'Actualizar Préstamo' : 'Registrar Préstamo'; ?></button>
</form>

<a href="index.php">Regresar a la página principal</a>