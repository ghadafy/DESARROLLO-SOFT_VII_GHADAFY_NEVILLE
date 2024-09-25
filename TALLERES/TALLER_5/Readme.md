Uso del Sistema

Para usar el sistema, sigue estos pasos:

1. Abre el archivo `proyecto_final.php` en tu entorno de desarrollo.
2. Asegúrate de que el script está correctamente ubicado en tu servidor local.
3. Accede al script a través de tu navegador, por ejemplo, `http://localhost/proyecto_final.php`.
4. Observa cómo se ejecutan las funcionalidades principales del sistema, demostradas en la sección de pruebas del script.

Funcionalidades 

El sistema incluye las siguientes funcionalidades:

Clase `Estudiante`
- **Constructor:** Inicializa los atributos `id`, `nombre`, `edad`, `carrera` y un arreglo de `materias` con sus respectivas calificaciones.
- **`agregarMateria($materia, $calificacion):`** Añade una materia y su calificación al estudiante.
- **`obtenerPromedio():`** Calcula y retorna el promedio de calificaciones del estudiante.
- **`obtenerDetalles():`** Retorna un arreglo asociativo con toda la información del estudiante.
- **`__toString():`** Proporciona una representación textual del estudiante para facilitar la impresión.

### Clase `SistemaGestionEstudiantes`
- **`agregarEstudiante($estudiante):`** Añade un nuevo estudiante al sistema.
- **`obtenerEstudiante($id):`** Obtiene un estudiante por su ID.
- **`listarEstudiantes():`** Lista todos los estudiantes registrados.
- **`calcularPromedioGeneral():`** Calcula el promedio de calificaciones de todos los estudiantes.
- **`obtenerEstudiantesPorCarrera($carrera):`** Retorna los estudiantes de una carrera específica.
- **`obtenerMejorEstudiante():`** Encuentra y retorna el estudiante con el promedio más alto.
- **`generarReporteRendimiento():`** Genera un reporte con el promedio, la calificación más alta y la más baja por materia.
- **`graduarEstudiante($id):`** Gradúa un estudiante, eliminándolo del sistema y guardándolo en un arreglo de graduados.
- **`generarRanking():`** Ordena los estudiantes por su promedio y genera un ranking.
- **`buscarEstudiantes($termino):`** Permite buscar estudiantes por nombre o carrera, incluyendo búsquedas parciales.
- **`generarEstadisticasPorCarrera():`** Genera estadísticas detalladas por carrera, incluyendo el número de estudiantes, el promedio general y el mejor estudiante.

## Prueba y Ejecución

La sección de prueba en el archivo `proyecto_final.php` crea una instancia del sistema, añade estudiantes y demuestra el uso de todas las funcionalidades implementadas. Puedes modificar o ampliar esta sección para personalizar el comportamiento del sistema.


