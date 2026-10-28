<?php
namespace App\Bbdd;

use \PDO;
use \PDOException;

class Articulo extends Conexion{
    private int $id;
    private string $nombre;
    private string $descripcion;

    //CRUD______________
    public function create(){
        $q="insert into articulos(nombre,descripcion) values(:n,:d)";
        // $q="insert into articulos(nombre,descripcion) values(?,?)";
        //USAREMOS CONSULTAS PREPARADAS PARA EVITAR INYECCIÓN DE CODIGO MYSQL MALICIOSO
        $stmt=parent::getConexion()->prepare($q);
        try {
            $stmt->execute([
                ':n'=>$this->nombre,
                ':d'=>$this->descripcion,
            ]);
        } catch (PDOException $ex) {
            die("Error en insertar:".$ex->getMessage());
        }
    }

    public static function registrosFalsos(int $cantidad){
        $faker = \Faker\Factory::create('es_ES');
        for ($i=0; $i < $cantidad; $i++) { 
            $nombre = $faker->unique()->words(2,true);
            $descripcion = $faker->text();
            (new Articulo())
                ->setNombre($nombre)
                ->setDescripcion($descripcion)
                ->create();
        }
    }

    public static function borrarTodo(?int $id=null):void{
        $q=($id===null)? "delete from articulos" :"delete from articulos where id=:i";
        $stmt=parent::getConexion()->prepare($q);
        try {
            ($id===null)? $stmt->execute() : $stmt->execute([':i'=>$id]);
        } catch (PDOException $ex) {
            die("Error en borrar todo:".$ex->getMessage());
        }

    }

    /*public static function borrarPorId(int $id){
        $q="delete from articulos where id=:i";
        $stmt=parent::getConexion()->prepare($q);
        try {
            $stmt->execute([':i'=>$id]);
        } catch (PDOException $ex) {
            die("Error en borrar todo:".$ex->getMessage());
        }
    }*/

    public static function devolverTodo():array{
        $q="select * from articulos order by id desc";
        $stmt=parent::getConexion()->prepare($q);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            die("Error en devolver todo:".$ex->getMessage());
        }
    }
    
    public static function existeNombre(string $nombre, ?int $id=null):bool{
        $q=($id===null)? "select 1 from articulos where nombre=:n": "select 1 from articulos where nombre=:n AND id!= :i";
        $stmt=parent::getConexion()->prepare($q);
        try {
            ($id=== null)? $stmt->execute([':n'=>$nombre]) : $stmt->execute([':n'=>$nombre, ':i'=>$id]) ;
        } catch (PDOException $ex) {
            die("Error no existeNombre:".$ex->getMessage());
        }
        return count($stmt->fetchAll(PDO::FETCH_OBJ))!=0;
    }
    public static function devolverArticuloPorId(int $id): array{
        $q="select * from articulos where id=?";
        $stmt=parent::getConexion()->prepare($q);
        try {
            $stmt->execute([$id]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            die("Error buscar ID:".$ex->getMessage());
        }
    }
    public function update(int $id){
        $q="update articulos set nombre=:n, descripcion=:d where id=:i";
        $stmt=parent::getConexion()->prepare($q);
        try {
            $stmt->execute([':n'=>$this->nombre,':d'=>$this->descripcion, ':i'=>$id]);
        } catch (PDOException $ex) {
            die("Error en update:".$ex->getMessage());
        }

    }

    /**
     * Get the value of id
     */ 
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id):self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre():string
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre(string $nombre):self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion():string
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion(string $descripcion):self
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}