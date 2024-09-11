
<?php
// Definición de variables
$nombre = "Ghadafy Neville";
$edad = 40;
$correo = "ghadafy.neville@utp.ac.pa";
$telefono = "6232-6231";

// Definición de constante
define("OCUPACION", "Estudiante");

// Creación de mensaje usando diferentes métodos de concatenación e impresión
$mensaje1 = "Hola, mi nombre es " . $nombre . " y tengo " . $edad . " años.";
$mensaje2 = "Mi correo es $correo , mi telefono es $telefono y soy " . OCUPACION . ".";

echo $mensaje1 . "<br>";
print($mensaje2 . "<br>");

printf("En resumen: %s, %d años, %s, %s<br>", $nombre, $edad, $correo, $telefono, OCUPACION);

echo "<br>Información de debugging:<br>";
var_dump($nombre);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($correo);
echo "<br>";
var_dump($telefono);
echo "<br>";
var_dump(OCUPACION);
echo "<br>";
?>
    