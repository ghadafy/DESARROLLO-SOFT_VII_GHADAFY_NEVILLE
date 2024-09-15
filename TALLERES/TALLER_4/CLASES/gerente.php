<?php

require_once 'evaluable.php';
require_once 'empleado.php';

class Gerente extends Empleado implements Evaluable
{

    private $logroMetas = false;
    private $bono = 0;


    public function __construct($id, $nombre, $salarioBase, $departamento, $cargo, $bono)
    {
        parent::__construct($id, $nombre, $salarioBase, $departamento, $cargo);
        $this->bono = $bono;
    }


    // Geters

    public function getBono()
    {
        return $this->bono;
    }


    public function getLogroMetas()
    {
        return $this->logroMetas;
    }





    // Seters

    public function asignarBono($bono)
    {
        $this->bono = $bono;
    }


    public function setMetas($calificacion)
    {
        if (strtolower($calificacion) == "s") {
            $this->logroMetas = true;
        } else {
            $this->logroMetas = false;
        }
    }


    public function getEmpleado()
    {
        $info  = "<br/>------------------------------------------------<br/>";
        $info .= "Datos del Empleado:<br/>";
        $info .= "------------------------------------------------<br/>";
        $info .= "Nombre: <b>{$this->getNombre()}</b><br/>";
        $info .= "Departamento: <b>{$this->getDepartamento()}</b><br/>";
        $info .= "Salario: <b>" . number_format($this->getSalarioBase(), 2) . "</b><br/>";
        $info .= "Bono por desempeño: <b>" . number_format($this->getBono(), 2) . "</b><br/>";
        $info .= "------------------------------------------------<br/>";
        return $info;
    }


    public function evaluarDesempenio()
    {

        if ($this->logroMetas) {
            $aumentoSalario = $this->getSalarioBase() * 0.30;
            $this->setSalarioBase($aumentoSalario + $this->getSalarioBase());
            $this->asignarBono($this->getSalarioBase() * 0.50);
        }
    }
}

/*
$emp = new Gerente(6, "Abkhir A. Neville G.", 3500.75, "Informática", 0);
echo $emp->getEmpleado();
$emp->setMetas("s");
$emp->evaluarDesempenio();
echo $emp->getEmpleado();
*/