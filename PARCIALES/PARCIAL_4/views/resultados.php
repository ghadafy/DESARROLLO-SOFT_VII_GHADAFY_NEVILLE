<h5>Resultados de la búsqueda</h5>

<form action="?c=buscarLibros" method="post">
    <input type="text" name="termino" placeholder="Buscar libro..." required>
    <button type="submit" class="btn btn #00695c teal darken-3 rigth-align ">Buscar</button>
</form>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Imagen</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($libros) && !empty($libros)) : ?>
            <?php
            $cont = 1;
            foreach ($libros as $libro) : ?>
                <tr>
                    <td><?= $cont++; ?> - </td>
                    <td><?= $libro['volumeInfo']['title'] ?></td>
                    <td><?= $libro['volumeInfo']['authors'][0] ?? 'Desconocido' ?></td>
                    <td>
                        <img src="<?= $libro['volumeInfo']['imageLinks']['thumbnail'] ?? 'default_image.jpg' ?>" alt="Imagen del libro" style="width: 50px;">
                    </td>
                    <td>
                        <form action="?c=guardarLibroApi" method="post">
                            <input type="hidden" name="id_libro_google" value="<?= $libro['id'] ?>">
                            <input type="hidden" name="titulo" value="<?= $libro['volumeInfo']['title'] ?>">
                            <input type="hidden" name="autor" value="<?= $libro['volumeInfo']['authors'][0] ?? 'Desconocido' ?>">
                            <input type="hidden" name="imagen_portada" value="<?= $libro['volumeInfo']['imageLinks']['thumbnail'] ?? 'default_image.jpg' ?>">

                            <button type="submit" class="btn btn #00695c teal darken-3 rigth-align ">Guardar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4">No se encontraron libros.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>