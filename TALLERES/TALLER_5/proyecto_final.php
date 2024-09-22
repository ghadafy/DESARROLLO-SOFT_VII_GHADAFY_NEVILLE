<?php

// Clase Estudiante
class Estudiante
{
    private int $id;
    private string $nombre;
    private int $edad;
    private string $carrera;
    private array $materias = [];

    // Constructor 
    public function __construct($id, $nombre, $edad, $carrera)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->carrera = $carrera;
    }

    // Método para añadir una materia y su calificación
    public function agregarMateria($materia, $calificacion)
    {
        $this->materias[$materia] = $calificacion;
    }

    // Método para calcular y retornar el promedio de calificaciones
    public function obtenerPromedio()
    {
        if (empty($this->materias)) {
            return 0;
        }
        return array_sum($this->materias) / count($this->materias);
    }

    // Método para retornar un arreglo asociativo con toda la información del estudiante
    public function obtenerDetalles()
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'carrera' => $this->carrera,
            'materias' => $this->materias,
            'promedio' => $this->obtenerPromedio()
        ];
    }

    // Método __toString() para facilitar la impresión de información
    public function __toString(): string
    {
        return "{$this->nombre}, Carrera: {$this->carrera}, Promedio: " . number_format($this->obtenerPromedio(), 2);
    }
}

// Clase SistemaGestionEstudiantes
class SistemaGestionEstudiantes
{
    private array $estudiantes = [];
    private array $graduados = [];

    // Método para añadir un nuevo estudiante al sistema
    public function agregarEstudiante(Estudiante $estudiante)
    {
        $this->estudiantes[$estudiante->obtenerDetalles()['id']] = $estudiante;
    }

    // Método para obtener un estudiante por su ID
    public function obtenerEstudiante($id): ?Estudiante
    {
        return $this->estudiantes[$id] ?? null;
    }

    // Método para listar todos los estudiantes
    public function listarEstudiantes()
    {
        return $this->estudiantes;
    }

    // Método para calcular el promedio general de todos los estudiantes
    public function calcularPromedioGeneral()
    {
        if (empty($this->estudiantes)) {
            return 0;
        }
        $promedios = array_map(fn ($est) => $est->obtenerPromedio(), $this->estudiantes);
        return array_sum($promedios) / count($promedios);
    }

    // Método para obtener estudiantes de una carrera específica
    public function obtenerEstudiantesPorCarrera($carrera)
    {
        return array_filter($this->estudiantes, fn ($est) => $est->obtenerDetalles()['carrera'] == $carrera);
    }

    // Método para obtener el estudiante con el promedio más alto
    public function obtenerMejorEstudiante(): ?Estudiante
    {
        if (empty($this->estudiantes)) {
            return null;
        }
        return array_reduce($this->estudiantes, function ($mejor, $est) {
            return ($mejor === null || $est->obtenerPromedio() > $mejor->obtenerPromedio()) ? $est : $mejor;
        });
    }

    // Método para generar un reporte de rendimiento
    public function generarReporteRendimiento()
    {
        $materiasReporte = [];
        foreach ($this->estudiantes as $estudiante) {
            foreach ($estudiante->obtenerDetalles()['materias'] as $materia => $calificacion) {
                if (!isset($materiasReporte[$materia])) {
                    $materiasReporte[$materia] = ['total' => 0, 'count' => 0, 'max' => $calificacion, 'min' => $calificacion];
                }
                $materiasReporte[$materia]['total'] += $calificacion;
                $materiasReporte[$materia]['count']++;
                $materiasReporte[$materia]['max'] = max($materiasReporte[$materia]['max'], $calificacion);
                $materiasReporte[$materia]['min'] = min($materiasReporte[$materia]['min'], $calificacion);
            }
        }
        foreach ($materiasReporte as $materia => $data) {
            $data['promedio'] = $data['total'] / $data['count'];
        }
        return $materiasReporte;
    }

    // Método para graduar a un estudiante y eliminarlo del sistema
    public function graduarEstudiante($id)
    {
        if (isset($this->estudiantes[$id])) {
            $this->graduados[$id] = $this->estudiantes[$id];
            unset($this->estudiantes[$id]);
        }
    }

    // Método para generar el ranking de estudiantes por su promedio
    public function generarRanking()
    {
        usort($this->estudiantes, fn ($a, $b) => $b->obtenerPromedio() <=> $a->obtenerPromedio());
        return $this->estudiantes;
    }

    // Método para buscar estudiantes por nombre o carrera
    public function buscarEstudiantes($termino)
    {
        return array_filter($this->estudiantes, function ($est) use ($termino) {
            $detalles = $est->obtenerDetalles();
            return stripos($detalles['nombre'], $termino) !== false || stripos($detalles['carrera'], $termino) !== false;
        });
    }

    // Método para generar estadísticas por carrera
    public function generarEstadisticasPorCarrera()
    {
        $estadisticas = [];
        foreach ($this->estudiantes as $estudiante) {
            $carrera = $estudiante->obtenerDetalles()['carrera'];
            if (!isset($estadisticas[$carrera])) {
                $estadisticas[$carrera] = ['count' => 0, 'totalPromedio' => 0, 'mejorEstudiante' => null];
            }
            $estadisticas[$carrera]['count']++;
            $estadisticas[$carrera]['totalPromedio'] += $estudiante->obtenerPromedio();
            if ($estadisticas[$carrera]['mejorEstudiante'] === null || $estudiante->obtenerPromedio() > $estadisticas[$carrera]['mejorEstudiante']->obtenerPromedio()) {
                $estadisticas[$carrera]['mejorEstudiante'] = $estudiante;
            }
        }
        foreach ($estadisticas as &$data) {
            $data['promedioGeneral'] = $data['totalPromedio'] / $data['count'];
        }
        return $estadisticas;
    }
}

// Sección de prueba
$sistema = new SistemaGestionEstudiantes();

// Creación de estudiantes y adición de materias y calificaciones
$estudiantes = [
    new Estudiante(1, "Ana Pérez", 20, "Ingeniería"),
    new Estudiante(2, "Carlos Gómez", 22, "Medicina"),
    new Estudiante(3, "Lucía Sánchez", 21, "Ingeniería"),
    new Estudiante(4, "Pedro Martínez", 19, "Derecho"),
    new Estudiante(5, "Sofía Hernández", 23, "Medicina"),
    new Estudiante(6, "Javier López", 24, "Derecho"),
    new Estudiante(7, "Marta Díaz", 18, "Ingeniería"),
    new Estudiante(8, "Luis Fernández", 20, "Derecho"),
    new Estudiante(9, "Elena Ruiz", 22, "Medicina"),
    new Estudiante(10, "Gabriel Rodríguez", 21, "Ingeniería"),
];

// Añadir materias a los estudiantes
$estudiantes[0]->agregarMateria("Matemáticas", 90);
$estudiantes[0]->agregarMateria("Física", 85);
$estudiantes[1]->agregarMateria("Biología", 88);
$estudiantes[1]->agregarMateria("Química", 92);
$estudiantes[2]->agregarMateria("Matemáticas", 78);
$estudiantes[2]->agregarMateria("Programación", 84);
$estudiantes[3]->agregarMateria("Derecho Penal", 95);
$estudiantes[3]->agregarMateria("Derecho Civil", 88);
$estudiantes[4]->agregarMateria("Anatomía", 74);
$estudiantes[4]->agregarMateria("Fisiología", 80);
$estudiantes[5]->agregarMateria("Derecho Constitucional", 89);
$estudiantes[5]->agregarMateria("Derecho Administrativo", 93);
$estudiantes[6]->agregarMateria("Matemáticas", 67);
$estudiantes[6]->agregarMateria("Química", 72);
$estudiantes[7]->agregarMateria("Historia", 76);
$estudiantes[7]->agregarMateria("Derecho Procesal", 70);
$estudiantes[8]->agregarMateria("Bioquímica", 81);
$estudiantes[8]->agregarMateria("Farmacología", 83);
$estudiantes[9]->agregarMateria("Electrónica", 94);
$estudiantes[9]->agregarMateria("Cálculo", 96);

// Añadir los estudiantes al sistema
foreach ($estudiantes as $estudiante) {
    $sistema->agregarEstudiante($estudiante);
}

// Demostración de funcionalidades
echo "<b>Lista de estudiantes:</b><br>";
foreach ($sistema->listarEstudiantes()  as $estudiante => $valor) {
    echo $valor . "<br>";
}


echo "<br><b>Promedio general de todos los estudiantes:</b> ";
echo number_format($sistema->calcularPromedioGeneral(), 2) . "<br>";


echo "<br><b>Estudiantes de la carrera de Ingeniería:</b><br>";
foreach ($sistema->obtenerEstudiantesPorCarrera("Ingeniería") as $est => $nombre) {
    echo $nombre . "<br>";
}

echo "<br><b>Mejor estudiante del sistema:</b><br>";
echo $sistema->obtenerMejorEstudiante() . "<br>";


echo "<br><b>Reporte de rendimiento por materias:</b><br>";
foreach ($sistema->generarReporteRendimiento() as $mat => $rendimiento) {
    echo $mat . " => " . implode(" - ", $rendimiento) . "<br>";
}

echo "<br><b>Graduando al estudiante con ID 1...</b><br>";
$sistema->graduarEstudiante(1);
foreach ($sistema->listarEstudiantes()  as $estudiante => $valor) {
    echo $valor . "<br>";
}

echo "<br><b>Ranking de estudiantes por promedio:</b><br>";
foreach ($sistema->generarRanking() as $ests) {
    echo $ests . "<br>";
}


echo "<br><b>Búsqueda de estudiantes por 'Derecho':</b><br>";
foreach ($sistema->buscarEstudiantes("Derecho") as $est) {
    echo $est . "<br>";
}


echo "<br>Estadísticas por carrera:<br>";
foreach ($sistema->generarEstadisticasPorCarrera() as $carrera => $estad) {
    echo "<br><b>$carrera</b><br>";
    foreach ($estad as $valor => $dato) {
        if ($valor === "count") {
            echo "*  <b>Cantidad de Estudiantes</b>: " . $dato . "<br>";
        } elseif ($valor === "mejorEstudiante") {
            echo "*  <b>Mejor Estudiante</b>: " . $dato . "<br>";
        } elseif ($valor === "promedioGeneral") {
            echo "*  <b>Promedio General</b>: " . number_format($dato, 2) . "<br>";
        }
        /*
totalPromedio => 255.5
mejorEstudiante => Pedro Martínez, Carrera: Derecho, Promedio: 91.50
promedioGeneral => 85.166666666667
*/
    }
}
