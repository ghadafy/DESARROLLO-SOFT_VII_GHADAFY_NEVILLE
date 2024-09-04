<?php include 'utilidades_texto.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema1</title>
</head>

<body>
    <h1>Problema 1</h1>

    <?php
    $arreglo = ["Esta es la primera frase", "Hola Mundo", "Ghadafy es mi nombre"];
    echo "Este es mi arreglo <br>";
    print_r($arreglo); ?>
    <table border="1px">
        <tr>
            <th>FRASE 1</th>
            <th>FRASE 2</th>
            <th>FRASE 3</th>
        <tr>

        <tr><?php


            foreach ($arreglo as $item) {

                echo "<td>";
                echo contar_palabras($item);
                echo "<br>";

                echo contar_vocales($item);
                echo "<br>";

                echo invertir_palabras($item);
                echo "<br>";
                echo "</td>";
            }

            ?>

        </tr>

    </table>

</body>

</html>

<?php



?>