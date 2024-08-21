<?php
$paginaActual = 'contacto'; 
require_once 'plantillas/funciones.php';
$tituloPagina = obtenerTituloPagina($paginaActual);
include 'plantillas/encabezado.php';
?>

<h2>Contacto</h2>
<h1>¡Hablemos!</h1>



<p>Si tienes alguna pregunta o quieres saber más sobre nuestros servicios, no dudes en contactarnos. Estamos aquí para ayudarte.</p>

<h2>Dirección:</h2>
<ul>
<li>[Calle y número]</li>
<li>[Ciudad, Estado, Código Postal]</li>
<li>[País]</li>
</ul>


<h2>Teléfono:</h2>
<ul>
<li>[+123 456 7890]</li>
</ul>


<h2>Correo Electrónico:</h2>
<ul>
    <li>[contacto@tuempresa.com]</li>
</ul>

<h2>Horario de Atención:</h2>
<ul>
    <li>Lunes a Viernes: 9:00 AM - 6:00 PM</li>
    <li>Sábados: 10:00 AM - 2:00 PM</li>
    <li>Domingos: Cerrado</li>
</ul>

<h2>Síguenos en Redes Sociales:</h2>
<ul>
<li>Facebook: [Enlace a tu perfil]</li>
<li>Twitter: [Enlace a tu perfil]</li>
<li>LinkedIn: [Enlace a tu perfil]</li>
<ul>


<?php
include 'plantillas/pie_pagina.php';
?>

