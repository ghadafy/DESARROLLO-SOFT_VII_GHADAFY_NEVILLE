<h1>Agregar o Editar Libro con PDO</h1>

<form action="libros.php?action=<?php echo isset($libro) ? 'edit&id=' . $libro['id'] : 'add'; ?>" method="POST">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" value="<?php echo $libro['titulo'] ?? ''; ?>" required><br>

    <label for="autor">Autor:</label>
    <input type="text" name="autor" value="<?php echo $libro['autor'] ?? ''; ?>" required><br>

    <label for="isbn">ISBN:</label>
    <input type="text" name="isbn" value="<?php echo $libro['isbn'] ?? ''; ?>" required><br>

    <label for="anio_publicacion">Año de Publicación:</label>
    <input type="number" name="anio_publicacion" value="<?php echo $libro['anio_publicacion'] ?? ''; ?>" required><br>

    <label for="cantidad">Cantidad Disponible:</label>
    <input type="number" name="cantidad" value="<?php echo $libro['cantidad'] ?? ''; ?>" required><br>

    <button type="submit"><?php echo isset($libro) ? 'Actualizar' : 'Agregar'; ?> Libro</button>
</form>

<a href="index.php">Regresar a la pagina principal</a>