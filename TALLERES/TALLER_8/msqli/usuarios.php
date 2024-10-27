<?php
require_once "config.php";

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contraseña = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nombre, $email, $contraseña);
            if ($stmt->execute()) {

                $msj = "Usuario registrado correctamente.<br>";
                echo header('Location: index.php?msj=' . $msj);
            } else {

                $msj = "Error al registrar usuario.<br>";
                echo header('Location: index.php?msj=' . $msj);
            }
        }
        include "templates/form_usuarios.php";
        break;

    case 'edit':
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $sql = "UPDATE usuarios SET nombre=?, email=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nombre, $email, $id);
            if ($stmt->execute()) {

                $msj = "Usuario actualizado correctamente.<br>";
                echo header('Location: index.php?msj=' . $msj);
            } else {

                $msj = "Error al actualizar usuario.<br>";
                echo header('Location: index.php?msj=' . $msj);
            }
        } else {
            $sql = "SELECT * FROM usuarios WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();
            include "templates/form_usuarios.php";
        }
        break;

    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM usuarios WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {

            $msj = "Usuario eliminado correctamente.<br>";
            echo header('Location: index.php?msj=' . $msj);
        } else {

            $msj = "Error al eliminar usuario.<br>";
            echo header('Location: index.php?msj=' . $msj);
        }
        break;

    case 'list':
    default:
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        include "templates/lista_usuarios.php";
        break;
}

$conn->close();
