<?php
$paginaActual = 'listaEmpleadosEva';
require_once 'HELPERS/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
require_once 'encabezado.php';
require_once 'CLASES/empresa.php';


$empresa = new Empresa();
$emps = $empresa->listarTodosLosEmpleados();



echo "<table class='departamentos'>";
echo "<tr> <th> CODIGO </th><th> NOMBRE </th><th> SALARIO </th><th>EVALUACION FAVORABLE</th></tr>";
foreach ($emps as $atrib) {

    if ((in_array($atrib['cargo'], $array_desarrollador) ||  in_array($atrib['cargo'], $array_gerentes)) && (in_array($atrib['evaluacion'], [4, 5]))) {

        $eval = "<a href='procesarAumento.php?cod={$atrib['id']}&nom={$atrib['nombre_completo']}&sal={$atrib['salario']}&dep={$atrib['cargo']}&car={$atrib['departamento']}&len={$atrib['anios_experiencia']}&ani={$atrib['lenguaje_dominante']}'>PROCESAR AUMENTO</a>";

        echo "<tr><td class='cod'>" . $atrib['id'] . "</td><td class='articulo'>" . $atrib['nombre_completo'] . "</td><td class='descripcion'>" . $atrib['salario'] . "</td><td class='cod'>" . $eval . "</td></tr>";
    }
}

echo "</table>";


include 'pie_pagina.php';
