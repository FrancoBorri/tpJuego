<?php

declare(strict_types=1);
require_once "Personaje.php";

class Guerrero extends Personaje
{
    /** @var int $armadura  */
    private $armadura;


    public function __construct(
        string $nombre,
        int $vida = 10,
        int $ataque = 5,
        int $desplazamiento = 1,
        array $habilidades = ["Usar dos armas", "Ataque doble", "Esquivo"],
        array $debilidades = ["Magia", "Dragon"],
        int $armadura = 10
    ) {
        /* Parent llama METODOS de la clase PADRE  */
        parent::__construct(
            nombre: $nombre,
            vida: $vida,
            ataque: $ataque,
            desplazamiento: $desplazamiento,
            habilidades: $habilidades,
            debilidades: $debilidades,
            
        );

        $this->armadura = $armadura;
    }

    public function  atacar()
    {
        foreach (parent::getArsenal() as $arma) { //----> recorro array getArsenal

            $tipo = $arma->getTipo();
            $fuerza = $arma->getFuerza() + $this->getAtaque(); //----> Suma de ataque y fuerza

            if ($tipo == Tipos::Ofensivo) {

                echo "Su arma " . "->> " . $arma->getNombre() . " ->>" . " es ofensiva \n";
                echo "El valor de ataque de su personaje es ->> $fuerza \n\n";
                echo "Arma utilizada por: " . parent::getNombre() . "\n";
            }
            if (count(parent::getArsenal()) > 0) { //--->> Si tiene armas, puede atacar

                $arsenal = parent::getArsenal();
                $claveArma = array_rand($arsenal);

                echo "Solo puede utilizar el arma numero $claveArma " . " \n";
            }else {
                echo "Su arma " . "->>" . $arma->getNombre() . " ->>" . " es defensiva \n";
            }
        }    

        foreach ($this->habilidades as $key => $habilidades) {

            if ($habilidades === "Usar dos armas") {
                echo "Su habilidad es ->> $habilidades <<- puede usarla para atacar \n";
                echo "La habilidad ->> $habilidades ->> fue utilizada con exito \n";
                parent::eliminarHabilidad("Usar dos armas");
            } else {
                echo "Personaje: " . parent::getNombre() . "\n";
                echo " Habilidad $key ->> $habilidades \n";
                echo "Posee un arma para atacar \n";
            }
        }   
    }


    public function  defender(): void
    {
        echo "En su defensa posee una armadura con " . $this->armadura . " Puntos de defensa" . " y una habilidad " . $this->habilidades[2] . "\n";

        if (in_array("Dragon", $this->debilidades)) {

            echo "Posee la debilidad " . $this->debilidades[1] . " por lo tanto se sumaran 2 puntos de ataque a su oponente" . $this->debilidades[1] . "\n";
        }
    }


    public function  desplazar(): int
    {

        return $this->desplazamiento;
    }


    /** @var int $armadura */
    public function getArmadura(): int
    {
        return $this->armadura;
    }



    /** @param int $armadura */
    public function setArmadura(int $armadura): void
    {
        $this->armadura = $armadura;
    }
}


