<?php
require_once "config.php";

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contraseña = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contrasena', $contraseña);
            if ($stmt->execute()) {
                $msj = "Usuario registrado correctamente.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            } else {
                $msj = "Error al registrar usuario.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            }
        }
        include "templates/form_usuarios.php";
        break;

    case 'edit':
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $sql = "UPDATE usuarios SET nombre=:nombre, email=:email WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $msj = "Usuario actualizado correctamente.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            } else {
                $msj = "Error al actualizar usuario.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            }
        } else {
            $sql = "SELECT * FROM usuarios WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            include "templates/form_usuarios.php";
        }
        break;

    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM usuarios WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $msj = "Usuario eliminado correctamente.<br>";
            header('Location: index.php?msj=' . urlencode($msj));
            exit;
        } else {
            $msj = "Error al eliminar usuario.<br>";
            header('Location: index.php?msj=' . urlencode($msj));
            exit;
        }
        break;

    case 'list':
    default:
        $sql = "SELECT * FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include "templates/lista_usuarios.php";
        break;
}

$conn = null;
