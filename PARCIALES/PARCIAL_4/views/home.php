<?php
$aviso = "DEBE INICIAR SESSION PARA PODER UTILIZAR LA APLICACION";
if (isset($_SESSION['user'])) {
    $enlace = "";
    $boton = "";
    $visible = false;
} else {
    $enlace = "style='pointer-events:none; background-color:grey;'";
    $boton = "disable";
    $visible = true;
}
?>

<div class="row">
    <div class="col m12">
        <div class="row">
            <div class="col 12 p-5"><a href="?c=mostrarBuscarHome" class="btn btn #00695c teal darken-3 rigth-align " <?= $enlace; ?>>Buscar Libros en API BOOKS de Google</a> <span class="aviso"> <?= $visible ? $aviso : ""; ?></span></div>
        </div>
        <table class="table-responsive z-depth-2 margin-botton 5">

            <tr class="white-text #01579b light-blue darken-4">

                <th class="center-align">COD-GOOGLE</th>
                <th class="center-align">TITULO</th>
                <th class="center-align">AUTOR</th>
                <th class="center-align">IMAGEN</th>
                <th class="center-align">RESEÑA</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>

            </tr>

            <?php

            if (isset($_SESSION)) {
                foreach ($libros as $libro) : ?>
                    <tr class="#212121 grey-text">
                        <td class="center-align"><?= $libro->id_libro_google; ?></td>
                        <td><?= $libro->titulo; ?></td>
                        <td><?= $libro->autor; ?></td>



                        <td class="center-align">
                            <?php if (!empty($libro->imagen_portada)) : ?>
                                <!-- Imagen pequeña -->
                                <img src="<?= $libro->imagen_portada; ?>" alt="Imagen Portada" style="width: 50px; height: 70px; cursor: pointer;" class="showcase-image" data-large-img="<?= $libro->imagen_portada; ?>" />
                            <?php else : ?>
                                <span>No hay imagen</span>
                            <?php endif; ?>
                        </td>


                        <td><?= $libro->resena_personal; ?></td>
                        <td class=" center align"><a href="?c=edicion&id=<?= $libro->id_libro; ?>" class="btn green z-depth" <?= $enlace ?>; ?> Editar</a> </td>
                        <td class=" center align"><a href="?c=eliminar&id=<?= $libro->id_libro; ?>" class="btn red z-depth" <?= $enlace; ?>> Eliminar</a> </td>
                    </tr>
            <?php endforeach;
            } ?>

        </table>

        <br>

        <a href="?c=nuevo" class="btn btn #00695c teal darken-3 rigth-align" <?= $enlace ?>;>Nuevo</a>
    </div>

</div>