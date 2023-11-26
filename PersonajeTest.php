<?php

declare(strict_types=1);
require_once "Auxiliares/GeneradorDePersonajes.php";
/*  la funcion spl_autoload_register() ejecuta una callback (si es declarada)
    se utiliza para reemplazar el "include" o "require" cuando tenemos muchas clases
    que incluir.
    La misma se ejecuta antes de que ocurra un error al no encontrar las clases 
    correspondientes como última medida para cargar las  clases necesarias.
*/
//                 Funcion callback      
//                        |
//                        v
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
});

class PersonajeTest
{
    public Guerrero $guerrero;
    public Hechicero $hechicero;
    public Elfo $elfo;
    public Dragon $dragon;

    /** Metodo para crear a nuestros personajes */
    public function crearPersonajes(): void
    {
        echo "// -------- Test de Creacion de Personajes --------- \\\\\n";
        $this->guerrero = new Guerrero(nombre: "El Azote");
        if ($this->guerrero instanceof ("Guerrero")) :
            echo get_class($this->guerrero) . " creado con exito\n";
        endif;
        $this->hechicero = new Hechicero(nombre: "Mago Blanco");
        if ($this->hechicero instanceof ("Hechicero")) :
            echo get_class($this->hechicero) . " creado con exito\n";
        endif;
        $this->elfo = new Elfo(nombre: "Legolas");
        if ($this->elfo instanceof ("Elfo")) :
            echo get_class($this->elfo) . " creado con exito\n";
        endif;
        $this->dragon = new Dragon("Furia Nocturna");
        if ($this->dragon instanceof ("Dragon")) :
            echo get_class($this->dragon) . " creado con exito\n";
        endif;
        echo "// ------------- Fin Test de Creacion ------------ \\\\\n\n";
    }
    // > >>-------- testing de metodos especiales ----<< <

    # Metodos para testear agregar y quitar habildades
    public function agregarHabilidadesTest(): void
    {
        $habilidad = "Derribo Imparable";
        echo "// ----- Test de Agregar y Quitar Habilidades ------ \\\\\n";
        $this->guerrero->agregarHabilidad($habilidad);
        // busco la habilidad agregada
        echo $r = in_array($habilidad, $this->guerrero->getHabilidades()) ? "habilidad \"$habilidad\" agregada con exito\n" : "habilidad \"$habilidad\" no agregada\n";
        // intento eliminar la habilidad recien agregada
        $this->guerrero->eliminarHabilidad($habilidad);
        // busco si se elimino la habilidad
        echo $r = !in_array($habilidad, $this->guerrero->getHabilidades()) ? "habilidad \"$habilidad\" eliminada con exito\n" : "habilidad \"$habilidad\" no eliminada\n";
        echo "// --------------------- Fin Test  ------------------ \\\\\n\n";
    }

    public function agregarDebilidadesTest(): void
    {
        $debilidad = "Mago oscuro";
        $this->guerrero->agregarDebilidad($debilidad);
        echo "// ----- Test de Agregar y Quitar Debilidades ------ \\\\\n";
        // busco la habilidad agregada
        echo $r = in_array($debilidad, $this->guerrero->getDebilidades()) ? "Debilidad \"$debilidad\" agregada con exito\n" : "Debilidad \"$debilidad\" no agregada\n";
        // intento eliminar la habilidad recien agregada
        $this->guerrero->eliminarDebilidad($debilidad);
        // busco si se elimino la habilidad
        echo $r = !in_array($debilidad, $this->guerrero->getDebilidades()) ? "Debilidad \"$debilidad\" eliminada con exito\n" : "Debilidad \"$debilidad\" no eliminada\n";
        echo "// --------------------- Fin Test  ------------------ \\\\\n\n";
    }

    # Metodos para testear agregar Armas 
    public function agregarArmasTest(): void
    {
        $espada = new Espada(nombre: "Espada Sagrada");
        $conjuro = new Conjuro(nombre: "Defensa infernal");
        $hechizo = new Hechizo(nombre: "Abismo Negro");
        $arco = new Arco(nombre: "Arco Elfico");
        $lanza = new Lanza(nombre: "Lanza del destino");
        $escudo = new Escudo(nombre: "Escudo de Madera");

        $this->guerrero->agregarArma($espada);
        $this->guerrero->agregarArma($lanza);
        $this->guerrero->agregarArma($escudo);
        $this->guerrero->agregarArma($hechizo);
        $this->guerrero->agregarArma($arco);
        $this->guerrero->agregarArma($conjuro);
        // tendria que fallar // 
        $this->guerrero->agregarArma($conjuro);
    }
    public function combateTest(): void
    {
        $klzon = new Guerrero(nombre: "klzon R'0tus");
        $dragon = new Dragon(nombre: "Desazon");
        $warrior = new Guerrero(nombre: "NoName");
        $espadaSagrada = new Espada(nombre: "espada Sagrada");
        $lanza = new Lanza(nombre: "Lanza del Destino");
        $escudo = new Escudo(nombre: "portero");

        $warrior->agregarArma($espadaSagrada);
        $warrior->agregarArma($lanza);
        $warrior->agregarArma($escudo);

        $klzon->defender($dragon);
        $dragon->defender($warrior);

        if ($klzon->getVida() < 0) {
            echo "El personaje: " . $klzon->getNombre() . ' con puntos de vida ' . $klzon->getVida() . ' fue eliminado por ' . $dragon->getNombre() . "\n";
        }

        if ($dragon->getVida() > 0) {
            echo "El personaje: " . $dragon->getNombre() . ' con puntos de vida ' . $dragon->getVida() . ' fue sigue con vida y no pudo ser eliminado por ' . $warrior->getNombre() . "\n";
        }
        echo "habilidades " . implode(",", $warrior->getHabilidades());
    }
}
#CREO EL OBJETO TEST
$test = new PersonajeTest;
# INICIALIZO LOS ATRIBUTOS (objetos PERSONAJES)
$test->crearPersonajes();
// print_r($test);
// $test->agregarArmasTest();
// $test->agregarHabilidadesTest();
// $test->agregarDebilidadesTest();
// $var = new ReflectionClass($test->guerrero);
// $props = $var->getProperties();
// $props = array_column($props, "name");

// echo ">-------< *** >----------------< *** >-------< \n\n";

// foreach ($props as $index => $atributo) {

//     echo " el atributo " . $atributo . " tiene un valor de:  ";
//     if (is_array($test->guerrero->$atributo)) {
//         echo count($test->guerrero->$atributo);
//     } else {
//         print_r($test->guerrero->$atributo);
//     };
//     echo " \n";
// }
// echo " \n>-------< ************* >-------< \n";

// echo " \n>-------<< ( ARSENAL ) >>-------< \n\n";
// foreach ($test->guerrero->getArsenal() as $indice => $arma) {

//     echo "el arma en la posicion $indice es {$arma->getNombre()} de tipo "
//         . get_class($arma) . "\n";
// }
$test->combateTest();
