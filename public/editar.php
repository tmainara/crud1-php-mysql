<?php
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location:inicio.php");
    exit;
}

use App\Bbdd\Articulo;
use App\Utils\Validacion;

require __DIR__ . "/../vendor/autoload.php";

$arrayArticulo = Articulo::devolverArticuloPorId($id);
if (count($arrayArticulo) == 0) {
    header("Location:inicio.php");
    exit;
}

//creamos un var por cada campo
$nombre = $arrayArticulo[0]->nombre;
$descripcion = $arrayArticulo[0]->descripcion;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //recogemos y saneamos los datos que me llegan por POST en este caso
    $nombre = Validacion::limpiarCadenas($_POST['nombre']);
    $descripcion = Validacion::limpiarCadenas($_POST['descripcion']);
    //HAGO LAS VALIDACIONES QUE TOQUEN
    $errores = false;
    if (!Validacion::esLongitudCadenaValida('nombre', $nombre, 3, 40)) {
        $errores = true;
    } else {
        //la longitud es correcta comprobemos si esta duplicado
        if (Validacion::existeNombre($nombre, $id)) {
            $errores = true;
        }
    }
    if (!Validacion::esLongitudCadenaValida('descripcion', $descripcion, 10, 250)) {
        $errores = true;
    }
    //SI NO HAY ERRORES GUARDO EL ARTICULO
    if (!$errores) {
        //GUARDO EL ARTICULO
        (new Articulo())
            ->setNombre($nombre)
            ->setDescripcion($descripcion)
            ->update($id);
        $_SESSION['mensaje'] = "Se editó el artículo";
        header("Location:inicio.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Editar Artículo</title>
</head>

<body>

    <div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-10">

        <!-- CONTENEDOR DEL FORMULARIO -->
        <div class="w-full max-w-lg rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">

            <!-- TÍTULO -->
            <h1 class="mb-2 text-2xl font-bold text-gray-900">
                Editar artículo
            </h1>

            <p class="mb-8 text-sm text-gray-500">
                Rellena los siguientes campos para editar un artículo.
            </p>

            <!-- FORMULARIO -->
            <form action="<?= $_SERVER['PHP_SELF'] . "?id=$id" ?>" method="POST" class="space-y-6">

                <!-- CAMPO NOMBRE -->
                <div>
                    <label for="nombre" class="mb-2 block text-sm font-semibold text-gray-700">
                        Nombre del artículo
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        placeholder="Introduce el nombre del artículo"
                        value="<?= $nombre ?>"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required>
                    <?php Validacion::pintarError('err_nombre'); ?>
                </div>

                <!-- CAMPO DESCRIPCIÓN -->
                <div>
                    <label for="descripcion" class="mb-2 block text-sm font-semibold text-gray-700">
                        Descripción
                    </label>

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        rows="5"
                        placeholder="Describe el artículo..."
                        class="w-full resize-y rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required><?= $descripcion ?></textarea>
                    <?php Validacion::pintarError('err_descripcion'); ?>
                </div>

                <!-- BOTONES -->
                <div class="flex flex-wrap justify-end gap-3 border-t border-gray-100 pt-6">

                    <!-- BOTÓN CANCELAR: VUELVE A INICIO.PHP -->
                    <a
                        href="inicio.php"
                        class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100">
                        Cancelar
                    </a>

                    <!-- BOTÓN RESET: LIMPIA LOS CAMPOS -->
                    <button
                        type="reset"
                        class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100">
                        Limpiar
                    </button>

                    <!-- BOTÓN ENVIAR -->
                    <button
                        type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:ring-4 focus:ring-blue-100">
                        Editar artículo
                    </button>

                </div>

            </form>

        </div>

    </div>


</body>

</html>