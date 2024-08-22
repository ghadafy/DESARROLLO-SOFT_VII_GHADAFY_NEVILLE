<?php 
require_once 'includes/funciones.php';
require_once 'includes/header.php';
?>


<h2>Lista de libros disponibles: </h2>

<?php 
$libs = obtenerLibros();
echo "<ul>";
foreach($libs as $lib){
     
    echo "<li><b>".$lib['titulo']."</b></li>";
    echo "<p>".mostrarDetalles($lib['titulo'])."</p>"; 
    
}
echo "</ul>";

?>




<?php 
require_once 'includes/footer.php';
?>