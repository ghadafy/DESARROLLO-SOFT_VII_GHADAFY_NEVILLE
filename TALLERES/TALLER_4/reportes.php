<?php
$paginaActual = 'reportes';
require_once 'HELPERS/funciones.php';
$tituloPagina = obtenerTituloPagina($titulo, $paginaActual);
include 'encabezado.php';

$filtroDepto = 0;
$filtroCargo = 0;


if (isset($_POST['form_filtrar']) && $_POST['form_filtrar'] == 'filtrar' && $_POST['tipo'] == 1) {

    $filtroDepto = $_POST['departamento'];
}


if (isset($_POST['form_filtrar']) && $_POST['form_filtrar'] == 'filtrar' && $_POST['tipo'] == 2) {

    $filtroCargo = $_POST['cargo'];
}

?>


<form action="" method="post" class="seleccion">
    <fieldset>
        <legend class="legend">LISTAR POR DEPARTAMENTO O CARGO</legend>


        <div>
            <input type="radio" id="radioDepto" name="tipo" value=1 />
            <label for="tipo">DEPARTAMENTO</label>
        </div>

        <div>
            <input type="radio" id="radioCargo" name="tipo" value=2 />
            <label for="tipo">CARGO</label>
        </div>





        <select name="departamento" id="casillaDepto" style="display: none;">
            <option>SELECCIONE EL DEPARTAMENTO</option>
            <?php
            $deptos = json_decode($departamentos, true);

            foreach ($deptos as $dep) { ?>
            <?php echo "<option value='" . $dep['id'] . "'>" . $dep["nombre"] . "</option>";
            }
            ?>
        </select>




        <select name="cargo" id="casillaCargo" style="display: none;">
            <option>SELECCIONE EL CARGO</option>
            <?php
            $datos = json_decode($cargos, true);

            foreach ($datos as $cargo) { ?>
            <?php echo "<option value='" . $cargo['id'] . "'>" . $cargo["cargo"] . "</option>";
            }
            ?>
        </select>


        <input type="submit" class="button" value="FILTRAR">

        <input type="hidden" name="form_filtrar" id="form_filtrar" value="filtrar">

</form>


<?php
if ($filtroDepto != 0) {
    verContenidoFiltrado($filtroDepto);
}

if ($filtroCargo != 0) {
    verContenidoFiltradoCargo($filtroCargo);
}



?>



<script src="HELPERS/ocultarSeleccion.js"></script>
<?php
include 'pie_pagina.php';
?>