<?php

namespace App;

class Propiedad {

    // Base de datos
    protected static $db;

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($arg = [])
    {
        $this-> id = $arg['id'] ?? '';
        $this-> titulo = $arg['titulo'] ?? '';
        $this-> precio = $arg['precio'] ?? '';
        $this-> imagen = $arg['imagen'] ?? '';
        $this-> descripcion = $arg['descripcion'] ?? '';
        $this-> habitaciones = $arg['habitaciones'] ?? '';
        $this-> wc = $arg['wc'] ?? '';
        $this-> estacionamiento = $arg['estacionamiento'] ?? '';
        $this-> creado = date('Y/m/d');
        $this-> vendedores_id = $arg['vendedores_id'] ?? '';
    }

    public function guardar() {

        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, vendedores_id, creado  ) VALUES ( '$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion',  '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->vendedores_id', '$this->creado' )";

        $resultado = self::$db->query($query);

        debuguear($resultado);

    }

    // Definir la conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }
}