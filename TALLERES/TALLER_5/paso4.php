<?php
// Paso 4: Ordenamiento y Filtrado Avanzado de Arreglos

// 1. Definir el arreglo de libros
$biblioteca = [
    [
        "titulo" => "Cien años de soledad",
        "autor" => "Gabriel García Márquez",
        "año" => 1967,
        "genero" => "Realismo mágico",
        "prestado" => true
    ],
    [
        "titulo" => "1984",
        "autor" => "George Orwell",
        "año" => 1949,
        "genero" => "Ciencia ficción",
        "prestado" => false
    ],
    [
        "titulo" => "El principito",
        "autor" => "Antoine de Saint-Exupéry",
        "año" => 1943,
        "genero" => "Literatura infantil",
        "prestado" => true
    ],
    [
        "titulo" => "Don Quijote de la Mancha",
        "autor" => "Miguel de Cervantes",
        "año" => 1605,
        "genero" => "Novela",
        "prestado" => false
    ],
    [
        "titulo" => "Orgullo y prejuicio",
        "autor" => "Jane Austen",
        "año" => 1813,
        "genero" => "Novela romántica",
        "prestado" => true
    ]
];

// 2. Función para imprimir la biblioteca
function imprimirBiblioteca($libros)
{
    if (count($libros) == 0) {
        echo "No se encontro el libro buscado...";
    } else {
        foreach ($libros as $libro) {
            echo "{$libro['titulo']} - {$libro['autor']} ({$libro['año']}) - {$libro['genero']} - " .
                ($libro['prestado'] ? "Prestado" : "Disponible") . "<br><br>";
        }
    }
    echo "<br><br>";
}

echo "Biblioteca original:\n";
echo "<br><br>";
imprimirBiblioteca($biblioteca);

// 3. Ordenar libros por año de publicación (del más antiguo al más reciente)
usort($biblioteca, function ($a, $b) {
    return $a['año'] - $b['año'];
});

echo "Libros ordenados por año de publicación:\n";
imprimirBiblioteca($biblioteca);

// 4. Ordenar libros alfabéticamente por título
usort($biblioteca, function ($a, $b) {
    return strcmp($a['titulo'], $b['titulo']);
});

echo "Libros ordenados alfabéticamente por título:\n";
imprimirBiblioteca($biblioteca);

// 5. Filtrar libros disponibles (no prestados)
$librosDisponibles = array_filter($biblioteca, function ($libro) {
    return !$libro['prestado'];
});

echo "Libros disponibles:<br>";
imprimirBiblioteca($librosDisponibles);
echo "<br><br>";
// 6. Filtrar libros por género
function filtrarPorGenero($libros, $genero)
{
    return array_filter($libros, function ($libro) use ($genero) {
        return strcasecmp($libro['genero'], $genero) === 0;
    });
}

$librosCienciaFiccion = filtrarPorGenero($biblioteca, "Ciencia ficción");
echo "Libros de Ciencia ficción:<br><br>";
imprimirBiblioteca($librosCienciaFiccion);
echo "<br><br>";
// 7. Obtener lista de autores únicos
$autores = array_unique(array_column($biblioteca, 'autor'));
sort($autores);

echo "Lista de autores:<br><br>";
foreach ($autores as $autor) {
    echo "- $autor<br>br>";
}
echo "<br><br>";

// 8. Calcular el año promedio de publicación
$añoPromedio = array_sum(array_column($biblioteca, 'año')) / count($biblioteca);
echo "Año promedio de publicación: " . round($añoPromedio, 2) . "<br><br>";

// 9. Encontrar el libro más antiguo y el más reciente
$libroMasAntiguo = array_reduce($biblioteca, function ($carry, $libro) {
    return (!$carry || $libro['año'] < $carry['año']) ? $libro : $carry;
});

$libroMasReciente = array_reduce($biblioteca, function ($carry, $libro) {
    return (!$carry || $libro['año'] > $carry['año']) ? $libro : $carry;
});

echo "Libro más antiguo: {$libroMasAntiguo['titulo']} ({$libroMasAntiguo['año']})<br>";
echo "Libro más reciente: {$libroMasReciente['titulo']} ({$libroMasReciente['año']})<br><br>";

// 10. TAREA: Implementa una función de búsqueda que permita buscar libros por título o autor
// La función debe ser capaz de manejar búsquedas parciales y no debe ser sensible a mayúsculas/minúsculas
function buscarLibros($biblioteca, $termino)
{
    $res = [];
    foreach ($biblioteca as $libro) {
        if ((strpos(strtolower(" " . $libro['titulo']), strtolower($termino)) == !false) || (strpos(strtolower(" " . $libro['autor']), strtolower($termino)) == !false)) {
            array_push($res, $libro);
        }
    }
    return $res;
}


$libro = "antoi";
// Ejemplo de uso de la función de búsqueda (descomenta para probar)
$resultadosBusqueda = buscarLibros($biblioteca, $libro);
echo "Resultados de búsqueda para {$libro}:<br>";
imprimirBiblioteca($resultadosBusqueda);

// 11. TAREA: Crea una función que genere un reporte de la biblioteca
// El reporte debe incluir: número total de libros, número de libros prestados,
// número de libros por género, y el autor con más libros en la biblioteca

function generarReporteBiblioteca($biblioteca)
{
    // Número total de libros
    $totalLibros = count($biblioteca);

    // Número de libros prestados
    $librosPrestados = count(array_filter($biblioteca, fn ($libro) => $libro['prestado']));

    // Número de libros por género
    $librosPorGenero = [];
    foreach ($biblioteca as $libro) {
        $genero = $libro['genero'];
        if (!isset($librosPorGenero[$genero])) {
            $librosPorGenero[$genero] = 0;
        }
        $librosPorGenero[$genero]++;
    }

    // Autor con más libros en la biblioteca
    $librosPorAutor = [];
    foreach ($biblioteca as $libro) {
        $autor = $libro['autor'];
        if (!isset($librosPorAutor[$autor])) {
            $librosPorAutor[$autor] = 0;
        }
        $librosPorAutor[$autor]++;
    }
    arsort($librosPorAutor);
    $autorConMasLibros = key($librosPorAutor);

    // Generar reporte
    $reporte = [
        'totalLibros' => $totalLibros,
        'librosPrestados' => $librosPrestados,
        'librosPorGenero' => $librosPorGenero,
        'autorConMasLibros' => $autorConMasLibros,
        'cantidadLibrosAutor' => $librosPorAutor[$autorConMasLibros]
    ];

    return $reporte;
}

// Ejemplo de uso de la función de reporte (descomenta para probar)
// echo "Reporte de la Biblioteca:\n";
echo "Reporte de la Biblioteca:<br><br>";
$reporte = generarReporteBiblioteca($biblioteca);
echo "Número total de libros: {$reporte['totalLibros']}<br>";
echo "Número de libros prestados: {$reporte['librosPrestados']}<br>";
echo "Número de libros por género:<br>";
foreach ($reporte['librosPorGenero'] as $genero => $cantidad) {
    echo "- $genero: $cantidad libros<br>";
}
echo "Autor con más libros: {$reporte['autorConMasLibros']} ({$reporte['cantidadLibrosAutor']} libros)<br>";
