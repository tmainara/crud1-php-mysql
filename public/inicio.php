<?php
session_start();

use App\Bbdd\Articulo;

require __DIR__ . "/../vendor/autoload.php";

$articulos = Articulo::devolverTodo();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- CDN SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>


    <!-- CONTENEDOR EXTERIOR -->
    <div class="mx-auto max-w-6xl px-4 py-8">

        <div class="flex flex-row-reverse mb-2">
            <a href="create.php" class="my-4 rounded-xl p-2 bg-green-600 hover:bg-green-800 text-white font-bold">Crear Artículo</a>
        </div>
        <!-- CONTENEDOR DE LA TABLA -->
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">

            <table class="w-full text-left text-sm text-gray-600">

                <!-- CABECERA DE LA TABLA -->
                <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">ID</th>
                        <th class="px-6 py-4 font-semibold">Nombre</th>
                        <th class="px-6 py-4 font-semibold">Descripción</th>
                        <th class="px-6 py-4 text-center font-semibold">Acciones</th>
                    </tr>
                </thead>

                <!-- CUERPO DE LA TABLA -->
                <tbody class="divide-y divide-gray-100">

                    <?php foreach ($articulos as $item): ?>

                        <tr class="transition hover:bg-gray-50">

                            <td class="px-6 py-5 font-medium text-gray-900">
                                <?= $item->id ?>
                            </td>

                            <td class="px-6 py-5">
                                <span class="font-semibold text-gray-900">
                                    <?= $item->nombre ?>
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <span class="text-gray-500">
                                    <?= $item->descripcion ?>
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <form action="borrar.php" method="post">
                                    <input type="hidden" name="id" value="<?= $item->id ?>">
                                    <div class="flex justify-center gap-2">

                                        <a href="editar.php?id=<?= $item->id ?>"  class="rounded-lg bg-blue-50 px-3 py-2 font-medium text-blue-600 transition hover:bg-blue-100">
                                            Editar
                                        </a>

                                        <button type="submit" class="rounded-lg bg-red-50 px-3 py-2 font-medium text-red-600 transition hover:bg-red-100">
                                            Eliminar
                                        </button>

                                    </div>
                                </form>
                            </td>

                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>

        </div>

    </div>
    <?php
    if (isset($_SESSION['mensaje']))
        echo <<<TXT
<script>
Swal.fire({
    position: "top-end",
    icon: "success",
    title: "{$_SESSION['mensaje']}",
    showConfirmButton: false,
    timer: 1500
    });
</script>
TXT;
    unset($_SESSION['mensaje']);
    ?>
</body>

</html>