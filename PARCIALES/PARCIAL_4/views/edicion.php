<?php
if (isset($_SESSION['errores'])) {
    foreach ($_SESSION['errores'] as $error) {
        echo "<span class='red-text'>" . $error . "<br></span>";
    }
}
unset($_SESSION['data']);
unset($_SESSION['errores']);
?>

<form action="?c=guardar" method="post" enctype="multipart/form-data">
    <h5>Editar Libro</h5>

    <div class="row">
        <div class="col s3"></div>
        <div class="col s3">Cod-G:</div>
        <div class="col s3">
            <input type="text" name="id_libro_google" id="id_libro_google" placeholder="Código de Google" value="<?= isset($lib) ? $lib->id_libro_google :  $_SESSION['data']['id_libro_google']; ?>">
        </div>
        <div class="col s3"></div>
    </div>

    <div class="row">
        <div class="col s3"></div>
        <div class="col s3">Título:</div>
        <div class="col s3">
            <input type="text" name="titulo" id="titulo" placeholder="Título del libro" value="<?= isset($lib) ? $lib->titulo :  $_SESSION['data']['titulo']; ?>">
        </div>
        <div class="col s3"></div>
    </div>

    <div class="row">
        <div class="col s3"></div>
        <div class="col s3">Autor:</div>
        <div class="col s3">
            <input type="text" name="autor" id="autor" placeholder="Autor del libro" value="<?= isset($lib) ? $lib->autor :  $_SESSION['data']['autor']; ?>">
        </div>
        <div class="col s3"></div>
    </div>

    <!-- Imagen Portada -->
    <div class="row">
        <div class="col s3"></div>
        <div class="col s3 btn file-field input-field #9e9e9e grey">
            <span>Imagen Portada</span>
            <input type="file" name="imagen_portada" id="imagen_portada" accept="image/*" value="<?= $lib->imagen_portada ?>">
        </div>
        <div class="col s3 file-path-wrapper">
            <!-- Si ya existe una imagen, mostrar la ruta en el campo de texto -->
            <input class="file-path validate" type="text" placeholder="Adjunte una imagen" id="file-path" value="<?= isset($lib) && !empty($lib->imagen_portada) ? $lib->imagen_portada : ''; ?>">
        </div>
        <div class="col s3"></div>
    </div>

    <!-- Mostrar la imagen actual si existe -->
    <?php if (isset($lib) && !empty($lib->imagen_portada)) : ?>
        <div class="row">
            <div class="col s3"></div>
            <div class="col s3">Imagen Actual:</div>
            <div class="col s3">
                <img src="<?= $lib->imagen_portada ?>" alt="Imagen de portada" width="100">
            </div>
            <div class="col s3"></div>
        </div>
    <?php endif; ?>

    <!-- Reseña Personal -->
    <div class="row">
        <div class="col s3"></div>
        <div class="col s3">Reseña Personal:</div>
        <div class="col s3">
            <input type="text" name="resena_personal" id="resena_personal" placeholder="Comentarios de la obra" value="<?= isset($lib) ? $lib->resena_personal :  $_SESSION['data']['resena_personal']; ?>">
        </div>
        <div class="col s3"></div>
    </div>

    <div class="row">
        <div class="col s3"></div>
        <div class="col s3"><a href="index.php" class="waves-effect waves-light btn-small">Cancelar</a></div>
        <div class="col s3">
            <input type="submit" name="btn_guardar" id="btn_guardar" class="btn #00695c teal darken-3 z-depth" value="Guardar Registro">
        </div>
        <div class="col s3"></div>
    </div>

    <input type="hidden" name="id_libro" id="id_libro" value="<?= isset($lib) ? $lib->id_libro :  $_SESSION['data']['id_libroe']; ?>">
    <input type="hidden" name="email_usuario" id="email_usuario" value="<?= isset($lib) ? $lib->email_usuario :  $_SESSION['data']['email_usuario']; ?>">
</form>


<script>
    // JavaScript para mostrar el nombre del archivo seleccionado
    document.getElementById('imagen_portada').addEventListener('change', function() {
        // Obtener el nombre del archivo seleccionado
        var filePath = this.value.split('\\');

        // Actualizar el campo de texto con el nombre del archivo
        document.getElementById('file-path').value = filePath[filePath.length - 1];
    });
</script>