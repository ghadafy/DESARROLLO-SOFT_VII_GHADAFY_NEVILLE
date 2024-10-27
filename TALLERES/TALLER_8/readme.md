# Sistema de Gestión de Biblioteca

## Descripción
Este proyecto es un sistema de gestión de biblioteca que permite registrar, editar y eliminar préstamos de libros a usuarios. Utiliza PHP y PDO para interactuar con la base de datos MySQL.

La opcion de eliminar se oculto para evitar eliminar registros que estan registrados en los prestamos.

## Estructura del Proyecto

| sistema-biblioteca │ 
├── config.php                  # Configuración de la conexión a la base de datos 
├── prestamos.php               # Manejo de préstamos (CRUD) 
├── usuarios.php                # Manejo de usuarios (CRUD) 
├── libros.php                  # Manejo de libros (CRUD) 
├── templates                   # Carpeta con plantillas para formularios y listas │ 
    ├── form_prestamos.php │ 
    ├── form_usuarios.php │ 
    ├── form_libros.php │ 
    ├── lista_prestamos.php │ 
    ├── lista_usuarios.php │ 
    └── lista_libros.php 
├── index.php                   # Página principal

## Comparacion de msqli y pdo

#>>>>>>>>>>>>>>>>>>>       configuracion:

#msqli:

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


#pdo:

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

#>>>>>>>>>>>>>>>>>>>>>    insertar registro:

#msqli:

$sql = "INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion);
if ($stmt->execute()) {
    // éxito
} else {
    // error
}

#pdo:

$sql = "INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion]);
if ($stmt->rowCount()) {
    // éxito
} else {
    // error
}

#>>>>>>>>>>>>>>>>>>>>>>>>   actualizar registro

#msqli:

$sql = "UPDATE prestamos SET usuario_id=?, libro_id=?, fecha_devolucion=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issi", $usuario_id, $libro_id, $fecha_devolucion, $id);
if ($stmt->execute()) {
    // éxito
} else {
    // error
}


#pdo:

$sql = "UPDATE prestamos SET usuario_id=?, libro_id=?, fecha_devolucion=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$usuario_id, $libro_id, $fecha_devolucion, $id]);
if ($stmt->rowCount()) {
    // éxito
} else {
    // error
}



#>>>>>>>>>>>>>>>>>>>>>>>>   eliminar registro

#msqli:

$sql = "DELETE FROM prestamos WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    // éxito
} else {
    // error
}


#pdo:

$sql = "DELETE FROM prestamos WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
if ($stmt->rowCount()) {
    // éxito
} else {
    // error
}


#>>>>>>>>>>>>>>>>>>>>>>>>   consultar registro

#msqli:

$sql = "SELECT prestamos.*, usuarios.nombre AS usuario_nombre, libros.titulo AS libro_titulo FROM prestamos JOIN usuarios ON prestamos.usuario_id = usuarios.id JOIN libros ON prestamos.libro_id = libros.id";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    // procesar fila
}


#pdo:

$sql = "SELECT prestamos.*, usuarios.nombre AS usuario_nombre, libros.titulo AS libro_titulo FROM prestamos JOIN usuarios ON prestamos.usuario_id = usuarios.id JOIN libros ON prestamos.libro_id = libros.id";
$stmt = $conn->query($sql);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // procesar fila
}
