<?php

declare(strict_types=1);
require_once "Arma.php";
class Arco extends Arma
{
    protected $flechas;
    public function __construct(
        $nombre,
        $material = "madera y acero",
        $fuerza = 10,
        $tipo = Tipos::Ofensivo,
        $usaMana = "n",
        $ventajaSobre = "orcos",
        $flechas = 5,
        $resistencia = 0
    ) {
        $this->flechas = $flechas;
        parent::__construct(
            nombre: $nombre,
            material: $material,
            fuerza: $fuerza,
            resistencia: $resistencia,
            tipo: $tipo,
            usaMana: $usaMana,
            ventajaSobre: $ventajaSobre
        );
    }

    /**
     * Get the value of flechas
     */
    public function getFlechas()
    {
        return $this->flechas;
    }

    /**
     * Set the value of flechas
     *
     * @return  self
     */
    public function setFlechas($flechas)
    {
        $this->flechas = $flechas;

        return $this;
    }
}
