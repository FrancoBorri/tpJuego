<?php

declare(strict_types=1);
require_once "Personaje.php";
require_once "./Arma/Arma.php";
class Amazona extends Guerrero
{
    protected $armadura;
    public function __construct(
        $nombre,
        int $armadura = 13,
        $desplazamiento = 1,
        $ataque = 10,
        $vida = 12,
        $habilidades = ["usar dos armas", "ataque doble", "esquivo"],
        $debilidades = ["Magia", "Arpia"]
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
    public function atacar(): int
    {

        $ataque_total = 0;
        if (count($this->arsenal) > 0) {
            if (count($this->habilidades) > 0) {
                $habilidad = array_rand(array_flip($this->habilidades));
                if ($habilidad == "usar dos armas") {
                    $cant_armas = 2;
                    for ($i = 0; $i < count($this->arsenal); $i++) {
                        if ($this->arsenal[$i] != Tipos::Ofensivo) {
                            $ataque_total += $this->arsenal[$i]->getFuerza();
                            $cant_armas--;
                        }
                        if ($cant_armas == 0) {
                            $ataque_total += $this->ataque;
                            $key = array_search($habilidad, $this->habilidades);
                            unset($this->habilidades[$key]);
                            return $ataque_total;
                        }
                    }
                }
                if ($habilidad == "ataque doble") {
                    for ($i = 0; $i < count($this->arsenal); $i++) {
                        if ($this->arsenal[$i] != Tipos::Ofensivo) {
                            $key = array_search($habilidad, $this->habilidades);
                            unset($this->habilidades[$key]);
                            return $ataque_total += ($this->arsenal[$i]->getFuerza() + $this->getAtaque()) * 2;
                        }
                    }
                }
            } else {
                for ($i = 0; $i < count($this->arsenal); $i++) {
                    if ($this->arsenal[$i] != Tipos::Ofensivo) {
                        return $ataque_total += $this->arsenal[$i]->getFuerza() + $this->getAtaque();
                    }
                }
            }
        }
        return $this->getAtaque();
    }

    public function defender(Personaje $enemigo): void
    {

        $armasDefensivas = $this->ArmasPorTipo(Tipos::Defensivo);
        $ataque = $enemigo->atacar();
        $defensaExtra = 0;
        for ($i = 0; $i < count($this->debilidades); $i++) {
            if ($this->debilidades[$i] == "Magia") {
                if (property_exists(get_class($enemigo), "mana")) {
                    $ataque += 5;
                }
            }
            if ($this->debilidades[$i] == "Arpia") {
                if ($enemigo instanceof Arpia) {
                    $ataque += 5;
                }
            }
        }
        if (count($this->habilidades) > 0) {
            $indice = array_rand($this->habilidades);
            $habilidad = $this->habilidades[$indice];
            if ($habilidad === "usar dos armas") {
                if (count($armasDefensivas) >= 2) {
                    for ($i = 0; $i < 2; $i++) {
                        $indice = array_rand($armasDefensivas);
                        $armas[] =  $armasDefensivas[$indice];
                        unset($armasDefensivas[$indice]);
                    }
                    $defensaExtra = $armas[0]->getFuerza() + $armas[1]->getFuerza();
                    $this->eliminarHabilidad($habilidad);
                }
            }
            if ($habilidad === "ataque doble") {
                if (count($armasDefensivas) > 0) {
                    $indice = array_rand($armasDefensivas);
                    $defensaExtra = $armasDefensivas[$indice]->getFuerza() * 2;
                    $this->eliminarHabilidad($habilidad);
                }
            }
            if ($habilidad === "esquivo") {
                $ataque = 0;
                $this->eliminarHabilidad($habilidad);
            }
        }


        $ataque -= $this->armadura + $defensaExtra;
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
