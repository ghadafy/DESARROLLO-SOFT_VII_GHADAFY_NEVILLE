<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plantillas/style.css">
    <title><?php echo $tituloPagina; ?></title>
    <style>

    </style>
</head>
<body>
<header>

        <h1 class='titulo'>SISTEMA SIMPLE DE INVENTARIO</h1>
        <?php echo generarMenu($titulo, $paginaActual); ?>
        <h2><?php echo $tituloPagina; ?></h2>
    
    </header>
    <main>