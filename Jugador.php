<?php

declare(strict_types=1);


class Jugador
{

    public $id;
    public $nombreJugador;
    public $puntaje = []; #Putaje acumulado del jugador

    public function __construct(
        int $id,
        string $nombreJugador,
        //array $puntaje
    ) {
        $this->id = $id;
        $this->nombreJugador = $nombreJugador;
        //$this->puntaje = $puntaje;
    }

    public function __toString()
    {
        return (
            "ID: " . $this->id . "\n" .
            "Nombre: " . $this->nombreJugador .  "\n" .
            "Puntaje: " . implode(", " . $this->puntaje)
        );
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getNombreJugador(): string
    {
        return $this->nombreJugador;
    }

    public function getPuntaje(): array
    {
        return $this->puntaje;
    }
}
