<?php
$paginaActual = 'index';
require_once 'HELPERS/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
include 'encabezado.php';
?>


<?php
verContenido($departamentos);
?>

<?php
include 'pie_pagina.php';
?>