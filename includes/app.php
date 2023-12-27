<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectar a la base de datos
$db = conectarDb();

use App\ActiveRecord;

//$propiedad = new Propiedad;

ActiveRecord::setDB($db);