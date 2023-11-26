<?php

final class GDA
{


    static private $heroes = array(
        "Aric Windrider",
        "Lyra Shadowbane",
        "Kael Blackthorn",
        "Elara Emberheart",
        "Thorne Ironfist",
        "Seraphina Frostwhisper",
        "Finnegan Stormrider",
        "Isolde Moonshade",
        "Ragnar Thunderforge",
        "Selene Nightstalker",
        "Orion Frostblade",
        "Aria Swiftstrike",
        "Roland Silverlight",
        "Lysandra Starfall",
        "Gideon Shadowcaster",
        "Briar Stormcaller",
        "Freya Emberstone",
        "Lucius Darkwater",
        "Sylas Frostbinder",
        "Rowan Stormwatcher"
    );
    static private $monstruos = array(
        "Grimclaw",
        "Venomspike",
        "Dreadmaw",
        "Shadowfiend",
        "Frostbite",
        "Abyssal Horror",
        "Molten Goliath",
        "Cursed Specter",
        "Soul Devourer",
        "Plaguebearer",
        "Thunderbeast",
        "Fleshrender",
        "Blightwing",
        "Doombringer",
        "Nightshade Serpent",
        "Frostfang",
        "Ebonclaw",
        "Vilescourge",
        "Chaosspawn",
        "Dreadshade"
    );
    static private array $nombresArmas = [
        "Sombra Ígnea",
        "Trueno Silente",
        "Aurora Carmesí",
        "Susurros Nocturnos",
        "Llanto Estelar",
        "Fulgor Umbrío",
        "Llamarada Celestial",
        "Éxtasis Abismal",
        "Canto Espectral",
        "Ráfaga Arcana",
        "Marea Astral",
        "Lamento Enigmático",
        "Destello Ceniciento",
        "Silueta Deslumbrante",
        "Anhelo Voraz",
        "Ecos Lunares",
        "Tormenta Insondable",
        "Esencia Umbría",
        "Centelleo Eterno",
        "Murmullos Siderales",
        "Bruma Efímera",
        "Velo Estelar",
        "Fuego Cruzado",
        "Despertar Abisal",
        "Albor Fantasmagórico",
        "Suspiro Espectral",
        "Danza de las Sombras",
        "Reflejo Estelar",
        "Maldición Silente",
        "Espíritu Errante"
    ];

    static private array $habilidadesFantasticas = [
        "Invisibilidad Arcana",
        "Corte Etéreo",
        "Flecha de la Oscuridad",
        "Telequinesis Fulgurante",
        "Sanación Astral",
        "Escudo de Espejos",
        "Llamarada Solar",
        "Eco de las Sombras",
        "Vórtice Glacial",
        "Ilusión Inquebrantable",
        "Invocación de Tormentas",
        "Aliento de Dragón",
        "Caminar entre Dimensiones",
        "Ceguera Luminosa",
        "Maldición Inexorable",
        "Espejismo Voraz",
        "Atrapar Almas",
        "Tormenta de Pétalos",
        "Golpe Celestial",
        "Rugido de la Quimera",
        "Visión del Futuro",
        "Absorción de Energía",
        "Danza de las Sombras",
        "Rejuvenecimiento Élfico",
        "Teletransporte Instantáneo",
        "Inmunidad Arcana",
        "Resonancia Sónica",
        "Explosión Ígnea",
        "Barrera de Sueños",
        "Llamado de la Naturaleza"
    ];

    static function generarNombre(string $tipo): String
    {
        if ($tipo == GeneradorDePersonajes::HEROES) {
            $indice = array_rand(self::$heroes);
            $heroe = self::$heroes[$indice];
            unset(self::$heroes[$indice]);
            return $heroe;
        } elseif ($tipo == GeneradorDePersonajes::MONSTRUOS) {
            $indice = array_rand(self::$monstruos);
            $monstruo = self::$monstruos[$indice];
            unset(self::$monstruos[$indice]);
            return $monstruo;
        }
    }
    static function generarNombreArmas(): String
    {
        return self::$nombresArmas[array_rand(self::$nombresArmas)];
    }
    static function generarHabilidades(): String
    {
        return self::$habilidadesFantasticas[array_rand(self::$habilidadesFantasticas)];
    }
}
