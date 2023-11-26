<?php

declare(strict_types=1);
require_once "Personaje.php";
class Troll extends Personaje
{
    protected $elemento, $mana;
    public function __construct(
        $nombre,
        int $mana = 25,
        $desplazamiento = 2,
        $ataque = 15,
        $vida = 35,
        $habilidades = ["Invisibilidad Arcana", "Corte Etéreo"],
        $debilidades = ["Flechas", "Guerrero"]
    ) {

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
            if ($this->debilidades[$i] == "Flechas") {
                foreach ($enemigo->getArsenal() as $arma)
                    if (property_exists(get_class($arma), "flechas")) {
                        $ataque += $arma->getFechas();
                    }
            }
            if ($this->debilidades[$i] == "Guerrero") {
                if ($enemigo instanceof Guerrero)
                    $ataque += 7;
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
}
