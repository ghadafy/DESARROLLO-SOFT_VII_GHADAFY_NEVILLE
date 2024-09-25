<?php

require_once "detalles.php";

class Tarea
{
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;
    public $lenguajeProgramacion;
    public $herramientaDiseno;
    public $tipoTest;


    public function __construct($datos)
    {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }

    // Implementar estos getters
    // public function getEstado() { }
    // public function getPrioridad() { }

    public function getEstado()
    {
        return  $this->estado;
    }

    public function getPrioridad()
    {
        return   $this->prioridad;
    }
}



class GestorTareas
{
    public $archivo = 'tareas.json';



    public function cargarTareas()

    /*
    clase GestorTareas para que cree instancias de las clases hijas correspondientes al cargar las tareas desde el archivo JSON
    */
    {
        if (file_exists($this->archivo)) {
            $contenido = file_get_contents($this->archivo);
            $data = json_decode($contenido, true);
            $tareas = [];
            foreach ($data as $item) {
                switch ($item['tipo']) {
                    case 'desarrollo':
                        $tareas[] = new TareaDesarrollo($item);
                        break;
                    case 'diseno':
                        $tareas[] = new TareaDiseno($item);
                        break;
                    case 'testing':
                        $tareas[] = new TareaTesting($item);
                        break;
                    default:
                        $tareas[] = new Tarea($item);
                        break;
                }
            }
            return $tareas;
        }
        return [];
    }



    public function guardarTareas($tareas)
    {
        //guardamos los datos en el archivo json
        file_put_contents($this->archivo, json_encode($tareas, JSON_PRETTY_PRINT));
    }



    public function agregarTarea($nuevaTarea)
    {
        $tareas = $this->cargarTareas();
        $nuevaTarea->id = count($tareas) + 1;
        $tareas[] = $nuevaTarea;
        $this->guardarTareas($tareas);
    }



    public function editarTarea($id, $tareaEditada)
    {
        $tareas = $this->cargarTareas();
        foreach ($tareas as $key => $tarea) {
            if ($tarea->id == $id) {
                $tareaEditada->id = $id;
                $tareas[$key] = $tareaEditada;
                break;
            }
        }
        $this->guardarTareas($tareas);
    }




    public function eliminarTarea($id)
    {
        $tareas = $this->cargarTareas();
        foreach ($tareas as $key => $tarea) {
            if ($tarea->id == $id) {
                unset($tareas[$key]);
                break;
            }
        }
        $this->guardarTareas(array_values($tareas));
    }



    public function cambiarEstado($id, $nuevoEstado)
    {
        $tareas = $this->cargarTareas();
        foreach ($tareas as $tarea) {
            if ($tarea->id == $id) {
                $tarea->estado = $nuevoEstado;
                break;
            }
        }
        $this->guardarTareas($tareas);
    }


    public function buscarTareaPorId($id)
    {
        $tareas = $this->cargarTareas();
        foreach ($tareas as $tarea) {
            if ($tarea->id == $id) {
                return $tarea;
            }
        }
        return null;
    }



    public function filtrarTareasPorEstado($estado)
    {
        $tareas = $this->cargarTareas();
        if ($estado) {
            return array_filter($tareas, function ($tarea) use ($estado) {
                return $tarea->estado === $estado;
            });
        }
        return $tareas;
    }




    public function ordenarTareas($field, $direction)
    {
        $tareas = $this->cargarTareas();
        usort($tareas, function ($a, $b) use ($field, $direction) {
            $valueA = $a->{$field};
            $valueB = $b->{$field};
            return $direction === 'ASC' ? strcmp($valueA, $valueB) : strcmp($valueB, $valueA);
        });
        return $tareas;
    }
}



class TareaDesarrollo extends Tarea implements Detalle
{
    public $lenguajeProgramacion;

    // constructor
    public function __construct($datos)
    {
        parent::__construct($datos); //constructor padre
    }

    public function obtenerDetallesEspecificos(): string
    {
        return "Lenguaje de programación: " . $this->lenguajeProgramacion;
    }
}



class TareaDiseno extends Tarea implements Detalle
{
    public $herramientaDiseno;

    //constructor 
    public function __construct($datos)
    {
        parent::__construct($datos); //constructor padre
    }

    public function obtenerDetallesEspecificos(): string
    {
        return "Herramienta de diseño: " . $this->herramientaDiseno;
    }
}



class TareaTesting extends Tarea implements Detalle
{
    public $tipoTest;

    //constructor 
    public function __construct($datos)
    {
        parent::__construct($datos); // constructor padre
    }

    public function obtenerDetallesEspecificos(): string
    {
        return "Tipo de test: " . $this->tipoTest;
    }
}
