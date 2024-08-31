<?php
$paginaActual = 'valor_inventario'; 
require_once 'plantillas/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
include 'plantillas/encabezado.php';
?>





<p>Se calcula la cantidad total de productos y cuanto es su costo total </p>


<?php valorInventario($inventario) ?>


<?php
include 'plantillas/pie_pagina.php';
?>

