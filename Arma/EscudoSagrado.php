<?php

declare(strict_types=1);
require_once 'Arma.php';
class EscudoSagrado extends Arma
{

    public function __construct(
        $nombre,
        $material = "acero",
        $fuerza = 24,
        $tipo = Tipos::Defensivo,
        $usa_mana = "s",
        $ventaja_sobre = "Dragon",
        $resistencia = 0

    ) {

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
}
