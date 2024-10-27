<h2>Lista de Usuarios con MSQLI</h2>
<a href="usuarios.php?action=add">Registrar Usuario</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="usuarios.php?action=edit&id=<?php echo $row['id']; ?>">Editar</a> |
                <!--  <a href="usuarios.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a> -->
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<a href="index.php">Regresar a la pagina principal</a>