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
        $this->entradas = [];
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



    public function agregarEntrada($entrada)
    {

        $datos1 = [
            'id' => $this->obtenerProximoId(),
            'fecha_creacion' => date('Y-m-d'),
            'tipo' => intVal($entrada['tipo'])
        ];


        if ($entrada['tipo'] == 1) {
            $datos2 = [
                'titulo' => $entrada['titulo'],
                'descripcion' => $entrada['descripcion']
            ];
        } elseif ($entrada['tipo'] == 2) {
            $datos2 = [
                'titulo1' => $entrada['titulo1'],
                'descripcion1' => $entrada['descripcion1'],
                'titulo2' => $entrada['titulo2'],
                'descripcion2' => $entrada['descripcion2']
            ];
        } elseif ($entrada['tipo'] == 3) {
            $datos2 = [
                'titulo1' => $entrada['titulo1'],
                'descripcion1' => $entrada['descripcion1'],
                'titulo2' => $entrada['titulo2'],
                'descripcion2' => $entrada['descripcion2'],
                'titulo3' => $entrada['titulo3'],
                'descripcion3' => $entrada['descripcion3']
            ];
        }

        $this->entradas = $this->cargardatos();
        $this->entradas[] = array_merge($datos1, $datos2);

        file_put_contents('blog.json', json_encode($this->entradas, JSON_PRETTY_PRINT));

        $this->cargarEntradas();
    }




    public function editarEntrada($entrada_modificada)
    {

        $entrada = (object)$entrada_modificada;

        $id = $entrada->id;  //obtengo el id de la entrada a editar

        //busco la entrada en el arreglo y remplazo el json
        $entradas = $this->entradas;
        foreach ($entradas as $ent => $valor) {
            if ($valor->id == $id) {

                if ($entrada->tipo == 1) {

                    $valor->titulo = $entrada->titulo;
                    $valor->descripcion = $entrada->descripcion;
                } elseif ($entrada->tipo == 2) {
                    $valor->titulo1 = $entrada->titulo1;
                    $valor->descripcion1 = $entrada->descripcion1;
                    $valor->titulo2 = $entrada->titulo2;
                    $valor->descripcion2 = $entrada->descripcion2;
                } elseif ($entrada->tipo == 3) {
                    $valor->titulo1 = $entrada->titulo1;
                    $valor->descripcion1 = $entrada->descripcion1;
                    $valor->titulo2 = $entrada->titulo2;
                    $valor->descripcion2 = $entrada->descripcion2;
                    $valor->titulo3 = $entrada->titulo3;
                    $valor->descripcion3 = $entrada->descripcion3;
                }
            }
        }

        file_put_contents('blog.json', json_encode($entradas, JSON_PRETTY_PRINT));
    }



    public function editarIdEntrada($id, $nuevoId, $entrada)
    {

        $entrada = (object)$entrada;

        $id = $entrada->id;  //obtengo el id de la entrada a editar

        //busco la entrada en el arreglo y remplazo el json
        $entradas = $this->entradas;
        foreach ($entradas as $ent => $valor) {
            if ($valor->id == $id) {
                $valor->id = intval($nuevoId);
            }
        }

        file_put_contents('blog.json', json_encode($entradas, JSON_PRETTY_PRINT));
    }



    public function eliminarEntrada($id)
    {
        $id = $id;

        $entradas = $this->obtenerEntradas();

        foreach ($entradas as $indice => $valor) {
            if ($valor->id == $id) {
                unset($entradas[$indice]);
            }
        }

        file_put_contents('blog.json', json_encode($entradas, JSON_PRETTY_PRINT));
        $this->cargarEntradas();
    }


    public function obtenerEntrada($id)
    {
        if ($id) {
            $entradas = $this->entradas;
            foreach ($entradas as $entrada) {
                if ($entrada->id == $id) {
                    return $entrada;
                }
            }
        }
    }


    public function moverEntrada($id, $direccion)
    {


        //ahora verifico si el movimiento es hacia arriba o abajo
        switch ($direccion) {

            case 'move_down': //Si es hacia abajo

                $nuevoId1 = $id + 1;
                $idTemporal = $this->obtenerProximoId();

                //Aqui bsuco las entradas afectadas y les modifico su id
                $entrada2 = $this->obtenerEntrada($nuevoId1);
                $this->editarIdEntrada($nuevoId1,  $idTemporal, $entrada2);

                $entrada1 = $this->obtenerEntrada($id);
                $this->editarIdEntrada($id, $nuevoId1, $entrada1);

                $entrada2 = $this->obtenerEntrada($idTemporal);
                $this->editarIdEntrada($idTemporal,  $id, $entrada2);

                $this->cargarEntradas();  //aqui actualizamos la pantalla despues del cambio

                break;

            case 'move_up':  //Si es hacia arriba
                $nuevoId1 = $id - 1;
                $idTemporal = $this->obtenerProximoId();

                //Aqui bsuco las entradas afectadas y les modifico su id
                $entrada2 = $this->obtenerEntrada($nuevoId1);
                $this->editarIdEntrada($nuevoId1,  $idTemporal, $entrada2);

                $entrada1 = $this->obtenerEntrada($id);
                $this->editarIdEntrada($id, $nuevoId1, $entrada1);

                $entrada2 = $this->obtenerEntrada($idTemporal);
                $this->editarIdEntrada($idTemporal,  $id, $entrada2);

                $this->cargarEntradas();  //aqui actualizamos la pantalla despues del cambio

                break;
        }
    }
}
