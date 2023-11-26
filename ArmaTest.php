<?php

declare(strict_types=1);
spl_autoload_register(function ($nombre_clase) {
    include $nombre_clase . '.php';
});

class ArmaTest
{
    public $espada, $conjuro, $hechizo, $arco, $lanza, $escudo;

    public function crearArmasTest(): void
    {
        $this->espada = new Espada(nombre: "Espada Sagrada");
        $this->conjuro = new Conjuro(nombre: "Defensa infernal");
        $this->hechizo = new Hechizo(nombre: "Abismo Negro");
        $this->arco = new Arco(nombre: "Arco Elfico");
        $this->lanza = new Lanza(nombre: "Lanza del destino");
        $this->escudo = new Escudo(nombre: "Escudo de Madera");
    }
    public function agregarGemasEspada(): void
    {
        $this->espada->agregarGema("azul");
        $this->espada->agregarGema("Ambar");
        $this->espada->agregarGema("Oscura");
        $this->espada->agregarGema("Celestial");
        $this->espada->agregarGema("Cristal");
        $this->quitarGemasEspada();
        $this->espada->agregarGema("Cristal");
    }
    public function quitarGemasEspada(): void
    {
        $this->espada->quitarGema("azul");
    }
}
$test = new ArmaTest;
$test->crearArmasTest();
// $test->quitarGemasEspada();
// $test->agregarGemasEspada();
// print_r($test->espada);
// $test->quitarGemasEspada();
print_r($test->hechizo);
