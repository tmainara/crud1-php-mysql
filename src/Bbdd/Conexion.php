<?php
namespace App\Bbdd;

use \PDO;
use \PDOException;

abstract class Conexion{
    private static ?PDO $conexion=null;

    protected static function getConexion(): PDO{
        if (self::$conexion==null) {
            //setearemos la conexion
            self::setConexion();
        }
        return self::$conexion;
    }

    public static function setConexion(){
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__."/../../");
        $dotenv->load();
        $usuario=$_ENV['USUARIO'];
        $db=$_ENV['DATABASE'];
        $port=$_ENV['PORT'];
        $host=$_ENV['HOST'];
        $password=$_ENV['PASSWORD'];

        //CREAMOS EL DESCRIPTOR DE LA CONEXION DSN
        $dsn="mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4";
        //CREAMOS UN ARRAY DE OPCIONES
        $opciones=[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES=>false,
            PDO::ATTR_PERSISTENT=>false,
        ];

        try {
            self::$conexion=new PDO($dsn,$usuario,$password,$opciones);
        } catch (PDOException $ex) {
            throw new PDOException("Error en la conexión:".$ex->getMessage());
        }
    }

}