<?php

declare(strict_types=1);
require_once "./Arma/Arma.php";

class HechiceroDeLaLuz extends Hechicero
{
    protected $nivel_de_maestría;
    protected $mana;
    public function __construct(
        $nombre,
        int $mana = 20,
        int $nivel_de_maestría = 20,
        $desplazamiento = 1,
        $ataque = 10,
        $vida = 10,
        $habilidades = ["combinación de magia", "invisibilidad"],
        $debilidades = ["Demonio", "Oscuridad"]
    ) {
        $this->nivel_de_maestría = $nivel_de_maestría;
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
        $armasOfensivas = $this->ArmasPorTipo(Tipos::Ofensivo);
        $ataque_total = 0;
        if (count($this->arsenal) > 0) {
            if (count($this->habilidades) > 0) {
                $habilidad = array_rand(array_flip($this->habilidades));
                if ($habilidad == "combinación de magia") {
                    if (count($armasOfensivas) >= 2) {
                        for ($i = 0; $i < 2; $i++) {
                            $indice = array_rand($armasOfensivas);
                            $arma = $armasOfensivas[$indice];
                            if ($arma->getusaMana() == "S") {
                                if ($this->mana > $arma->getCantManaReq()) {
                                    $this->mana -= $arma->getCantManaReq();
                                    $ataque_total += $arma->getFuerza();
                                }
                            } else {
                                $ataque_total += $arma->getFuerza();
                            }
                            unset($armaOfensivas[$indice]);
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
            if ($this->debilidades[$i] == "Oscuridad") {
                if ($enemigo instanceof Dragon && $enemigo->getElemento() === "Oscuro")
                    $ataque += 5;
            }
            if ($this->debilidades[$i] == "Demonio") {
                if ($enemigo instanceof Demonio)
                    $ataque += 5;
            }
        }
        if (count($this->habilidades) > 0) {
            $indice = array_rand($this->habilidades);
            $habilidad = $this->habilidades[$indice];
            if ($habilidad == "combinación de magia") {
                if (count($armasDefensivas) >= 2) {
                    for ($i = 0; $i < 2; $i++) {
                        $indice = array_rand($armasDefensivas);
                        $arma = $armasDefensivas[$indice];
                        if ($arma->usaMana == "S") {
                            if ($this->mana > $arma->getCantManaReq()) {
                                $this->mana -= $arma->getCantManaReq();
                                $defensaExtra += $arma->getFuerza();
                            }
                        } else {
                            $defensaExtra += $arma->getFuerza();
                        }
                        unset($armaOfensivas[$indice]);
                    }
                }
            }
            if ($habilidad === "invisibilidad") {
                $ataque = 0;
                $this->eliminarDebilidad($habilidad);
            }
        }


        $ataque -= $this->nivel_de_maestría + $defensaExtra;
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
