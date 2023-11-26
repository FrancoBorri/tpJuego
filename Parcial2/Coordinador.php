<?php

declare(strict_types=1);
require_once "Empleado.php";
require_once "Icalculo.php";

class Coordinador extends Empleado implements ICalculo
{

    private $areas;


    /**
     * Get the value of areas
     */
    public function getAreas()
    {
        return $this->areas;
    }

    /**
     * Set the value of areas
     *
     * @return  self
     */
    public function setAreas($areas)
    {
        $this->areas = $areas;

        return $this;
    }

    public function calcularSueldo(): float
    {
        $categoria = $this->getCategoria();
        $punto = 100;

        switch ($categoria) {
            case ($categoria >= 1 && $categoria <= 3):
                $sueldoBase = 5000;
                break;
            case ($categoria >= 4 && $categoria <= 7):
                $sueldoBase = 6500;
                break;
            case ($categoria >= 8 && $categoria <= 10):
                $sueldoBase = 9750;
                break;
            default:
                $sueldoBase = 0;
        }

        // Calcular el sueldo final del Coordinador
        $sueldoFinal = $sueldoBase * $punto + $this->areas * 0.15 * $sueldoBase;


        return $sueldoFinal;
    }

    public function calcularVacaciones(): int
    {
        $antiguedadEnMeses = $this->calcularAntiguedadEnMeses();

        if ($antiguedadEnMeses < 6 || $this->areas !== 1) {
            return 0;
        }

        $diasVacaciones = $this->calcularAntiguedadEnAnios() + 1;

        return min(10, $diasVacaciones);
    }


    public function calcularSAC(array $sueldos): float
    {
        $mejorSueldoMitad1 = max(array_slice($sueldos, 0, 6));
        $mejorSueldoMitad2 = max(array_slice($sueldos, 6));
        $mejorSueldoAnual = max($mejorSueldoMitad1, $mejorSueldoMitad2);

        $sueldoBase = $this->getSueldo();
        $plusCargo = 0.05 * $sueldoBase;

        $sac = 0.5 * $mejorSueldoAnual + $plusCargo;

        return $sac;
    }
}
