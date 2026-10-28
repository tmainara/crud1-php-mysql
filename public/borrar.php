<?php
use App\Bbdd\Articulo;
session_start();//PARA MENSAJERÍA
require __DIR__."/../vendor/autoload.php";

$id= filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
if(!$id){
    header("Location:inicio.php");
    exit;
}
//si estamos aqui es por hemos recogido el id del formulario
Articulo::borrarTodo($id);
$_SESSION['mensaje']="Se borro el artículo id=$id";
header("Location:inicio.php");