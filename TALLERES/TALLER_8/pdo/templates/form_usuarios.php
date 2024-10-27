<h1>Agregar o Editar usuario con PDO</h1>

<form action="usuarios.php?action=<?php echo isset($usuario) ? 'edit&id=' . $usuario['id'] : 'add'; ?>" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $usuario['nombre'] ?? ''; ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $usuario['email'] ?? ''; ?>" required><br>

    <?php if (!isset($usuario)) : ?>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required><br>
    <?php endif; ?>

    <button type="submit"><?php echo isset($usuario) ? 'Actualizar' : 'Registrar'; ?> Usuario</button>
</form>

<a href="index.php">Regresar a la pagina principal</a>