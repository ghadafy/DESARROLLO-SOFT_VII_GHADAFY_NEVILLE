<h2>Lista de Libros con MSQLI</h2>
<a href="libros.php?action=add">Agregar Libro</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>ISBN</th>
        <th>Año de Publicación</th>
        <th>Cantidad</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['titulo']; ?></td>
            <td><?php echo $row['autor']; ?></td>
            <td><?php echo $row['isbn']; ?></td>
            <td><?php echo $row['anio_publicacion']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td>
                <a href="libros.php?action=edit&id=<?php echo $row['id']; ?>">Editar</a> |
                <!--   <a href="libros.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este libro?');">Eliminar</a> -->
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<a href="index.php">Regresar a la pagina principal</a>