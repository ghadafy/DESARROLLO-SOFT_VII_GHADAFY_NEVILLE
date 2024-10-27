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
            $stmt->bind_param("iiss", $usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion);
            if ($stmt->execute()) {
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
            $stmt->bind_param("issi", $usuario_id, $libro_id, $fecha_devolucion, $id);
            if ($stmt->execute()) {
                $msj = "Préstamo actualizado correctamente.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            } else {
                $msj = "Error al actualizar préstamo.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            }
        } else {
            // Obtener datos del préstamo para mostrarlos en el formulario
            $sql = "SELECT * FROM prestamos WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $prestamo = $result->fetch_assoc();
            include "templates/form_prestamos.php"; // Aquí se debe modificar para mostrar el formulario de edición
        }
        break;



    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM prestamos WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
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
        $result = $conn->query($sql);
        include "templates/lista_prestamos.php";
        break;
}

$conn->close();
