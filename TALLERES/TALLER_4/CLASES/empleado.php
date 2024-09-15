<?php

class Empleado
{

    private int $id = 1;
    private $nombre;
    private $salarioBase;
    private $departamento;
    private $cargo;
    private $evaluacion = 0;

    public function __construct($id, $nombre, $salarioBase, $departamento, $cargo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->salarioBase = $salarioBase;
        $this->departamento = $departamento;
        $this->cargo = $cargo;
    }


    //Geters
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getSalarioBase()
    {
        return $this->salarioBase;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function getEvaluacion()
    {
        return $this->evaluacion;
    }



    //Seters
    public function setId($idEmpleado)
    {
        $this->id = $idEmpleado;
    }

    public function setNombre($nombreEmpleado)
    {
        $this->nombre = trim($nombreEmpleado);
    }

    public function setSalarioBase($salario)
    {
        $this->salarioBase = $salario;
    }

    public function setDepartamento($depto)
    {
        $this->departamento = $depto;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    public function setEvaluacion($evaluacion)
    {
        $this->evaluacion = $evaluacion;
    }

    public function getInformacionEmpleado()
    {
        return "Código de Empleado: {$this->getId()}, <br>Nombre de Empleado: {$this->getNombre()}, <br>Salario: B/. {$this->getSalarioBase()}";
    }
}

//$empleado = new Empleado(4, "Ghadafy Neville", 2500.20, 1, 1);
//echo $empleado->getInformacionEmpleado();
