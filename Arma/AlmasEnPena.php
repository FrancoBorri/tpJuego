<?php

declare(strict_types=1);
require_once 'Arma.php';
class AlmasEnPena extends Conjuro
{
    protected  $cantManaReq;
    public function __construct(
        $nombre,
        $material = "magia",
        $fuerza = 15,
        $tipo = Tipos::Ofensivo,
        $usa_mana = "s",
        $ventaja_sobre = "orcos",
        $resistencia = 2,
        $cantManaReq = 3
    ) {
        $this->cantManaReq = $cantManaReq;
        parent::__construct(
            nombre: $nombre,
            material: $material,
            fuerza: $fuerza,
            tipo: $tipo,
            usaMana: $usa_mana,
            ventajaSobre: $ventaja_sobre,
            resistencia: $resistencia

        );
    }

    public function getCantManaReq(): int
    {
        return $this->cantManaReq;
    }


    public function setCantManaReq($cantManaReq): void
    {
        $this->cantManaReq = $cantManaReq;
    }
}
