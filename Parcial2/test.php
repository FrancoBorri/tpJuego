<?php

declare(strict_types=1);
require_once "Programador.php";
require_once "Coordinador.php";
require_once "Icalculo.php";
class TestEmpleado
{
    public static function run()
    {
        self::testProgramador();
        self::testCoordinador();

        echo "Pruebas completadas con éxito.\n";
    }

    private static function testProgramador()
    {
        $programador = new Programador(sueldo: 5000, nombre_apellido: "Franco Borri", fecha_alta: "16/12/17", area: "absdds", categoria: "junior");
        $programador->setFecha_alta('2022-01-01');
        $programador->setSueldo(3000);

        // Agregar más configuraciones y llamadas a métodos según sea necesario

        $sueldos = [3000, 3500, 4000, 4500, 5000, 5500, 6000, 6500, 7000, 7500, 8000, 8500];

        $sac = $programador->calcularSAC($sueldos);
        assert($sac === 4250);  // Ajusta este valor según el resultado esperado
    }

    private static function testCoordinador()
    {
        $coordinador = new Coordinador(sueldo: 5000, nombre_apellido: "Franco Borri", fecha_alta: "16/12/17", area: "absdds", categoria: "junior");
        $coordinador->setFecha_alta('2022-01-01');
        $coordinador->setSueldo(5000);
        $coordinador->setAreas(3);

        // Agregar más configuraciones y llamadas a métodos según sea necesario

        $sueldos = [5000, 5500, 6000, 6500, 7000, 7500, 8000, 8500, 9000, 9500, 10000, 10500];

        $sac = $coordinador->calcularSAC($sueldos);
        assert($sac === 10250);  // Ajusta este valor según el resultado esperado
    }
}

// Ejecuta las pruebas

TestEmpleado::run();
