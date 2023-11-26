<?php

declare(strict_types=1);
require_once 'Arma.php';
class Espada extends Arma
{
    protected $gemas = array();
    public function __construct(
        $nombre,
        $material = "acero",
        $fuerza = 10,
        $tipo = Tipos::Ofensivo,
        $usa_mana = "n",
        $ventaja_sobre = "orcos",
        $resistencia = 0,


    ) {

        parent::__construct(
            nombre: $nombre,
            material: $material,
            fuerza: $fuerza,
            tipo: $tipo,
            usaMana: $usa_mana,
            ventajaSobre: $ventaja_sobre,
            resistencia: $resistencia
        );
    }

    public function agregarGema(string $gema): void

    {

        if (count($this->gemas) < 4) {
            $this->gemas[] = $gema;
            echo "gema $gema agregada con exito \n";
        } else {
            echo "No se pueden agregar mas gemas, por favor remueva
            una para poder agregar una nueva\n";
        }
    }

    public function quitarGema(string $gema): void
    {
        # verifico que existan gemas agregadas
        if (count($this->gemas) === 0) {
            echo "aun no se han agregado gemas, gema no encontrada\n";
        } else {
            # verifico si la gema esta en el array, su es verdadero la elimino
            if (in_array($gema, $this->gemas)) {
                $this->gemas = array_filter($this->gemas, function ($value) use ($gema) {
                    return $value != $gema;
                });
                if (!array_search($gema, $this->gemas)) {
                    echo "gema eliminada con exito \n";
                } else {
                    echo "no se pudo eliminar la gema \n";
                }
            } else {
                echo "gema no encontrada \n";
            }
        }
    }
}
