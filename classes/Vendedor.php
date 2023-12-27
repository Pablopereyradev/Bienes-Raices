<?php
namespace App;

class vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores'; 
    protected static $columnas_DB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar()
    {

        if (!$this->nombre) {
            self::$errores[] = 'El Nombre es obligatorio';
        }

        if (!$this->apellido) {
            self::$errores[] = 'El Apellido es obligatorio';
        }

        if (!$this->telefono) {
            self::$errores[] = 'El Telefono es obligatorio';
        }

        if (!preg_match( '/^(?:(?:00)?549?)?0?(?:11|[2368]\d)(?:(?=\d{0,2}15)\d{2})??\d{8}$/', $this->telefono )) {
            self::$errores[] = 'Telefono no Válido';
        }

        return self::$errores;
    }
}