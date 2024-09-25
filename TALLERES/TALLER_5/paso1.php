<?php
// 1. Crear un arreglo de 10 nombres de ciudades
$ciudades = ["Nueva York", "Tokio", "Londres", "París", "Sídney", "Río de Janeiro", "Moscú", "Berlín", "Ciudad del Cabo", "Toronto"];

// 2. Imprimir el arreglo original
echo "Ciudades originales:<br>";
print_r($ciudades);
echo '<br><br>';
// 3. Agregar 2 ciudades más al final del arreglo
array_push($ciudades, "Dubái", "Singapur");

// 4. Eliminar la tercera ciudad del arreglo
array_splice($ciudades, 2, 1);

// 5. Insertar una nueva ciudad en la quinta posición
array_splice($ciudades, 4, 0, "Mumbai");

// 6. Imprimir el arreglo modificado
echo "<br>Ciudades modificadas:<br>";
print_r($ciudades);
echo '<br><br>';
// 7. Crear una función que imprima las ciudades en orden alfabético
function imprimirCiudadesOrdenadas($arr)
{
    $ordenado = $arr;
    sort($ordenado);
    echo "Ciudades en orden alfabético:<br>";
    foreach ($ordenado as $ciudad) {
        echo "- $ciudad<br>";
    }
}
echo '<br><br>';
// 8. Llamar a la función
imprimirCiudadesOrdenadas($ciudades);

// TAREA: Crea una función que cuente y retorne el número de ciudades que comienzan con una letra específica
// Ejemplo de uso: contarCiudadesPorInicial($ciudades, 'S') debería retornar 1 (Singapur)
// Tu código aquí



function contarCiudadesPorInicial($ciudades, $letra)
{
    $ciudad = "";
    $letra = strtolower($letra);
    $contador = count($ciudades);
    $i = 0;
    $resultado = array();
    while ($i < $contador) {
        $ciudad = $ciudades[$i];
        $ciudad_v = strtolower($ciudad);
        $letra_inicial = substr($ciudad_v, 0, 1);
        if ($letra_inicial == $letra) {
            array_push($resultado, $ciudad);
        }
        $i++;
    }

    return '<br>' . count($resultado) . ' (' . implode(", ", $resultado) . ')';
}

echo contarCiudadesPorInicial($ciudades, "c");
