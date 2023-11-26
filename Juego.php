<?php

declare(strict_types=1);
require_once 'Jugador.php';
require_once 'Auxiliares/GeneradorDePersonajes.php';


class Juego
{
    /*
    Pueden crear nuevos atributos y metodos para esta clase de ser necesarios
    recuerden que tiene que ser privados y detallar el porque los usan
    */
    private static int $estado = self::NO_INICIADO;
    /** @var Personaje[] */
    // lista de personajes para seleccionar
    private static array $listadoDeHeroes;
    /** @var Personaje[] */
    private static array $listadeMonstruos;
    private static int $rondas = 0;
    /** @var Jugador[] */
    private static array $lista_jugadores = [];
    private static array $heroes_jugadores = [];
    private static array $equipoMonstruos = [];

    // valores para estado
    const MAX_NUM = 3;
    const MIN_NUM = 1;
    const INICIADO = 1;
    const JUGANDO = 2;
    const NO_INICIADO = -1;
    const TERMINADO = 0;
    const ENPAUSA = 3;
    const REINICIAR = 1;



    public static function solicitarCantidadJugadores(): int
    {
        while (true) {
            $cantJugadores =  readline("Ingrese la cantidad de jugadores min " . self::MIN_NUM . " max " . self::MAX_NUM . " :");

            if (is_numeric($cantJugadores) && $cantJugadores >= self::MIN_NUM && $cantJugadores <= self::MAX_NUM) {

                return (int)$cantJugadores;
            }
        }
    }





    public static function solicitarNombreJugador(): string
    {
        while (true) {
            $nombreJugador = (string) readline("Ingrese el nombre del jugador: \n");
            return $nombreJugador;
        }
    }






    public static function solicitarEquipoHeroesJugador(int $cantHeroes): array
    {

        $equipoHeroesJugador = self::$heroes_jugadores;

        for ($j = 0; $j < $cantHeroes; $j++) {


            $count = 1;
            echo "----------------------------------";
            echo "\nlista de " . GeneradorDePersonajes::HEROES . "\n";
            foreach (self::$listadoDeHeroes as $heroe) {
                echo $count . " - " . $heroe->getNombre() . " - Tipo: " . get_class($heroe) . PHP_EOL;
                $count++;
            }

            $opcion = (int) readline("Ingrese el número del Héroe que desea elegir, solo puede elegir 3: ");

            // Verificar que la opción sea válida
            if ($opcion >= 1 && $opcion <= count(self::$listadoDeHeroes)) {
                // Obtener el héroe seleccionado
                $heroeElegido = self::$listadoDeHeroes[$opcion - 1];

                // Agregar el héroe elegido al array de héroes del jugador
                foreach (self::$lista_jugadores as $jugadores) {

                    $jugadorId = $jugadores->getId();
                    self::$heroes_jugadores[$jugadorId][] = $heroeElegido;
                }

                // Eliminar el héroe seleccionado para evitar que se elija nuevamente
                unset(self::$listadoDeHeroes[$opcion - 1]);
                self::$listadoDeHeroes = array_values(self::$listadoDeHeroes); // Reindexar el array
            } else {
                echo "Opción no válida. Intente de nuevo.\n";
                $j--;  // Decrementar $j para permitir que el jugador vuelva a ingresar su elección.
            }
        }
        return $equipoHeroesJugador;
    }






    public static function definirCantMonstruos(int $cantJugadores, int $cantHeroesPorJugador)
    {
        $cantTotalHeroes = $cantJugadores * $cantHeroesPorJugador;

        $cantTotalMonstruos = (int)($cantTotalHeroes / 3);

        if ($cantTotalMonstruos < 1) {
            $cantTotalMonstruos = 1;
        }
        return $cantTotalMonstruos;
    }





    public static function definirMonstruos(int $cantTotalMonstruos)
    {
        for ($i = 0; $i < $cantTotalMonstruos; $i++) {
            $monster = array_rand(self::$listadeMonstruos);
            $monstruo = self::$listadeMonstruos[$monster];
            self::$equipoMonstruos[] = $monstruo;
        }
        return $monstruo;
    }







    public static function iniciar(): void
    {
        echo "Bienvenido al juego HEROES VS MONSTRUOS \n";

        self::crearPersonajes();
        self::agregarArmas();
        $cantJugadores = self::solicitarCantidadJugadores();

        $cantHeroes = 3;

        for ($i = 0; $i < $cantJugadores; $i++) {

            #Ahora crear jugador con todo lo que requiere
            echo "Creando jugador $i \n";

            $nombreJugador = self::solicitarNombreJugador();

            Juego::$lista_jugadores[] = new Jugador(id: $i, nombreJugador: $nombreJugador);

            $heroesJugador = self::solicitarEquipoHeroesJugador($cantHeroes);


            $cantTotalMonstruos = self::definirCantMonstruos($cantJugadores, $cantHeroes);

            $monstruos = self::definirMonstruos($cantTotalMonstruos);
        }
        return;
        self::$estado = self::JUGANDO;
        self::realizarRonda();
    }









    private static function realizarRonda()
    {
        while (self::$estado === self::JUGANDO) {
            // esto es solo un ejemplo, piensen como determinar cada
            // metodo, en que orden, si tiene alguna validacion o restriccion, etc.

            // self::iniciarCombate();
            // self::verificarVida();
            // self::eliminarPersonaje();
            // self::finalizarJuego();
            // self::realizarRonda();
        }
    }
    /* 
    metodo para crear los personajes que luego se agregaran al equipo de cada jugador
    y al equipo de monstruos
    */
    private static function crearPersonajes(): void
    {
        self::$listadoDeHeroes = GeneradorDePersonajes::crearPersonajes(GeneradorDePersonajes::HEROES);
        self::$listadeMonstruos = GeneradorDePersonajes::crearPersonajes(GeneradorDePersonajes::MONSTRUOS);
    }
    /*
    Metodo para agregar armas a los heroes
    */
    private static function agregarArmas(): void
    {
        GeneradorDePersonajes::agregarArmas(self::$listadoDeHeroes);
    }

    /*
    en este método se realiza la acción de atacar y 
    defender. un personaje de la lista de héroes de cada jugador 
    atacará a un personaje de la lista de monstruos, esto puede 
    ser al azar o elegido por el usuario (es una opción abierta)
    */

    public static function tirarDado(): int
    {
        // Generar un número aleatorio entre 1 y 6 para simular el resultado de un dado de seis caras
        return rand(1, 6);
    }

    public static function iniciarCombate(): void
    {
        foreach (self::$heroes_jugadores as $index => $jugador) {
            
            $monstruo= self::$equipoMonstruos[$index];
            echo "Whileeee \n";
            while (!self::verificarVida($monstruo)) {
                foreach ($jugador as $key => $heroe) {
                    
                
                    $dadoHeroes = self::tirarDado();
                    $dadoMonstruos = self::tirarDado();
        
                    echo "Resultado del dado para monstruos: $dadoMonstruos\n";
                    echo "Resultado del dado para heroes: $dadoHeroes\n";
                

                    if ($dadoHeroes > $dadoMonstruos ) {
                        echo "Atacan los heroes!";

                        $monstruo->defender($heroe);
                        $heroe->defender($monstruo);


                    }elseif ($dadoHeroes < $dadoMonstruos) {
                        
                        echo "Atacan los monstruos \n";

                        $heroe->defender($monstruo);
                        $monstruo->defender($heroe);
                        
                    
                    }else {
                        echo "Empate, tirar dado de nuevo \n";
                    }
                }
                echo "\n\nEl monstruo murio \n\n";
            }
        }
    }    


        
            
            

            











    /* 
    después de cada combate se debe verificar la vida del personaje 
    que defendió, si esta es 0 o menor se deberá devolver true en caso 
    que siga con vida o false en caso contrario.
    */
    private static function verificarVida($monstruo): bool
    {

        $vida= $monstruo->getVida();

        if ($vida>= 0) {
            return false;
        }else {
            return true;
        }
    }

    /* 
    despues de verificar la vida del personaje si este fue eliminado, 
    este metodo lo elimina de su lista.
    */
    private static function eliminarPersonaje(): bool
    {

        


        return true;
    }

    //devuelve la cantidad de personajes que quedan en todas las listas
    private static function cant_personajes(): array
    {
        return [];
    }
    /* 
    este método guarda el registro de cada enfrentamiento, quien 
    se enfrentó a quien cuántos puntos de daño hizo y la vida del 
    personaje atacado.
    */
    private static function registroCombate(): void
    {
    }

    /*
     cambia el estado del juego a TERMINADO si la cantidad de jugadores de 
     un equipo es igual a 0
    */
    private static function finalizarJuego(): void
    {
    }

    /* 
    muestra los personajes que tienen todos los jugadores o uno 
    en particular con nombre, tipo de personaje, vida, armas, habilidades, 
    mana(en el caso que use)
    */
    private static function listarPersonajes($jugador = null): void
    {
    }
    /*
    evalúa cual de los equipos es el ganador, para eso debe evaluar 
    cuál equipo quedó con al menos un personaje y el otro con 0 personajes 
    */
    private static function mostrarGanador(): void
    {
    }

    /* 
     vuelve a reiniciar el juego siempre y cuando no este en 
     estado NO_INICIADO
    */
    private static function reiniciar(): void
    {
    }

    /* 
     vuelve a reiniciar el juego siempre y cuando no este en 
     estado NO_INICIADO
    */
    private static function juegoNuevo(): void
    {
    }
}
Juego::iniciar();
Juego::iniciarCombate();
