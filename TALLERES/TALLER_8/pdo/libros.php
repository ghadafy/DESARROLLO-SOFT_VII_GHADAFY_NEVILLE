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
            if ($stmt->execute([$titulo, $autor, $isbn, $anio_publicacion, $cantidad])) {
                $msj = "Libro agregado correctamente.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            } else {
                $msj = "Error al agregar libro.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
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
            if ($stmt->execute([$titulo, $autor, $isbn, $anio_publicacion, $cantidad, $id])) {
                $msj = "Libro actualizado correctamente.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            } else {
                $msj = "Error al actualizar libro.<br>";
                header('Location: index.php?msj=' . urlencode($msj));
                exit;
            }
        } else {
            $sql = "SELECT * FROM libros WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $libro = $stmt->fetch(PDO::FETCH_ASSOC);
            include "templates/form_libro.php";
        }
        break;

    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM libros WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$id])) {
            $msj = "Libro eliminado correctamente.<br>";
            header('Location: index.php?msj=' . urlencode($msj));
            exit;
        } else {
            $msj = "Error al eliminar libro.<br>";
            header('Location: index.php?msj=' . urlencode($msj));
            exit;
        }
        break;

    case 'list':
    default:
        $sql = "SELECT * FROM libros";
        $stmt = $conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include "templates/lista_libros.php";
        break;
}
