<?php
require_once "config.php";

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario_id = $_POST['usuario_id'];
            $libro_id = $_POST['libro_id'];
            $fecha_prestamo = date("Y-m-d");
            $fecha_devolucion = $_POST['fecha_devolucion'];

            $sql = "INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion])) {
                $msj = "Préstamo registrado correctamente.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            } else {
                $msj = "Error al registrar préstamo.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            }
        }
        include "templates/form_prestamos.php";
        break;

    case 'edit':
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario_id = $_POST['usuario_id'];
            $libro_id = $_POST['libro_id'];
            $fecha_devolucion = $_POST['fecha_devolucion'];

            $sql = "UPDATE prestamos SET usuario_id=?, libro_id=?, fecha_devolucion=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$usuario_id, $libro_id, $fecha_devolucion, $id])) {
                $msj = "Préstamo actualizado correctamente.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            } else {
                $msj = "Error al actualizar préstamo.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            }
        } else {

            $sql = "SELECT * FROM prestamos WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);
            include "templates/form_prestamos.php";
        }
        break;

    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM prestamos WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$id])) {
            $msj = "Préstamo eliminado correctamente.<br>";
            header('Location: index.php?msj=' . urlencode($msj));
            exit;
        } else {
            $msj = "Error al eliminar préstamo.<br>";
            header('Location: index.php?msj=' . urlencode($msj));
            exit;
        }
        break;

    case 'list':
    default:
        $sql = "SELECT prestamos.*, usuarios.nombre AS usuario_nombre, libros.titulo AS libro_titulo 
                FROM prestamos 
                JOIN usuarios ON prestamos.usuario_id = usuarios.id 
                JOIN libros ON prestamos.libro_id = libros.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include "templates/lista_prestamos.php";
        break;
}
