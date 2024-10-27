<h2>Lista de Préstamos con MSQLI</h2>
<a href="prestamos.php?action=add">Registrar Préstamo</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Libro</th>
        <th>Fecha de Préstamo</th>
        <th>Fecha de Devolución </th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['usuario_nombre']; ?></td>
            <td><?php echo $row['libro_titulo']; ?></td>
            <td><?php echo $row['fecha_prestamo']; ?></td>
            <td><?php echo $row['fecha_devolucion']; ?></td>
            <td>
                <a href="prestamos.php?action=edit&id=<?php echo $row['id']; ?>">Editar</a> |
                <!-- <a href="prestamos.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este préstamo?');">Eliminar</a>-->
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<a href="index.php">Regresar a la página principal</a>