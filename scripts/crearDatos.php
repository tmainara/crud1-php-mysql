<?php

use App\Bbdd\Articulo;

require __DIR__ . "/../vendor/autoload.php";

function crearArticulos(int $cantidad)
{
    echo "\nBorrando todos los articulos";
    Articulo::borrarTodo();
    echo "\nCreando $cantidad articulos:";
    Articulo::registrosFalsos($cantidad);
    echo "\nSe han creado $cantidad articulos.";
}
echo "\n##### SCRIPT PARA CREAR ARTICULOS #######\n";

do {
    $cantidad = (int) readline("\n Dime la cantidad de articulos (10-100)");
    if ($cantidad < 10 || $cantidad > 100) {
        echo "\n Error, se esperaba un numero entre 10 y 100\n";
    } else {
        crearArticulos($cantidad);
    }
} while ($cantidad < 10 || $cantidad > 100);
