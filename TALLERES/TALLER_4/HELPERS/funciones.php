<?php

//DATOS GENERALES

//Titulos de mi menu
$titulo = [
    'index' => 'Departamentos',

    'listaEmpleados' => 'Lista de Empleados',

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

    //si llamamos a la funcion y no le pasamos el stock nos muestra todo el resumen

    foreach ($obj as $atrib) {

        echo "<tr><td class='cod'>" . $atrib['id'] . "</td><td class='articulo'>" . $atrib['nombre'] . "</td><td class='descripcion'>" . $atrib['descripcion'] . "</td></tr>";
    }

    echo "</table>";
}
