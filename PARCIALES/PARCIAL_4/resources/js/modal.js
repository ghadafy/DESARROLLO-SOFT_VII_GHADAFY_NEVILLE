// Cuando la página esté completamente cargada
document.addEventListener('DOMContentLoaded', function () {
    // Inicializar el modal de Materialize
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);

    // Función para mostrar la imagen grande cuando se haga clic en la imagen pequeña
    const showcaseImages = document.querySelectorAll('.showcase-image');
    showcaseImages.forEach(function (image) {
        image.addEventListener('click', function () {
            // Obtener la ruta de la imagen grande desde el atributo data-large-img
            const largeImgSrc = image.getAttribute('data-large-img');
            // Establecer la fuente de la imagen grande en el modal
            document.getElementById('modal-img').src = largeImgSrc;
            // Abrir el modal
            instances[0].open();
        });
    });
});
