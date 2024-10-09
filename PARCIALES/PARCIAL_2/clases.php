<?php

interface Detalle
{
    public function obtenerDetallesEpecificos(): string;
}


abstract class Entrada implements Detalle
{
    public $id;
    public $fecha_creacion;
    public $tipo;

    public function __construct($datos = [])
    {
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}


class EntradaUnaColumna extends Entrada
{
    public $titulo;
    public $descripcion;

    public function obtenerDetallesEpecificos(): string
    {
        return "Entrada de una columna: [$this->titulo]";
    }
}


class EntradaDosColumnas extends Entrada
{
    public $titulo1;
    public $descripcion1;
    public $titulo2;
    public $descripcion2;

    public function obtenerDetallesEpecificos(): string
    {
        return "Entrada de una columna: [$this->titulo1] | [$this->titulo2]";
    }
}


class EntradaTresColumnas extends Entrada
{
    public $titulo1;
    public $descripcion1;
    public $titulo2;
    public $descripcion2;
    public $titulo3;
    public $descripcion3;

    public function obtenerDetallesEpecificos(): string
    {
        return "Entrada de una columna: [$this->titulo1] | [$this->titulo2] | [$this->titulo3]";
    }
}


class GestorBlog
{
    private $entradas = [];

    public function cargarEntradas()
    {
        if (file_exists('blog.json')) {
            $json = file_get_contents('blog.json');
            $data = json_decode($json, true);
            foreach ($data as $entradaData) {
                switch ($entradaData['tipo']) {
                    case 1:
                        $this->entradas[] = new EntradaUnaColumna($entradaData);
                        break;
                    case 2:
                        $this->entradas[] = new EntradaDosColumnas($entradaData);
                        break;
                    case 3:
                        $this->entradas[] = new EntradaTresColumnas($entradaData);
                        break;
                }
            }
        }
    }



    public function cargardatos()
    {
        $json = file_get_contents('blog.json');
        $data = json_decode($json, true);
        return  $data;
    }


    public function guardarEntradas()
    {
        $data = array_map(function ($entrada) {
            return get_object_vars($entrada);
        }, $this->entradas);
        file_put_contents('blog.json', json_encode($data, JSON_PRETTY_PRINT));
    }




    public function obtenerEntradas()
    {
        return $this->entradas;
    }




    public function obtenerProximoId()
    {
        $indice = 0;
        $entradas = $this->cargardatos();
        foreach ($entradas as $ent) {
            if ($ent['id'] > $indice) {
                $indice = $ent['id'];
            }
        }
        return  $indice + 1;
    }



    public function agregarEntrada($entrada)
    {

        $datos1 = [
            'id' => $this->obtenerProximoId(),
            'fecha_creacion' => date('Y-m-d'),
            'tipo' => $entrada['tipo']
        ];


        if ($entrada['tipo'] == 1) {
            $datos2 = [
                'titulo' => $entrada->titulo,
                'descripcion' => $entrada->descripcion
            ];
        } elseif ($entrada['tipo'] == 2) {
            $datos2 = [
                'titulo1' => $entrada->titulo1,
                'descripcion1' => $entrada->descripcion1,
                'titulo2' => $entrada->titulo2,
                'descripcion2' => $entrada->descripcion2
            ];
        } elseif ($entrada['tipo'] == 3) {
            $datos2 = [
                'titulo1' => $entrada->titulo1,
                'descripcion1' => $entrada->descripcion1,
                'titulo2' => $entrada->titulo2,
                'descripcion2' => $entrada->descripcion2,
                'titulo3' => $entrada->titulo3,
                'descripcion3' => $entrada->descripcion3

            ];
        }



        $this->entradas[] = array_merge($datos1, $datos2);
        /*
        echo  '<pre>';
        var_dump($this->entradas);
        echo '</pre>';

*/
        // $this->guardarEntradas();
    }



    public function editarEntrada($entrada)
    {
    }

    public function eliminarEntrada($id)
    {
    }

    public function obtenerEntrada($id)
    {
    }
    public function moverEntrada($id, $direccion)
    {
    }
}
