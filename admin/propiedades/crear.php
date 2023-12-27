<?php
require '../../includes/App.php';
use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

// Proteger esta ruta.
estaAutenticado();

$propiedad = new Propiedad;

// Consulta para obtener todos los vendedores
$vendedores = Vendedor::all();

// arreglo con mensaje de errores
$errores = Propiedad::getErrores();

// jecutar codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Crea una nueva instancia
    $propiedad = new Propiedad($_POST['propiedad']);

    /** SUBIDA DE ARCHIVOS */
    // Crear carpeta 
    $carpetaImagenes = '../../imagenes/';
    if (!is_dir($carpetaImagenes)) {
        mkdir($carpetaImagenes);
    }

    // Generar un nombre unico
    $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

    // Setear la imagen
    // Realiza una resize a la imagen con intervention
    if($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
    }

    // Validar
    $errores = $propiedad->validar();
 
    // El array de errores esta vacio
    if (empty($errores)) {
        // Crear la carpeta para subir imagenes
        if(!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
 
        // Guardar la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        // Guarda en la DB
        $propiedad->guardar() ;
    }
}

?>

<?php
$nombrePagina = 'Crear Propiedad';

incluirTemplate('header');
?>

<h1 class="fw-300 centrar-texto">Administración - Nueva Propiedad</h1>

<main class="contenedor seccion contenido-centrado">
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php' ; ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>

</main>

<?php
incluirTemplate('footer');
?>
</html>