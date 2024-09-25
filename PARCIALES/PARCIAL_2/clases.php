<?php
require_once 'detalles.php';
// Archivo: clases.php

class Tarea implements Detalles
{
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;

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
        return $this->estado;
    }


    public function getPrioridad()
    {
        return $this->prioridad;
    }

    public function obtenerDetallesEspecificos()
    {
        return "El tipo de prueba que se realiza es: ";
    }
}

class GestorTareas
{
    private $tareas = [];

    public function cargarTareas()
    {
        $json = file_get_contents('tareas.json');
        $data = json_decode($json, true);
        foreach ($data as $tareaData) {
            $tarea = new Tarea($tareaData);
            $this->tareas[] = $tarea;
        }

        return $this->tareas;
    }

    public function agregarTarea($tarea)
    {
        $this->tareas += $tarea;
    }


    public function eliminarTarea($id)
    {
        $this->tareas[$id];
    }

    public function actualizarTarea($tarea)
    {
        $this->tareas = $tarea;
    }

    public function actualizarEstadoTarea($id, $nuevoEstado)
    {
        $this->tareas[$id];
    }

    public function buscarTareasPorEstado($estado)
    {
        return $this->tareas;
    }

    public function listarTareas($filtroEstado = '')
    {
        return $this->tareas;
    }
}

$gestionar = new GestorTareas();


// Implementar:
// 1. La interfaz Detalle

// 2. Modificar la clase Tarea para implementar la interfaz Detalle  LISTO

// 3. Las clases TareaDesarrollo, TareaDiseno y TareaTesting que hereden de Tarea
class TareaDesarrollo extends Tarea
{
    public $lenguajeProgramacion;

    public function obtenerDetallesEspecificos()
    {
        return "El lenguaje de programacion utilizado es " . $this->lenguajeProgramacion;
    }
}

class TareaDiseno extends Tarea
{
    public $herramientaDiseno;

    public function obtenerDetallesEspecificos()
    {
        return "La herramienta de desarrollo utilizada es " . $this->herramientaDiseno;
    }
}

class TareaTesting extends Tarea
{
    public $tipoTest;

    public function obtenerDetallesEspecificos()
    {
        return "El tipo de prueba que se realiza es: " . $this->tipoTest;
    }
}
