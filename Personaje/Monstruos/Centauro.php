<?php

declare(strict_types=1);
require_once "Personaje.php";
class Centauro extends Personaje
{
    protected $elemento, $mana;
    public function __construct(
        $nombre,
        string $elemento = "fuego",
        int $mana = 25,
        $desplazamiento = 2,
        $ataque = 12,
        $vida = 40,
        $habilidades = ["Sanación Astral", "Eco de las Sombras"],
        $debilidades = ["Guerrero"]
    ) {
        $this->elemento = $elemento;
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
    public function atacar(): int
    {
        return $this->ataque;
    }
    public function defender(Personaje $enemigo): void
    {
        $ataque = $enemigo->atacar();
        for ($i = 0; $i < count($this->debilidades); $i++) {
            if ($this->debilidades[$i] == "Guerrero") {
                if ($enemigo instanceof Guerrero)
                    $ataque += 5;
            }
        }

        if ($ataque < 0) {
            $ataque = 0;
        }
        $this->vida -= $ataque;
    }


    public function desplazar(): int
    {
        return $this->desplazamiento;
    }
    public function getElemento(): string
    {
        return $this->elemento;
    }
}
