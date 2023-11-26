<?php

declare(strict_types=1);
require_once "Enum/Tipos.php";
abstract class Arma
{

    protected $nombre, $fuerza, $material, $tipo, $resistencia, $usaMana, $ventajaSobre;
    public function __construct(
        string $nombre,
        int $fuerza,
        string $material,
        int $resistencia,
        Tipos $tipo,
        string $usaMana,
        string $ventajaSobre
    ) {
        $this->nombre = $nombre;
        $this->fuerza = $fuerza;
        $this->resistencia = $resistencia;
        $this->material = $material;
        $this->tipo = $tipo;
        $this->usaMana = $usaMana;
        $this->ventajaSobre = $ventajaSobre;
    }


    public function getNombre(): string
    {
        return $this->nombre;
    }


    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getFuerza(): int
    {
        return $this->fuerza;
    }


    public function setFuerza(int $fuerza): void
    {
        $this->fuerza = $fuerza;
    }

    public function getMaterial(): string
    {
        return $this->material;
    }


    public function setMaterial(string $material): void
    {
        $this->material = $material;
    }


    public function getTipo(): Tipos
    {
        return $this->tipo;
    }

    public function setTipo(Tipos $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getUsaMana(): string
    {
        return $this->usaMana;
    }


    public function setUsaMana(string $usaMana)
    {
        $this->usaMana = $usaMana;

        return $this;
    }

    public function getVentajaSobre(): string
    {
        return $this->ventajaSobre;
    }


    public function setVentajaSobre(string $ventajaSobre): void
    {
        $this->ventajaSobre = $ventajaSobre;
    }
}
