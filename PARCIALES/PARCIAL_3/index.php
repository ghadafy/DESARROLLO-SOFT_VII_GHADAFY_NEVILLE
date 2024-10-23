<?php
session_start();

require_once 'requerimientos.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
</head>

<body>
    <h2>Bienvenido <?php if ($_SESSION['tipo'] == 1) {
                        echo "Profesor: " . $_SESSION['nombre'];
                    } else {
                        echo  "Estudiante: " . $_SESSION['nombre'];
                    }  ?></h2>

    <h3>DASHBOARD</h3>

    <?php if ($_SESSION['tipo'] == 1) { ?>

        <h2>Lista de Estudiantes y sus calificaciones</h2>

        <table>
            <tr>
                <th>Estudiante</th>
                <th>Calificacion</th>
            </tr>
            <?php foreach ($lista_estudiantes as $estudiante) { ?>
                <tr>
                    <td><?php echo $estudiante['nombre']; ?></td>
                    <td><?php echo $estudiante['nota']; ?></td>
                </tr>

            <?php } ?>
        </table>

        <?php } else {
        foreach ($lista_estudiantes as $estudiante) {
            if ($estudiante['usuario'] == $_SESSION['usuario']) {

        ?>

                <p>Tu calificacion es: <?php echo $estudiante['nota']; ?> </p>
    <?php }
        }
    } ?>

    <br>
    <a href="logout.php">Cerra Session</a>

</body>

</html>