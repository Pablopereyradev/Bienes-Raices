<?php

require '../../includes/App.php';
use App\Vendedor;
// Proteger esta ruta.
estaAutenticado();

// Validad que sea un ID Valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}

// Obtener el arreglo del vendedor
$vendedor = Vendedor::find($id);

// arreglo con mensaje de errores
$errores = Vendedor::getErrores();

// jecutar codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los valores
    $args = $_POST['vendedor'];

    //Sincronizar objeto en memoria con el que el usuario escribio
    $vendedor->sincronizar($args);

    // Validacion
    $errores = $vendedor->validar();

    if(empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Actualizar Vendedor</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST">
        <?php include '../../includes/templates/formulario_vendedores.php' ; ?>
        <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">

    </form>

</main>

<?php
incluirTemplate('footer');
?>