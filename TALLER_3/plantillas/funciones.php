<?php


//DATOS GENERALES

//Titulos de mi menu
$titulo = [
    'inventario' => 'Resumen de Inventario',
    'valor_inventario' => 'Valor Total de Inventario',
    'stock_bajo' => 'Propductos con Stock Bajo'
];

//Variable utilizada para filtrar los cosniderados stock bajo
$bajo_stock = 5;

//Aqui obtenemos el archivo json de inventario
//Se agregraron muchos articulos para que el sistema tuviera la opcion de ser mas funcional
$inventario = file_get_contents('plantillas/inventario.json');


//FUNCIONESs

//Funcion para manejar el titulo de la pagina
function obtenerTituloPagina($titulos, $pagina) {

            return isset($titulos[$pagina]) ? $titulos[$pagina] : 'Página Desconocida';
}
        
//Funcion para manejar el menu de la aplicacion
function generarMenu($menu, $paginaActual) {
         
            $html = '<nav><ul>';
            foreach ($menu as $pagina => $titulo) {
                $clase = ($pagina === $paginaActual) ? ' class="activo"' : '';
                $html .= "<li><a href='".$pagina.".php' ".$clase.">".$titulo."</a></li>";
            }
            $html .= '</ul></nav>';
            return $html;
}
        
//Funcion para mostrar el resumen del inventario y el Stock mas abjo    
/* Esta funcion hace dos cosas. Muestra la lista de productos y tambien el stock bajo */ 
function verInventario ($arreglo, $stock=null) {
    
    $obj = json_decode($arreglo, true);

    //Aqui ordenamos los articulos
    usort($obj, function($a, $b){
        return($a['nombre'] <=> $b['nombre']);
    });

    echo "<table>";
    echo "<tr><th> Articulo </th><th> Precio </th><th> Cantidad </th></tr>";

    //si llamamos a la funcion y no le pasamos el stock nos muestra todo el resumen
    if(is_null($stock)){
        foreach ($obj as $atrib) {
        
                echo "<tr><td class='articulo'>".$atrib['nombre']."</td><td class='precio'> B/. ".number_format($atrib['precio'],2)."</td><td class='cantidad'>".$atrib['cantidad']."</td></tr>";
        
        }

    }
    else{
        /*Si llamamaos a la funcion y le pasamos el stock entonces solo muestra 
        los articulos con esa cantidad o debajo de ella */
        foreach ($obj as $atrib) {
            if($atrib['cantidad']<=$stock){
                echo "<tr><td class='articulo'>".$atrib['nombre']."</td><td class='precio'> B/. ".number_format($atrib['precio'],2)."</td><td class='cantidad'>".$atrib['cantidad']."</td></tr>";
            }            
        }
        
    }

    echo "</table>";

}


//Esta funcion suma la cantidad de articulos y nos muestra el costo total
function valorInventario ($arreglo) {
    
    $obj = json_decode($arreglo, true);
    $cantidad_total = 0;
    $cuantia_total = 0;
    foreach ($obj as $atrib) {
        $costo_art = $atrib['cantidad']*$atrib['precio'];
        $cantidad_total += $atrib['cantidad'];
        $cuantia_total += $costo_art;
    }

    echo "<table>";
    echo "<tr><th> Cantidad Total de Articulos </th><th> Cuantia Total </th></tr>";
    echo "<tr><td class='cantidad'>".$cantidad_total."</td><td class='precio'> B/. ".number_format($cuantia_total,2)."</td></tr>";
    echo "</table>";

}



?>