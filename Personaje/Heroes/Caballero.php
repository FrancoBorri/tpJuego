<?php

declare(strict_types=1);
require_once "Personaje.php";
require_once "./Arma/Arma.php";

class Caballero extends Guerrero
{
    protected $armadura;
    public function __construct(
        $nombre,
        int $armadura = 15,
        $desplazamiento = 1,
        $ataque = 15,
        $vida = 15,
        $habilidades = ["usar dos armas", "ataque doble", "esquivo"],
        $debilidades = ["Magia", "Dragon"]
    ) {
        $this->armadura = $armadura;
        parent::__construct(
            nombre: $nombre,
            vida: $vida,
            ataque: $ataque,
            desplazamiento: $desplazamiento,
            debilidades: $debilidades,
            habilidades: $habilidades
        );
    }
}
