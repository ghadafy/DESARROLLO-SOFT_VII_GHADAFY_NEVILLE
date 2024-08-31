<?php
$paginaActual = 'inventario'; 
require_once 'plantillas/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
include 'plantillas/encabezado.php';
?>


<?php 
verInventario($inventario);
?>

<?php
include 'plantillas/pie_pagina.php';
?>