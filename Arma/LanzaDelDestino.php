<?php

declare(strict_types=1);
require_once 'Arma.php';
class LanzaDelDestino extends Lanza
{

    public function __construct(
        $nombre,
        $material = "acero",
        $fuerza = 14,
        $tipo = Tipos::Ofensivo,
        $usa_mana = "n",
        $ventaja_sobre = "Centauro",
        $resistencia = 0

    ) {

        parent::__construct(
            nombre: $nombre,
            material: $material,
            fuerza: $fuerza,
            tipo: $tipo,
            usa_mana: $usa_mana,
            ventaja_sobre: $ventaja_sobre,
            resistencia: $resistencia
        );
    }
}
