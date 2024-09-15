<?php

require_once 'empleado.php';
require_once 'desarrollador.php';
require_once 'gerente.php';

class Empresa
{

    private $empleados = [];
    private $nomima;

    public function agregarEmpleados(Empleado $empleado)
    {
        $this->empleados[] = $empleado;
    }


    public function listarTodosLosEmpleados()
    {
        $arreglo = file_get_contents('HELPERS/listaEmpleados.json');
        $obj = json_decode($arreglo, true);
        $this->empleados = $obj;
        return $this->empleados;
    }


    public function NominaTotal()
    {
        $total = 0;
        $arreglo = file_get_contents('HELPERS/listaEmpleados.json');
        $empls = json_decode($arreglo, true);


        foreach ($empls as $atrib) {

            $total += $atrib['salario'] + $atrib['bono'];
        }
        $this->nomima = number_format($total, 2);

        return $this->nomima;
    }



    public function evaluarEmpleados()
    {
    }
}
