<?php
$paginaActual = 'aumentos';
require_once 'HELPERS/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
include 'encabezado.php';
?>


<?php
echo "<h1>AUMENTOS</h1>";
//verContenido($contenido);
?>

<?php
include 'pie_pagina.php';
?>