<h2>Lista de Libros con PDO</h2>
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
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
            <td><?php echo htmlspecialchars($row['autor']); ?></td>
            <td><?php echo htmlspecialchars($row['isbn']); ?></td>
            <td><?php echo htmlspecialchars($row['anio_publicacion']); ?></td>
            <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
            <td>
                <a href="libros.php?action=edit&id=<?php echo $row['id']; ?>">Editar</a> |
                <!--  <a href="libros.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este libro?');">Eliminar</a> -->
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="index.php">Regresar a la página principal</a>