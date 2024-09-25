<?php
class Persona
{
    public $nombre;
    public $apellido;
    public $edad;

    public function __construct($n, $a, $e)
    {
        $this->nombre = $n;
        $this->apellido = $a;
        $this->edad = $e;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    public function mayorEdad()
    {
        if ($this->edad < 0) {
            return "Edad Invalida...<br>";
        } else {
            if ($this->edad >= 18) {
                return "Eres mayor de edad...<br>";
            } else {
                return "Eres menor de edad<br>";
            }
        }
    }



    public function nombreCompleto()
    {
        return $this->nombre . " " . $this->apellido . '<br>';
    }
}


$persona1 = new Persona("Ghadafy", "Neville", 47);
echo $persona1->nombreCompleto();
echo $persona1->mayorEdad();
