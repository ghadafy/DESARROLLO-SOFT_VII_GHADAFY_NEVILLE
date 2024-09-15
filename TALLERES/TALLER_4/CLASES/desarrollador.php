<?php
require_once 'empleado.php';
require_once 'evaluable.php';

class Desarrollador extends Empleado implements evaluable
{

    private $lenguaje;
    private $evaluacion = 0;
    private $anios_experiencia = 0;



    public function __construct($id, $nombre, $salarioBase, $departamento, $cargo, $lenguaje, $anios_experiencia)
    {
        parent::__construct($id, $nombre, $salarioBase, $departamento, $cargo,);
        $this->lenguaje = $lenguaje;
        $this->anios_experiencia = $anios_experiencia;
    }



    //geters
    public function getLenguaje()
    {
        return $this->lenguaje;
    }


    public function getAnios_experiencia()
    {
        return $this->anios_experiencia;
    }




    //Seters
    public function setLenguaje($leng)
    {
        $this->lenguaje = $leng;
    }


    public function setAnios_experiencia($anios_experiencia)
    {
        $this->anios_experiencia = $anios_experiencia;
    }


    public function evaluarDesempenio()
    {;
    }
}
