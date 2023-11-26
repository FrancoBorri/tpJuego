<?php

declare(strict_types=1);
require_once "Arma.php";
class ArcoDorado extends Arco
{
    protected $flechas;
    public function __construct(
        $nombre,
        $material = "madera y acero",
        $fuerza = 5,
        $tipo = Tipos::Ofensivo,
        $ventaja_sobre = "Orco",
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
            ventajaSobre: $ventaja_sobre
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
