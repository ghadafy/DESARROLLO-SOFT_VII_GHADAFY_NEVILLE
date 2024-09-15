<?php
$paginaActual = 'listaEmpleados';
require_once 'HELPERS/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
include 'encabezado.php';


if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    //Aqui evaluamos los empleados que vienen de la pagina de empleados

    if (in_array($cod, $array_desarrollador)) {
        include_once('CLASES/desarrollador.php');
        $empl = new Desarrollador($cod, $_GET['nom'], $_GET['sal'], $_GET['dep'], $_GET['car'], $_GET['len'], $_GET['ani']);
    }

    if (in_array($cod, $array_gerentes)) {
        include_once('CLASES/gerente.php');
        $empl = new Gerente($cod, $_GET['nom'], $_GET['sal'], $_GET['dep'], $_GET['car'], 0);
    }

    $pers = $empl->getInformacionEmpleado();
} else {
    $cod = array_merge($array_gerentes, $array_desarrollador);
    //Aqui se define el aumento de todos los empleados
    $pers = "Todos los empleados a aumentar";
}


//Aqui realizo acciones si se envia el formulario
if (isset($_POST['form_aumentar']) && $_POST['form_aumentar'] === 'aumentar') {
    $empl->setEvaluacion($_POST['nivel']);

    // Definir la ruta del archivo JSON
    $archivo = 'HELPERS/listaEmpleados.json';

    $contenido  = file_get_contents($archivo);

    // Decodificar el JSON a un array PHP
    $empleados = json_decode($contenido, true);

    // ID del empleado que se desea modificar
    $idModificar = $empl->getId();

    // Nuevos datos para el empleado
    $nuevosDatos = [
        'nombre_completo' => $emp->getNombre(),
        'salario' => $emp->getSalarioBase(),
        'evaluacion' => $emp->getEvaluacion(),
        'cargo' => $emp->getCargo(),
        'departamento' => $emp->getDepartamento()
    ];



    // Buscar y modificar el empleado con el ID dado
    foreach ($empleados as &$empleado) {
        if ($empleado['id'] == $idModificar) {
            // Actualizar los campos del empleado
            $empleado['nombre_completo'] = $nuevosDatos['nombre_completo'];
            $empleado['salario'] = $nuevosDatos['salario'];
            $empleado['evaluacion'] = $nuevosDatos['evaluacion'];
            $empleado['cargo'] = $nuevosDatos['cargo'];
            $empleado['departamento'] = $nuevosDatos['departamento'];
            $empleado['bono'] = $nuevosDatos['bono'];
            $empleado['anios_experiencia'] = $nuevosDatos['cargo'];
            $empleado['lenguaje_dominante'] = $nuevosDatos['departamento'];


            break; // Salir del bucle una vez modificado
        }
    }

    // Codificar el array PHP de nuevo a formato JSON
    $nuevoContenido = json_encode($empleados, JSON_PRETTY_PRINT);

    // Guardar los cambios en el archivo JSON
    file_put_contents($archivo, $nuevoContenido);
    header("Location: listaEmpleados.php");
    exit();
}
?>




<form action="" method="post">
    <fieldset>
        <legend>PROCESO DE AUMENTO DE SALARIO</legend>
        <label for="nombre">
            Monto que se Aumentara
        </label>
        <input type="text" name="sal" id="sal" placeholder="Ingrese aquí el Monto Directo por aumentar">


    </fieldset>


    <input type="submit" value="Procesar Aumento">

    <input type="hidden" name="form_aumentar" id="form_aumentar" value="aumentar">

</form>


<?php
include 'pie_pagina.php';
?>