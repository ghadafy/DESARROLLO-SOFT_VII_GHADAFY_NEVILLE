<?php

$calificacion = 55;

/*
90-100: A
80-89: B
70-79: C
60-69: D
0-59: F

A: "Excelente trabajo"
B: "Buen trabajo"
C: "Trabajo aceptable"
D: "Necesitas mejorar"
F: "Debes esforzarte más"

*/ 


if ($calificacion>90):
    $cal = "A";
    echo "Tu calificacion es A";
    
elseif ($calificacion>80 && $calificacion<=90):
    $cal = "B";
    echo "Tu calificacion es B";

elseif ($calificacion>70 && $calificacion<=80):
    $cal = "C";
    echo "Tu calificacion es C";

elseif ($calificacion>60 && $calificacion<=70):
    $cal = "D";
    echo "Tu calificacion es D";
else:
    $cal = "F";
    echo "Tu calificacion es F";
endif;

echo "<br>";
$resultado = ($calificacion >= 60) ? "Aprobado" : "Reprobado";
echo "Resultado: $resultado<br>";


switch ($cal) {
    case "A":
        echo "Excelente trabajo.<br>";
        break;
    case "B":
        echo "Buen trabajo. <br>";
        break;
    case "C":
        echo "Trabajo aceptable. <br>";
        break;
    case "D":
            echo "Necesitas mejorar. <br";
        break;
    default:
        echo "Debes esforzarte más.<br>";
}

?>