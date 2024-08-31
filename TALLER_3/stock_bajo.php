<?php
$paginaActual = 'stock_bajo'; 
require_once 'plantillas/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
include 'plantillas/encabezado.php';
?>


<p>Aqui se considera una cantidad total de producto "<b> <?= $bajo_stock; ?> </b>" como STOCK BAJO.</p>
<p>Se muestran los productos cuya cantidad es igual o esta por debajo de lo considerado STOCK BAJO.</p>


<?php  verInventario($inventario, $bajo_stock); ?> 

<?php
include 'plantillas/pie_pagina.php';
?>
