<?php
$paginaActual = 'sobre_nosotros'; 
require_once 'plantillas/funciones.php';
$tituloPagina = obtenerTituloPagina($paginaActual);
include 'plantillas/encabezado.php';
?>

<h2>Sobre Nosotros</h2>
<h1>Nuestra Historia</h1>



<p>Fundada en [Año de fundación], [Nombre de tu Empresa] ha crecido hasta convertirse en un referente en la industria de [sector en el que operas]. Desde nuestros inicios, hemos mantenido un compromiso firme con la innovación y la excelencia.</p>

<h2>Nuestra Misión</h2>

<p>Brindar soluciones tecnológicas de alta calidad que impulsen el éxito de nuestros clientes.</p>

<h2>Nuestros Valores</h2>

<ul>
<li>Integridad: Operamos con transparencia y honestidad en todas nuestras acciones.</li>
<li>Innovación: Buscamos continuamente nuevas formas de mejorar y crecer.</li>
<li>Compromiso con el Cliente: La satisfacción del cliente es nuestra principal prioridad.</li>
</ul>

<h2>Nuestro Equipo</h2>

<p>Contamos con un equipo de profesionales altamente capacitados y apasionados por lo que hacen. Cada miembro de nuestro equipo aporta su experiencia y conocimientos para garantizar que recibas el mejor servicio posible.</p>



<?php
include 'plantillas/pie_pagina.php';
?>







