<?php

declare(strict_types=1);
require_once "Personaje.php";
require_once "./Arma/Arma.php";

class ElfoDelBosque extends Elfo
{
    protected $regeneracion;
    protected $mana;
    public function __construct(
        $nombre,
        int $regeneracion = 15,
        int $mana = 15,
        $desplazamiento = 2,
        $ataque = 10,
        $vida = 5,
        $habilidades = ["Ataque Rápido", "doble rafaga"],
        $debilidades = ["Oscuridad", "Dragon"]
    ) {
        $this->regeneracion = $regeneracion;
        $this->mana = $mana;
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
