<?php
$paginaActual = 'listaEmpleados';
require_once 'HELPERS/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
require_once 'encabezado.php';
require_once 'CLASES/empresa.php';

$departamentos = file_get_contents('HELPERS/listaDepartamentos.json');
$departamentos = json_decode($departamentos, true);

$cargos = file_get_contents('HELPERS/listaCargos.json');
$cargos = json_decode($cargos, true);

$empresa = new Empresa();
$emps = $empresa->listarTodosLosEmpleados();




echo "<table class='departamentos'>";

echo "<tr><td colspan=3><b>NOMINA TOTAL</b></td><td colspan=3><b style='font-size:25px;'>" . $empresa->NominaTotal() . "</b></td></tr>";

echo "<tr> <th> CODIGO </th><th> NOMBRE </th> <th> DEPARTAMENTO </th>  <th> CARGO </th><th> SALARIO </th><th>EMPLEADO EVALUABLE</th></tr>";
foreach ($emps as $atrib) {


    foreach ($departamentos as $departamento) {
        if ($departamento['id'] == $atrib['departamento']) {
            $dept = $departamento['nombre'];
        }
    }

    foreach ($cargos as $cargo) {
        if ($cargo['id'] == $atrib['cargo']) {
            $carg = $cargo['cargo'];
        }
    }


    if (in_array($atrib['cargo'], $array_desarrollador) ||  in_array($atrib['cargo'], $array_gerentes)) {


        $eval = "<a href='evaluacion.php?cod={$atrib['id']}&nom={$atrib['nombre_completo']}&sal={$atrib['salario']}&dep={$atrib['cargo']}&car={$atrib['departamento']}&len={$atrib['anios_experiencia']}&ani={$atrib['lenguaje_dominante']}'>SI</a>";
    } else {
        $eval = "NO";
    }

    echo "<tr><td class='cod'>" . $atrib['id'] . "</td><td class='articulo'>" . $atrib['nombre_completo'] . "</td><td class='descripcion'>" . $dept . "</td><td>" . $carg . "</td><td>" . $atrib['salario'] . "</td><td class='cod'>" . $eval  . "</td></tr>";
}

echo "</table>";


include 'pie_pagina.php';
