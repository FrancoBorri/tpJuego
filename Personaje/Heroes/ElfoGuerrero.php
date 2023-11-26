<?php

declare(strict_types=1);
require_once "Personaje.php";
require_once "./Arma/Arma.php";

class ElfoGuerrero extends Elfo
{
    protected $regeneracion;
    protected $mana;
    public function __construct(
        $nombre,
        int $regeneracion = 1,
        int $mana = 10,
        $desplazamiento = 2,
        $ataque = 5,
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
    public function atacar(): int
    {
        $armasOfensivas = $this->ArmasPorTipo(Tipos::Ofensivo);
        $ataque_total = 0;
        if (count($this->arsenal) > 0) {
            if (count($this->habilidades) > 0) {
                $habilidad = array_rand(array_flip($this->habilidades));
                if ($habilidad == "Ataque Rápido") {
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
                if ($habilidad == "Doble Rafaga") {
                    if (count($armasOfensivas) >= 2) {
                        for ($i = 0; $i < 2; $i++) {
                            $indice = array_rand($armasOfensivas);
                            $arma = $armasOfensivas[$indice];
                            if (strtolower($arma->usaMana) === "s") {
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
            if ($this->debilidades[$i] == "Dragon") {
                if ($enemigo instanceof Dragon)
                    $ataque += 5;
            }
        }
        if (count($this->habilidades) > 0) {
            $indice = array_rand($this->habilidades);
            $habilidad = $this->habilidades[$indice];
            if ($habilidad == "doble rafaga") {
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
            if ($habilidad == "doble rafaga") {
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
        }


        $ataque -= $defensaExtra;
        if ($ataque < 0) {
            $ataque = 0;
        }
        $this->vida -= $ataque;
        $this->vida += $this->regeneracion;
    }


    public function desplazar(): int
    {
        return $this->desplazamiento;
    }
}
