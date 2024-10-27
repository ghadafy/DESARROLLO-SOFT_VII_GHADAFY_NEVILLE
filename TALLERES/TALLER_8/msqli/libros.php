<?php
require_once "config.php";

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $isbn = $_POST['isbn'];
            $anio_publicacion = $_POST['anio_publicacion'];
            $cantidad = $_POST['cantidad'];

            $sql = "INSERT INTO libros (titulo, autor, isbn, anio_publicacion, cantidad) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssii", $titulo, $autor, $isbn, $anio_publicacion, $cantidad);
            if ($stmt->execute()) {

                $msj = "Libro agregado correctamente.<br>";
                echo header('Location: index.php?msj=' . urlencode($msj));
            } else {

                $msj = "Error al agregar libro.<br>";
                echo header('Location: index.php?msj=' . urlencode($msj));
            }
        }
        include "templates/form_libro.php";
        break;

    case 'edit':
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $isbn = $_POST['isbn'];
            $anio_publicacion = $_POST['anio_publicacion'];
            $cantidad = $_POST['cantidad'];

            $sql = "UPDATE libros SET titulo=?, autor=?, isbn=?, anio_publicacion=?, cantidad=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssiii", $titulo, $autor, $isbn, $anio_publicacion, $cantidad, $id);
            if ($stmt->execute()) {
                $msj = "Libro actualizado correctamente.<br>";
                echo header('Location: index.php?msj=' . urlencode($msj));
            } else {
                $msj = "Error al actualizar libro.<br>";
                echo header('Location: index.php?msj=' . urlencode($msj));
            }
        } else {
            $sql = "SELECT * FROM libros WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $libro = $result->fetch_assoc();
            include "templates/form_libro.php";
        }
        break;

    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM libros WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {

            $msj = "Libro eliminado correctamente.<br>";
            echo header('Location: index.php?msj=' . urlencode($msj));
        } else {

            $msj = "Error al eliminar libro.<br>";
            echo header('Location: index.php?msj=' . urlencode($msj));
        }
        break;

    case 'list':
    default:
        $sql = "SELECT * FROM libros";
        $result = $conn->query($sql);
        include "templates/lista_libros.php";
        break;
}

$conn->close();
