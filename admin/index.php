<?php
    include '../includes/App.php';

    // Proteger esta ruta
    estaAutenticado();

    // Importar clases
    use App\Propiedad;
    use App\Vendedor;

    // Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Validar ID
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {
            $tipo = $_POST['tipo'];
            if(validarTipoContenido($tipo)) {
                // Compara lo que vamos a eliminar
                if($tipo === 'vendedor') {
                    // Obtener la propiedad
                    $vendedor = Vendedor::find($id);
                    // Eliminar propiedad
                    $vendedor->eliminar();
                } else if($tipo === 'propiedad') {
                    // Obtener la propiedad
                    $propiedad = Propiedad::find($id);
                    // Eliminar propiedad
                    $propiedad->eliminar();
                }
            }

            // Sanitizar número entero
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        }
    }

    // Importar el Template
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1 class="fw-300 centrar-texto">Administrador de Bienes Raices</h1>

    <?php
        $mensaje = mostrarNotificacion( intval($resultado) );
        if($mensaje) { ?>
        <p class="alerta exito"><?php echo s($mensaje) ?> </p>
    <?php } ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ( $propiedades as $propiedad ) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>
                        <img src="/imagenes/<?php echo $propiedad->imagen; ?>"" width=" 100" class="imagen-tabla">
                    </td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton boton-rojo" value="Eliminar">
                        </form>

                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo">Actualizar</a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ( $vendedores as $vendedor ) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton boton-rojo " value="Eliminar">
                        </form>

                        <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton boton-amarillo">Actualizar</a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php
incluirTemplate('footer');
?>