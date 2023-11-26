<?php

declare(strict_types=1);
require_once "Personaje.php";
require_once "./Arma/Arma.php";

class CaballeroOscuro extends Guerrero
{
    protected $armadura;
    public function __construct(
        $nombre,
        int $armadura = 17,
        $desplazamiento = 1,
        $ataque = 15,
        $vida = 25,
        $habilidades = ["usar dos armas", "ataque doble", "esquivo"],
        $debilidades = ["Magia", "Amazona"]
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
    public function defender(Personaje $enemigo): void
    {
        $ataque = $enemigo->atacar();
        for ($i = 0; $i < count($this->debilidades); $i++) {
            if ($this->debilidades[$i] == "Magia") {
                if (property_exists(get_class($enemigo), "mana")) {
                    $ataque += 5;
                }
            }
            if ($this->debilidades[$i] == "Amazona") {
                if ($enemigo instanceof Amazona)
                    $ataque += 5;
            }
        }

        if ($ataque < 0) {
            $ataque = 0;
        }
        $this->vida -= $ataque;
    }
}
