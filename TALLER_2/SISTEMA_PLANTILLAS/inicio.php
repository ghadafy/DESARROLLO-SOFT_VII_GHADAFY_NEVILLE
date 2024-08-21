<?php
$paginaActual = 'inicio'; 
require_once 'plantillas/funciones.php';
$tituloPagina = obtenerTituloPagina($paginaActual);
include 'plantillas/encabezado.php';
?>

<h2>Página de Inicio</h2>
<h1>Bienvenidos a [Nombre de tu Empresa]</h1>
<p>Este es el contenido específico de la página de inicio.</p>




<p>En [Nombre de tu Empresa], nos dedicamos a [breve descripción de lo que hace tu empresa, por ejemplo: ofrecer soluciones tecnológicas innovadoras para optimizar tus procesos de negocio]. Con un enfoque en la calidad y la satisfacción del cliente, estamos aquí para ayudarte a alcanzar tus objetivos.</p>

<h2>Nuestros Servicios</h2>

<ul>
    
<li>Consultoría Tecnológica: Asesoramiento especializado para maximizar el rendimiento de tu infraestructura.</li>
<li>Desarrollo de Software: Creamos aplicaciones personalizadas que se adaptan a tus necesidades.</li>
<li>Soporte Técnico: Un equipo siempre disponible para resolver cualquier inconveniente.</li>
</ul>
<h2>Por qué Elegirnos</h2>
<ul>
<li>Experiencia Comprobada: Más de [X] años en la industria.</li>
<li>Soporte 24/7: Estamos disponibles cuando nos necesites.</li>
<li>Innovación Continua: Implementamos las últimas tecnologías para mantenerte a la vanguardia.</li>
</ul>

<?php
include 'plantillas/pie_pagina.php';
?>