<h2>Lista de Préstamos con PDO</h2>
<a href="prestamos.php?action=add">Registrar Préstamo</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Libro</th>
        <th>Fecha de Préstamo</th>
        <th>Fecha de Devolución</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['usuario_nombre']); ?></td>
            <td><?php echo htmlspecialchars($row['libro_titulo']); ?></td>
            <td><?php echo htmlspecialchars($row['fecha_prestamo']); ?></td>
            <td><?php echo htmlspecialchars($row['fecha_devolucion']); ?></td>
            <td>
                <a href="prestamos.php?action=edit&id=<?php echo $row['id']; ?>">Editar</a> |
                <!-- <a href="prestamos.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este préstamo?');">Eliminar</a>-->
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="index.php">Regresar a la página principal</a>