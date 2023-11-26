<?php

declare(strict_types=1);

interface ICalculo
{
    public function calcularSueldo(): float;
    public function calcularVacaciones(): int;
    public function calcularSAC(array $sueldos): float;
}
