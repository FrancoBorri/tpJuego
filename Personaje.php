<?php

declare(strict_types=1);
spl_autoload_register(function ($nombre_clase) {
    include  "./Arma/" . $nombre_clase . '.php';
});

abstract class Personaje
{
    protected $nombre, $vida, $ataque, $desplazamiento, $debilidades, $habilidades;
    protected $arsenal = array();

    public function __construct(
        string $nombre,
        int $desplazamiento,
        int $vida,
        int $ataque,
        array $debilidades,
        array $habilidades
    ) {
        $this->nombre = $nombre;
        $this->desplazamiento = $desplazamiento;
        $this->vida = $vida;
        $this->ataque = $ataque;
        $this->debilidades = $debilidades;
        $this->habilidades = $habilidades;
    }
    # ---- Getters ----#
    public function getArsenal(): array
    {
        return $this->arsenal;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getHabilidades(): array
    {
        return $this->habilidades;
    }
    public function getDebilidades(): array
    {
        return $this->debilidades;
    }
    public function getAtaque(): int
    {
        return $this->ataque;
    }
    public function getVida(): int
    {
        return $this->vida;
    }

    # ---- Setters ---- #

    public function setVida($vida): void
    {
        $this->vida = $vida;
    }

    public function setDebilidades($debilidades): void
    {
        $this->debilidades = $debilidades;
    }


    public function setAtaque(int $ataque): void
    {
        $this->ataque = $ataque;
    }

    public function __toString(): string
    {
        return
            'Nombre: ' . $this->nombre . "\ntipo: " . get_class($this) . ', puntos de vida: ' . $this->vida .
            ' puntos de ataque:  ' . $this->ataque . "\nhabilidades: " . implode(", ", $this->habilidades) .
            " \ndebilidades: " . implode(", ", $this->debilidades) . " \n";
    }
    # ----> metodos abstractos definidos para implementacion de las clases hijas <---- 

    abstract public function atacar(): int;
    abstract public function defender(Personaje $objeto): void;
    abstract public function desplazar(): int;

    # ------------------ *** ------------------
    # ---------------- METODOS PARA EL MANEJO DEL ARSENAL -------------------

    public function agregarArma(Arma $nuevaArma): void
    {


        if (count($this->arsenal) <= 6) :
            if (!in_array($nuevaArma, $this->arsenal, true)) {
                $this->arsenal[] = $nuevaArma;
                //echo "el arma {$nuevaArma->getNombre()} agregada con exito\n";
            } else {
                //echo "el arma {$nuevaArma->getNombre()} que desea agregar ya existe\n";
            }
        else :
            echo  <<<EOT
                ------------------- *** -------------------
                 -. no se pueden agregar mas armas al arsenal, 
                 por favor, elimine una para poder agregar
                                una nueva.-
                ------------------- *** -------------------\n
            EOT;
        endif;
    }

    public function quitarArma(Arma $arma): void
    {
        // Primero nos aseguramos que el arsenal no este vacio

        if (is_null($this->arsenal)) {
            echo "no se puede eliminar el arma,el arsenal esta vacio \n";
        } else {
            // para este metodo existen varias formas de verificar si existe el arma:
            // 1 -  si ponemos un solo tipo de arma seria la forma mas facil .-
            // 2 -  en cambio si tenemos armas del mismo tipo la unica forma seria
            //      buscando algo que las identifique, si encuentra valores iguales 
            //      las elimina a todas, o sea que si agregamos dos armas tipo Espada
            //      eliminaria ambas, si buscamos por el nombre seria mas seguro, salvo
            //      que tengamos dos armas con el mismo nombre.

        }
    }



    # ------------------ *** ------------------
    # ---------- METODOS PARA EL MANEJO DE LAS HABILIDADES Y DEBILIDADES --------------
    public function agregarHabilidad(string $addHabilidad): void
    {
        $this->habilidades[] = $addHabilidad;
    }

    public function eliminarHabilidad(string $remHabilidad): void

    {
        $this->habilidades = array_filter(
            $this->habilidades,
            function ($value) use ($remHabilidad) {
                return $value != $remHabilidad;
            }
        );
    }
    public function agregarDebilidad(string $addDebilidad): void
    {
        $this->debilidades[] = $addDebilidad;
    }

    public function eliminarDebilidad(string $remDebilidades): void

    {
        $this->debilidades = array_filter(
            $this->habilidades,
            function ($value) use ($remDebilidades) {
                return $value != $remDebilidades;
            }
        );
    }

    public function __get(string $attr)
    {
        if (property_exists($this, $attr)) {
            return $this->$attr;
        }
    }

    public function ArmasPorTipo(Tipos $tipo): array
    {

        $armasObtenidas = array_filter($this->arsenal, function ($arma) use ($tipo) {;
            return $arma->getTipo() === $tipo;
        });
        return $armasObtenidas;
    }
}
