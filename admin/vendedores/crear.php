<?php

require '../../includes/App.php';

use App\Vendedor;

// Proteger esta ruta.
estaAutenticado();

$vendedor = new Vendedor;

// arreglo con mensaje de errores
$errores = Vendedor::getErrores();

// jecutar codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Crear una nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);

    //Validar que no haya campos vacios 
    $errores = $vendedor->validar();

    // No hay errores
    if(empty($errores)) {
        $vendedor->guardar();
    }

}

incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Registrar Vendedor</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
        <?php include '../../includes/templates/formulario_vendedores.php' ; ?>
        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">

    </form>

</main>

<?php
incluirTemplate('footer');
?>