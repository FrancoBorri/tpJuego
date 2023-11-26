<?php

declare(strict_types=1);


abstract class Empleado
{
    private $id_empleado;
    private $nombre_apellido;
    private $sueldo;
    private $fecha_alta;
    private $area;
    private $categoria;


    public function __construct(int $sueldo, string $nombre_apellido, string $fecha_alta, string $area, string $categoria)
    {
        $this->sueldo = $sueldo;
        $this->nombre_apellido = $nombre_apellido;
        $this->fecha_alta = $fecha_alta;
        $this->area = $area;
        $this->categoria = $categoria;
    }



    public function __toString()
    {
        // Devuelve todos los datos del empleado como una cadena
        return "ID: {$this->id_empleado}, Nombre: {$this->nombre_apellido}, Sueldo: {$this->sueldo}, Fecha de Alta: {$this->fecha_alta}, Área: {$this->area}, Categoría: {$this->categoria}";
    }




    public function getId_empleado(): int
    {
        return $this->id_empleado;
    }


    /**
     * Get the value of nombre_apellido
     */
    public function getNombre_apellido(): string
    {
        return $this->nombre_apellido;
    }

    /**
     * Set the value of nombre_apellido
     *
     * @return  self
     */
    public function setNombre_apellido(string $nombre_apellido): void
    {
        $this->nombre_apellido = $nombre_apellido;
    }

    /**
     * Get the value of sueldo
     */
    public function getSueldo(): int
    {
        return $this->sueldo;
    }

    /**
     * Set the value of sueldo
     *
     * @return  self
     */
    public function setSueldo(int $sueldo): void
    {
        $this->sueldo = $sueldo;
    }

    /**
     * Get the value of fecha_alta
     */
    public function getFecha_alta(): string
    {
        return $this->fecha_alta;
    }

    /**
     * Set the value of fecha_alta
     *
     * @return  self
     */
    public function setFecha_alta(string $fecha_alta): void
    {
        $this->fecha_alta = $fecha_alta;
    }

    /**
     * Get the value of area
     */
    public function getArea(): string
    {
        return $this->area;
    }

    /**
     * Set the value of area
     *
     * @return  self
     */
    public function setArea(string $area): void
    {
        $this->area = $area;
    }

    /**
     * Get the value of categoria
     */
    public function getCategoria(): string
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */
    public function setCategoria(string $categoria): void
    {
        $this->categoria = $categoria;
    }



    public function calcularAntiguedadEnMeses()
    {
        $fechaActual = new DateTime();
        $fechaAlta = new DateTime($this->getFecha_alta());
        $interval = $fechaAlta->diff($fechaActual);

        // Obtener la antigüedad total en meses
        $antiguedadEnMeses = $interval->y * 12 + $interval->m;

        return $antiguedadEnMeses;
    }

    public function calcularAntiguedadEnAnios()
    {
        $fechaActual = new DateTime();
        $fechaAlta = new DateTime($this->getFecha_alta());
        $interval = $fechaAlta->diff($fechaActual);

        // Obtener la antigüedad total en años
        $antiguedadEnAnios = $interval->y;

        return $antiguedadEnAnios;
    }
}
