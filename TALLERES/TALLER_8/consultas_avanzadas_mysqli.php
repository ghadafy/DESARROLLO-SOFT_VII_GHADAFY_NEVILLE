<?php
require_once "config_mysqli.php";



// 1. Mostrar todos los usuarios junto con el número de publicaciones que han hecho
$sql = "SELECT u.id, u.nombre, COUNT(p.id) as num_publicaciones 
        FROM usuarios u 
        LEFT JOIN publicaciones p ON u.id = p.usuario_id 
        GROUP BY u.id";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Usuarios y número de publicaciones:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Usuario: " . $row['nombre'] . ", Publicaciones: " . $row['num_publicaciones'] . "<br>";
    }
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

// 2. Listar todas las publicaciones con el nombre del autor
$sql = "SELECT p.titulo, u.nombre as autor, p.fecha_publicacion 
        FROM publicaciones p 
        INNER JOIN usuarios u ON p.usuario_id = u.id 
        ORDER BY p.fecha_publicacion DESC";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Publicaciones con nombre del autor:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Título: " . $row['titulo'] . ", Autor: " . $row['autor'] . ", Fecha: " . $row['fecha_publicacion'] . "<br>";
    }
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}



// 3. Encontrar el usuario con más publicaciones
$sql = "SELECT u.nombre, COUNT(p.id) as num_publicaciones 
        FROM usuarios u 
        LEFT JOIN publicaciones p ON u.id = p.usuario_id 
        GROUP BY u.id 
        ORDER BY num_publicaciones DESC 
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo "<h3>Usuario con más publicaciones:</h3>";
    echo "Nombre: " . $row['nombre'] . ", Número de publicaciones: " . $row['num_publicaciones'];
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

echo '<hr>';



// 4. Encontrar el usuario con más publicaciones
$sql = "SELECT p.titulo, u.nombre as autor, p.fecha_publicacion 
    FROM publicaciones p 
    INNER JOIN usuarios u ON p.usuario_id = u.id 
    ORDER BY p.fecha_publicacion DESC
    LIMIT 5";


$result = mysqli_query($conn, $sql);

if ($result) {
    $contador = 1;
    echo "<h3>Publicaciones con nombre del autor:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo $contador . " - Título: " . $row['titulo'] . ", Autor: " . $row['autor'] . ", Fecha: " . $row['fecha_publicacion'] . "<br>";
        $contador++;
    }
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}




// 5. Listar usuarios que no han realizado ningun publicacion
$sql = "SELECT p.titulo, u.nombre as autor, p.fecha_publicacion 
        FROM publicaciones p 
        INNER JOIN usuarios u ON p.usuario_id = u.id 
        WHERE u.id  NOT IN(SELECT usuario_id FROM publicaciones)";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Autores con ningun publicacion</h3>";
    if (mysqli_num_rows($result) > 0) {
        echo "<h3>Usuario con ninguna publicacion:</h3>";
        while ($row = mysqli_fetch_assoc($result)) {

            echo "Nombre: " . $row['autor'] . '<br>';
        }
        mysqli_free_result($result);
    } else {
        echo "No hay Autores sin publicación";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}


// 6. Calcular el promedio de publicaciones por usuario.
/*
        SELECT u.id, u.nombre, COUNT(p.id) as num_publicaciones, 
        (SELECT COUNT(p2.id)  FROM publicaciones p2) as TOTAL
        FROM usuarios u LEFT JOIN publicaciones p ON u.id = p.usuario_id 
        GROUP BY u.id
*/

/*
SELECT u.id, u.nombre, COUNT(p.id) AS num_publicaciones, 
        (SELECT COUNT(p2.id) FROM publicaciones p2 WHERE p2.usuario_id = u.id) AS total_publicaciones
        FROM usuarios u
        LEFT JOIN publicaciones p ON u.id = p.usuario_id
        GROUP BY u.id
*/


$sql = "SELECT AVG(num_publicaciones) AS promedio
FROM (
    SELECT COUNT(p.id) AS num_publicaciones
    FROM usuarios u
    LEFT JOIN publicaciones p ON u.id = p.usuario_id
    GROUP BY u.id
) AS subquery";

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo "<h3>Promedio de publicaciones por usuario:</h3>";
    echo "Promedio: " . $row['promedio'];
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}


// 7. Encontrar la publicación más reciente de cada usuario
$sql = "SELECT u.nombre, MAX(p.fecha_publicacion) AS ultima_publicacion
FROM usuarios u
INNER JOIN publicaciones p ON u.id = p.usuario_id
GROUP BY u.nombre";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Última publicación de cada usuario:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Usuario: " . $row['nombre'] . ", Fecha: " . $row['ultima_publicacion'] . "<br>";
    }
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}



mysqli_close($conn);
