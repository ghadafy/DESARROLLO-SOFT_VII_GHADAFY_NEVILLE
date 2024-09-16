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
        $emple = new Desarrollador($cod, $_GET['nom'], $_GET['sal'], $_GET['dep'], $_GET['car'], $_GET['len'], $_GET['ani']);
    } elseif (in_array($cod, $array_gerentes)) {
        include_once('CLASES/gerente.php');
        $emple = new Gerente($cod, $_GET['nom'], $_GET['sal'], $_GET['dep'], $_GET['car'], 0);
    } else {
        include_once('CLASES/empleado.php');
        $emple = new Empleado($cod, $_GET['nom'], $_GET['sal'], $_GET['dep'], $_GET['car']);
    }
    $personal = $emple->getNombre();
}


//Aqui realizo acciones si se envia el formulario
if (isset($_POST['form_evaluar']) && $_POST['form_evaluar'] === 'evaluar') {
    $emple->setEvaluacion($_POST['nivel']);

    // Definir la ruta del archivo JSON
    $archivo = 'HELPERS/listaEmpleados.json';

    $contenido  = file_get_contents($archivo);

    // Decodificar el JSON a un array PHP
    $empleados = json_decode($contenido, true);

    // ID del empleado que se desea modificar
    $idModificar = $emple->getId();

    // Nuevos datos para el empleado
    $nuevosDatos = [
        'nombre_completo' => $emple->getNombre(),
        'salario' => $emple->getSalarioBase(),
        'evaluacion' => $emple->getEvaluacion(),
        'cargo' => $emple->getCargo(),
        'departamento' => $emple->getDepartamento()
    ];



    // Buscar y modificar el empleado con el ID dado
    foreach ($empleados as &$empleado) {
        if ($empleado['id'] == $idModificar) {
            // Actualizar los campos del empleado
            $empleado['nombre_completo'] =  $empleado['nombre_completo'];
            $empleado['salario'] =  $empleado['salario'];
            $empleado['evaluacion'] = $nuevosDatos['evaluacion'];
            $empleado['cargo'] =   $empleado['cargo'];
            $empleado['departamento'] = $empleado['departamento'];
            $empleado['bono'] = $empleado['bono'];
            $empleado['anios_experiencia'] = $empleado['anios_experiencia'];
            $empleado['lenguaje_dominante'] =  $empleado['lenguaje_dominante'];


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
        <legend class="legend">EVALUACION DE EMPLEADO POR NIVEL</legend>
        <div class="linea_titulo">
            <h3><?php echo $personal; ?></h3>
        </div>
        <div>
            <input type="radio" id="nivel" name="nivel" value=1 />
            <label for="nivel">1 - DEFICIENTE</label>
        </div>

        <div>
            <input type="radio" id="nivel" name="nivel" value=2 />
            <label for="nivel">2 - ACEPTABLE</label>
        </div>

        <div>
            <input type="radio" id="nivel" name="nivel" value=3 />
            <label for="nivel">3 - REGULAR</label>
        </div>

        <div>
            <input type="radio" id="nivel" name="nivel" value=4 />
            <label for="nivel">4 - BUENO</label>
        </div>

        <div>
            <input type="radio" id="nivel" name="nivel" value=5 />
            <label for="nivel">5 - MUY BUENO</label>
        </div>


    </fieldset>


    <input type="submit" value="Evaluar Empleado">

    <input type="hidden" name="form_evaluar" id="form_evaluar" value="evaluar">

</form>


<?php
include 'pie_pagina.php';
?>