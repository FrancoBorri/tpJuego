<?php

declare(strict_types=1);
require_once 'Arma.php';
class Conjuro extends Arma
{
    protected  $cantManaReq;
    public function __construct(
        $nombre,
        $material = "magia",
        $fuerza = 5,
        $tipo = Tipos::Ofensivo,
        $usaMana = "s",
        $ventajaSobre = "orcos",
        $resistencia = 2,
        $cantManaReq = 3
    ) {
        $this->cantManaReq = $cantManaReq;
        parent::__construct(
            nombre: $nombre,
            material: $material,
            fuerza: $fuerza,
            tipo: $tipo,
            usaMana: $usaMana,
            ventajaSobre: $ventajaSobre,
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
