<?php

declare(strict_types=1);
require_once "Empleado.php";
require_once "Icalculo.php";

class Programador extends Empleado  implements ICalculo
{

    private $lenguajesProgramacion;
    private $horasDeTrabajo;
    private $horasExtras;



    /**
     * Get the value of lenguajesProgramacion
     */
    public function getLenguajesProgramacion(): string
    {
        return $this->lenguajesProgramacion;
    }

    /**
     * Set the value of lenguajesProgramacion
     *
     * @return  self
     */
    public function setLenguajesProgramacion(string $lenguajesProgramacion): void
    {
        $this->lenguajesProgramacion = $lenguajesProgramacion;
    }

    /**
     * Get the value of horasDeTrabajo
     */
    public function getHorasDeTrabajo(): int
    {
        return $this->horasDeTrabajo;
    }

    /**
     * Set the value of horasDeTrabajo
     *
     * @return  self
     */
    public function setHorasDeTrabajo(int $horasDeTrabajo): void
    {
        $this->horasDeTrabajo = $horasDeTrabajo;
    }

    /**
     * Get the value of horasExtras
     */
    public function getHorasExtras(): int
    {
        return $this->horasExtras;
    }

    /**
     * Set the value of horasExtras
     *
     * @return  self
     */
    public function setHorasExtras(int $horasExtras): void
    {
        $this->horasExtras = $horasExtras;
    }


    public function calcularSueldo(): float
    {
        // Definir los valores de hora según la categoría
        $valorHora = 0;
        switch ($this->getCategoria()) {
            case 'Junior':
                $valorHora = 2500;
                break;
            case 'Semi Senior':
                $valorHora = 3500;
                break;
            case 'Senior':
                $valorHora = 4750;
                break;
            default:
                // Manejar caso no especificado
                $valorHora = 0;
        }

        // Calcular el sueldo según la fórmula dada
        $sueldo = $this->getHorasDeTrabajo() * $valorHora + $this->getHorasExtras() * $valorHora * 1.5;

        return $sueldo;
    }


    public function calcularVacaciones(): int
    {
        $antiguedadEnAnios = $this->calcularAntiguedad();

        // Si la antigüedad es menor a 1 año, no se pueden tomar vacaciones
        if ($antiguedadEnAnios < 1) {
            return 0;
        }

        // Calcular la cantidad de días de vacaciones
        $diasVacaciones = min(10, $antiguedadEnAnios) + 1; // Se agrega 1 día por cada año hasta un máximo de 10 días adicionales

        return $diasVacaciones;
    }


    public function calcularAntiguedad()
    {
        // Obtener la fecha actual
        $fechaActual = new DateTime();

        // Obtener la fecha de alta del empleado
        $fechaAlta = new DateTime($this->getFecha_alta());

        // Calcular la diferencia en años
        $interval = $fechaAlta->diff($fechaActual);
        $antiguedadEnAnios = $interval->y;

        return $antiguedadEnAnios;
    }


    public function calcularSAC(array $sueldos): float
    {
        // Ordenar el array de sueldos por mes
        ksort($sueldos);

        // Obtener el mejor sueldo de enero a junio y de julio a diciembre
        $mejorSueldoMitad1 = max(array_slice($sueldos, 0, 6));
        $mejorSueldoMitad2 = max(array_slice($sueldos, 6));

        // Calcular el SAC como el 50% del mejor sueldo de ambas mitades
        $sac = 0.5 * max($mejorSueldoMitad1, $mejorSueldoMitad2);

        return $sac;
    }
}

/*
$programador = new Programador(5000);
$sueldosAnuales = [
    'enero' => 6000,
    'febrero' => 6500,
    'marzo' => 6200,
    'abril' => 6100,
    'mayo' => 6300,
    'junio' => 6200,
    'julio' => 6100,
    'agosto' => 6300,
    'septiembre' => 6200,
    'octubre' => 6300,
    'noviembre' => 6400,
    'diciembre' => 6500,
];

$sacProgramador = $programador->calcularSAC($sueldosAnuales);
echo "SAC del Programador: $sacProgramador";
*/