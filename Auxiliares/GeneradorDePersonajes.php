<?php

declare(strict_types=1);
require_once "GDA.php";
spl_autoload_register(function ($nombre_clase) {
    if (array_search($nombre_clase, GeneradorDePersonajes::archivoAarray("./Arma/")) !== false) {
        include  "./Arma/" . $nombre_clase . '.php';
    }
    if (array_search($nombre_clase, GeneradorDePersonajes::archivoAarray('./Personaje/Heroes/')) !== false) {
        include  "./Personaje/Heroes/" . $nombre_clase . '.php';
    }    # esta funcion se ejecuta tantas veces 
    if (array_search($nombre_clase, GeneradorDePersonajes::archivoAarray('./Personaje/Monstruos/')) !== false) {

        include  "./Personaje/Monstruos/" . $nombre_clase . '.php';
    }

    // como clases sean necesarias
});
final class GeneradorDePersonajes
{
    const MAX_ARMAS = 6;
    const MIN_ARMAS = 1;
    const MIN_NUM = 1;
    const MAX_NUM = 3;
    const HEROES = "Heroes";
    const MONSTRUOS = "Monstruos";

    //----- metodos ---- //
    public static function archivoAarray(string $dir): array
    {

        $nombre_ficheros = array_diff(scandir($dir), array("..", ".", "Arma.php"));
        foreach ($nombre_ficheros as $nombre_fichero) {
            $nombres_clases[] = strstr($nombre_fichero, ".", true);
        }
        return $nombres_clases;
    }
    /**
     * @param string $tipo tipo de personaje a Crear heroe o monstruo
     * @return array[@type Personaje ]
     */
    public static function crearPersonajes(string $tipo): array
    {
        $dir = "./Personaje/$tipo";
        $class_personajes = self::archivoAarray($dir);
        if ($tipo == self::MONSTRUOS) {
            foreach ($class_personajes as $personaje) {
                $listaPersonajes[] = new $personaje(nombre: GDA::generarNombre($tipo), habilidades: self::agregarHabilidades());
            }
        }
        if ($tipo === self::HEROES) {
            foreach ($class_personajes as $personaje) {
                $listaPersonajes[] = new $personaje(nombre: GDA::generarNombre($tipo));
            }
        }
        return $listaPersonajes;
    }
    public static function crearArmas(): array
    {
        $class_armas = self::archivoAarray("./Arma/");
        foreach ($class_armas as $arma) {
            $listaArmas[] = new $arma(nombre: GDA::generarNombreArmas());
            # code...
        }
        return $listaArmas;
    }
    public static function crearHabilidades(): string
    {
        return GDA::generarHabilidades();
    }
    /** 
     * @param Personaje[] $personajes 
     */

    public static function agregarArmas(array $personajes): void
    {
        foreach ($personajes as $personaje) {
            $lista_de_armas = self::crearArmas();
            $cant_armas_set = rand(self::MIN_ARMAS, self::MAX_ARMAS);

            for ($i = 0; $i < $cant_armas_set; $i++) {
                $indice = array_rand($lista_de_armas);
                $armaNueva = $lista_de_armas[$indice];
                $personaje->agregarArma($armaNueva);
                unset($lista_de_armas[$indice]);
            }
        }
    }
    /**
     * @return array@type string
     */
    public static function agregarHabilidades(): array
    {
        $habilidades_a_agregrar = rand(self::MIN_NUM, self::MAX_NUM);
        $lista_habilidades = [];
        for ($i = 0; $i < $habilidades_a_agregrar; $i++) {
            $lista_habilidades[] = GDA::generarHabilidades();
        }
        return $lista_habilidades;
    }
}
