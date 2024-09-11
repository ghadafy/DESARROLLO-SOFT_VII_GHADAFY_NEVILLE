<?php 


function obtenerLibros() {

    $libros = [
        [
            "titulo" => "ODISEA",
            "autor" => "HOMERO",
            "genero" => "POESIA",
            "descripcion" => "Uno de los más grandes poemas épicos de todos los tiempos",
            "anio" => "siglo VIII a. C."
        ],
        [
            "titulo" => "DON QUIJOTE DE LA MANCHA",
            "autor" => "MIGUEL DE CERVANTES",
            "genero" => "NOVELA LITERARIA",
            "descripcion" => "El clásico indiscutible de las letras españolas en una edición única a cargo del profesor Alberto Blecua",
            "anio" => "1581"
        ],
        [
            "titulo" => "EL CODIGO DA VINCI",
            "autor" => "DAN BROWN",
            "genero" => "NOVELA CONTEMPORANEA",
            "descripcion" => "La mayor conspiración de los últimos 2000 años está a punto de ser desvelada. Una de las novelas más leídas de todos los tiempos.",
            "anio" => "2003"
        ],
        [
            "titulo" => "Y NO QUEDO NINGUNO",
            "autor" => "AGATHA CHRISTIE",
            "genero" => "NOVELA NEGRA",
            "descripcion" => "Esta edición restituye el título original de la novela mundialmente conocida como Diez negritos.",
            "anio" => "2022"
        ],
        [
            "titulo" => "ALICIA EN EL PAIS DE LAS MARAVILLAS",
            "autor" => "LEWIS CARROLL",
            "genero" => "JUVENIL",
            "descripcion" => "Una edición especial y exclusiva de un clásico indispensable en la biblioteca de cualquier lector. Traducción de Juan Gabriel López GuixCubierta diseñada por Martina FlorIlustraciones del interior de John Tenniel",
            "anio" => "1865"
        ],
        [
            "titulo" => "LAS AVENTURAS DE SHERLOCK HOLMES",
            "autor" => "ARTHUR CONAN DOYLE",
            "genero" => "NOVELA NEGRA",
            "descripcion" => "Colección de 12 relatos protagonizados por Sherlock Holmes. Las mejores intrigas del inmortal detective Sherlock Holmes.",
            "anio" => "1892"
        ]
    ];
    
    return $libros;
}


function mostrarDetalles($buscado) {
    
    $libros = obtenerLibros();
    foreach ($libros as $libro) {
        if ($libro["titulo"] == $buscado) {
            $libroEncontrado = $libro;
            break; 
        }
    }
    
    if ($libroEncontrado) {
        $detalle = "<div class='det'>";
        $detalle .= "Autor: " . $libroEncontrado["autor"] . "<br>";
        $detalle .= "Género: " . $libroEncontrado["genero"] . "<br>";
        $detalle .= "Compuesta en: " . $libroEncontrado["anio"] . "<br>";
        $detalle .= "Descripcion: <i>" . $libroEncontrado["descripcion"] . "</i><br>";
        $detalle .= "</div>";
    } 

    return $detalle;
}



?>