<?php

//DATOS GENERALES

//Titulos de mi menu
$titulo = [
    'index' => 'Departamentos',

    'listaEmpleados' => 'Lista de Empleados',

    'listaEmpleadosEva' => 'Empleados para Aumento',

    'emp' => 'Agregar Empleados',

    'reportes' => 'Reportes'

];



//Aqui obtenemos el archivo json de empleados
//Se agregraron muchos articulos para que el sistema tuviera la opcion de ser mas funcional
$listaEmpleados = file_get_contents('HELPERS/listaEmpleados.json');
$departamentos = file_get_contents('HELPERS/listaDepartamentos.json');
$cargos = file_get_contents('HELPERS/listaCargos.json');
$array_gerentes = [1, 2, 3, 6, 9, 12, 15, 19, 23, 24, 27];
$array_desarrollador = [4];
//FUNCIONES

//Funcion para manejar el titulo de la pagina
function obtenerTituloPagina($titulos, $pagina)
{
    return isset($titulos[$pagina]) ? $titulos[$pagina] : '';
}

//Funcion para manejar el menu de la aplicacion
function generarMenu($menu, $paginaActual)
{

    $html = '<nav><ul>';
    foreach ($menu as $pagina => $titulo) {
        $clase = ($pagina === $paginaActual) ? ' class="activo"' : '';
        $html .= "<li><a href='" . $pagina . ".php' " . $clase . ">" . $titulo . "</a></li>";
    }
    $html .= '</ul></nav>';
    return $html;
}




//Funcion para mostrar la lista de departamentos   
function verContenido($arreglo)
{

    $obj = json_decode($arreglo, true);

    echo "<table class='departamentos'>";
    echo "<tr><th>CODIGO</th><th> DEPARTAMENTOS </th><th> FUNCIONES </th></tr>";

    foreach ($obj as $atrib) {

        echo "<tr><td class='cod'>" . $atrib['id'] . "</td><td class='articulo'>" . $atrib['nombre'] . "</td><td class='descripcion'>" . $atrib['descripcion'] . "</td></tr>";
    }

    echo "</table>";
}




function verContenidoFiltrado($filtro)
{

    $acumulador = 0;
    $contador = 0;
    $promedio = 0;
    $listaEmpleados = file_get_contents('HELPERS/listaEmpleados.json');
    $listaDepartamentos = file_get_contents('HELPERS/listaDepartamentos.json');
    $deptos = json_decode($listaDepartamentos, true);

    $obj = json_decode($listaEmpleados, true);

    echo "<table class='departamentos'>";
    echo "<tr><th>DEPARTAMENTO </th><th> EMPLEADO</th><th> SALARIO </th></tr>";

    foreach ($obj as $atrib) {
        if ($atrib['departamento'] == $filtro) {


            foreach ($deptos as $departamento) {
                if ($departamento['id'] == $atrib['departamento']) {
                    $dept = $departamento['nombre'];
                }
            }

            echo "<tr><td>" . $dept . "</td><td class='articulo'>" . $atrib['nombre_completo'] . "</td><td class='salario'>" . $atrib['salario'] . "</td></tr>";
            $contador++;
            $acumulador += $atrib['salario'];
        }
    }
    if ($contador > 0) {
        $promedio = $acumulador / $contador;
    } else {
        $promedio = 0;
    }
    echo "<tr><th  colspan=2> SALARIO PROMEDIO </th><th>" . number_format($promedio, 2) . "</th></tr>";
    echo "</table>";
}






function verContenidoFiltradoCargo($filtro)
{

    $acumulador = 0;
    $contador = 0;
    $promedio = 0;
    $listaEmpleados = file_get_contents('HELPERS/listaEmpleados.json');
    $listaCargos = file_get_contents('HELPERS/listaCargos.json');
    $cargos = json_decode($listaCargos, true);

    $obj = json_decode($listaEmpleados, true);

    echo "<table class='departamentos'>";
    echo "<tr><th>CARGO</th><th> EMPLEADO</th><th> SALARIO </th></tr>";

    foreach ($obj as $atrib) {
        if ($atrib['cargo'] == $filtro) {

            foreach ($cargos as $cargo) {
                if ($cargo['id'] == $atrib['cargo']) {
                    $carg = $cargo['cargo'];
                }
            }


            echo "<tr><td>" . $carg . "</td><td class='articulo'>" . $atrib['nombre_completo'] . "</td><td class='salario'>" . $atrib['salario'] . "</td></tr>";
            $contador++;
            $acumulador += $atrib['salario'];
        }
    }
    if ($contador > 0) {
        $promedio = $acumulador / $contador;
    } else {
        $promedio = 0;
    }
    echo "<tr><th colspan=2> SALARIO PROMEDIO </th><th>" . number_format($promedio, 2) . "</th></tr>";
    echo "</table>";
}
