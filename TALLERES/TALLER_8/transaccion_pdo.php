<?php
require_once "config_pdo.php";

try {
    $pdo->beginTransaction();

    // Insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nombre' => 'Nuevo Usuario pdo', ':email' => 'nuevo@example.com']);

    //Aqui inserto el codigo de los errores
    if ($stmt->errorCode() !== '00000') {
        throw new Exception("<br>Error en la consulta: " . $stmt->errorInfo()[2]);
    }


    $usuario_id = $pdo->lastInsertId();

    // Insertar una publicación para ese usuario
    $sql = "INSERT INTO publicaciones (usuario_id, titulo, contenido) VALUES (:usuario_id, :titulo, :contenido)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':usuario_id' => $usuario_id,
        ':titulo' => 'Nueva Publicación pdo',
        ':contenido' => 'Contenido de la nueva publicación pdo'
    ]);


    //Aqui inserto el codigo de los errores
    if ($stmt->errorCode() !== '00000') {
        throw new Exception("<br>Error en la consulta: " . $stmt->errorInfo()[2]);
    }




    $pdo->commit();
    echo "Transacción completada con éxito.";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Error en la transacción: " . $e->getMessage();
}
