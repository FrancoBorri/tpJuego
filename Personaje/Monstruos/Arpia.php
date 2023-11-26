<?php

declare(strict_types=1);
require_once "Personaje.php";
class Arpia extends Personaje
{
    protected $elemento, $mana;
    public function __construct(
        $nombre,
        int $mana = 25,
        $desplazamiento = 2,
        $ataque = 15,
        $vida = 35,
        $habilidades = ["Invisibilidad Arcana", "Corte Etéreo"],
        $debilidades = ["Magia", "Luz"]
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
            if ($this->debilidades[$i] == "Magia") {
                if (property_exists(get_class($enemigo), "mana")) {
                    $ataque += 5;
                }
            }
            if ($this->debilidades[$i] == "Luz") {
                if ($enemigo instanceof Elfo)
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
}
