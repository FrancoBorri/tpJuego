<?php

declare(strict_types=1);
require_once 'Arma.php';
class Hechizo extends Arma
{
    protected $duracion, $cantManaReq;

    public function __construct(
        $nombre,
        $material = "magia",
        $fuerza = 10,
        $tipo = Tipos::Ofensivo,
        $usa_mana = "s",
        $ventaja_sobre = "orcos",
        int $duracion = 1,
        $resistencia = 0,
        int $cantManaReq = 2
    ) {
        $this->duracion = $duracion;
        $this->cantManaReq = $cantManaReq;
        parent::__construct(
            nombre: $nombre,
            material: $material,
            fuerza: $fuerza,
            tipo: $tipo,
            usaMana: $usa_mana,
            ventajaSobre: $ventaja_sobre,
            resistencia: $resistencia,
        );
    }

    /**
     * Get the value of duracion
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set the value of duracion
     *
     * @return  self
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get the value of cantManaReq
     */
    public function getCantManaReq(): int
    {
        return $this->cantManaReq;
    }


    public function setCantManaReq(int $cantManaReq): void
    {
        $this->cantManaReq = $cantManaReq;
    }
}
