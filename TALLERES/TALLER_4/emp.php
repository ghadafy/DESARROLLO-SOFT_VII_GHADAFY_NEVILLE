<?php

$paginaActual = 'emp';
require_once 'HELPERS/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
require_once 'encabezado.php';



if (isset($_POST['form_registrar']) && $_POST['form_registrar'] === 'registrar') {

    include 'CLASES/empresa.php';
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $salario = $_POST['salario'];

    $departamento = $_POST['departamento'];
    $cargo = $_POST['cargo'];
    $bono = $_POST['bono'];
    $experiencia = $_POST['aniosExperiencia'];
    $leng = $_POST['lenguaje'];

    $empresa = new Empresa();

    // Crear un empleado con el cargo de desarrollador o gerente según el valor del cargo
    if ($cargo == 4) {
        $empleado = new Desarrollador($id, $nombre, $salario, $departamento, $cargo, $experiencia, $leng);
    } elseif (in_array($cargo, [1, 2, 3, 6, 9, 12, 15, 19, 23, 24, 27])) {
        $empleado = new Gerente($id, $nombre, $salario, $departamento, $cargo, $bono);
    } else {
        $empleado = new Empleado($id, $nombre, $salario, $departamento, $cargo);
    }

    // Agregar el empleado a la empresa
    $empresa->agregarEmpleados($empleado);

    // Definir el archivo donde guardar los empleados
    $archivo = 'HELPERS/listaEmpleados.json';

    // Verificar si el archivo existe y contiene datos
    if (file_exists($archivo)) {
        // Leer el contenido del archivo
        $contenidoExistente = file_get_contents($archivo);
        // Decodificar el contenido JSON existente a un array
        $empleados = json_decode($contenidoExistente, true);
    } else {
        // Si el archivo no existe o está vacío, crear un array vacío
        $empleados = [];
    }

    // Convertir el objeto del empleado en un array
    $empleadoArray = [
        'id' => $empleado->getId(),
        'nombre_completo' => $empleado->getNombre(),
        'salario' => $empleado->getSalarioBase(),
        'bono' => 0,
        'evaluacion' => $empleado->getEvaluacion(),
        'cargo' => $empleado->getCargo(),
        'departamento' => $empleado->getDepartamento(),
        'anios_experiencia' => $empleado instanceof Desarrollador ? $empleado->getAnios_experiencia() : null,
        'lenguaje_dominante' => $empleado instanceof Desarrollador ? $empleado->getLenguaje() : null
    ];

    // Añadir el nuevo empleado al array existente
    $empleados[] = $empleadoArray;

    // Codificar nuevamente el array completo en JSON
    $nuevoContenido = json_encode($empleados, JSON_PRETTY_PRINT);

    // Guardar el contenido actualizado en el archivo
    file_put_contents($archivo, $nuevoContenido);

    // Redirigir a la página principal
    header("Location: index.php");
    exit();
}
?>





<form action="" method="post" class="agregarEmpleados">

    <label for="id">
        Codigo de Empleado
    </label>
    <input type="text" name="id" id="id" placeholder="Ingrese aquí el Codigo de Empleado">


    <label for="nombre">
        Nombre de Empleado
    </label>
    <input type="text" name="nombre" id="nombre" placeholder="Ingrese aquí el Nombre del Empleado">



    <label for="salario">
        Salario Mensual Base
    </label>
    <input type="text" name="salario" id="salario" placeholder="Ingrese aquí el Salario">


    <label for="departamento">
        Departamento de Empleado
    </label>
    <select name="departamento" id="departamento">

        <?php
        $deptos = json_decode($departamentos, true);

        foreach ($deptos as $dep) { ?>
        <?php echo "<option value='" . $dep['id'] . "'>" . $dep["nombre"] . "</option>";
        }
        ?>
    </select>


    <label for="cargo">
        Cargo de Empleado
    </label>

    <select name="cargo" id="cargo">
        <?php
        $datos = json_decode($cargos, true);

        foreach ($datos as $cargo) { ?>
        <?php echo "<option value='" . $cargo['id'] . "'>" . $cargo["cargo"] . "</option>";
        }
        ?>
    </select>


    <label for="aniosExperiencias" style="display:none;" id="lb_aniosExperiencia">
        Años de Experiencia de Empleado
    </label>

    <input type="text" name="aniosExperiencia" id="aniosExperiencia" placeholder="Ingrese aquí los Años de Experiencia" style="display:none;">


    <label for="lenguaje" style="display:none;" id="lb_lenguaje">
        Lenguaje de Programación que mas Domina
    </label>

    <input type="text" name="lenguaje" id="lenguaje" placeholder="Ingrese aquí el Lenguaje que mas Domina" style="display:none;">

    <input type="submit" class="button" value="Registrar Empleado">

    <input type="hidden" name="form_registrar" id="form_registrar" value="registrar">

</form>




<script src="HELPERS/ocultar.js"></script>

<?php
include 'pie_pagina.php';
?>