<link rel="stylesheet" href="assets/css/styles.css">
<div class="container">
    <?php
    include 'includes/header.php';
    include 'includes/api_client.php';

    // Inicializamos variables
    $resultados = [];
    $tabla = "";

    // Si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $busqueda = htmlspecialchars($_POST['busqueda']);
        $tabla = $_POST['tabla'];

        // Obtenemos todos los datos según la tabla seleccionada
        if ($tabla === "contactos") {
            $datos = apiRequest("GET", "contactos");
        } elseif ($tabla === "eventos") {
            $datos = apiRequest("GET", "eventos");
        } elseif ($tabla === "ubicaciones") {
            $datos = apiRequest("GET", "ubicaciones");
        }

        // Filtramos los resultados que coincidan con la búsqueda
        $resultados = array_filter($datos, function ($item) use ($busqueda) {
            foreach ($item as $campo) {
                if (stripos($campo, $busqueda) !== false) {
                    return true;
                }
            }
            return false;
        });
    }
    ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">


    <h1><?= $translations['search'] ?></h1>
    <form method="POST" action="consultar.php" class="form-busqueda">
        <input type="text" name="busqueda" placeholder=<?= $translations['placeholder'] ?> required>
        <div class="botones">
            <button type="submit" name="tabla" value="contactos" class="btn btn-contactos"><?= $translations['btn_search_contact'] ?></button>
            <button type="submit" name="tabla" value="eventos" class="btn btn-contactos"><?= $translations['btn_search_event'] ?></button>
            <button type="submit" name="tabla" value="ubicaciones" class="btn btn-contactos"><?= $translations['btn_search_location'] ?></button>
        </div>
    </form>

    <?php if (!empty($resultados)): ?>
        <h2>Resultados en <?= ucfirst($tabla) ?></h2>
        <table>
            <thead>
                <tr>
                    <?php if ($tabla === "contactos"): ?>
                        <th><?= $translations['greeting'] ?></th>
                        <th><?= $translations['full_name'] ?></th>
                        <th><?= $translations['email'] ?></th>
                        <th><?= $translations['phone'] ?></th>
                        <th><?= $translations['image'] ?></th>
                        <th><?= $translations['created_at'] ?></th>
                        <th><?= $translations['actions'] ?></th>
                    <?php elseif ($tabla === "eventos"): ?>
                        <th><?= $translations['title'] ?></th>
                        <th><?= $translations['invited'] ?></th>
                        <th><?= $translations['date_time'] ?></th>
                        <th><?= $translations['time_zone'] ?></th>
                        <th><?= $translations['description'] ?></th>
                        <th><?= $translations['classification'] ?></th>
                        <th><?= $translations['place'] ?></th>
                        <th><?= $translations['reminder'] ?></th>
                        <th><?= $translations['created_at'] ?></th>
                        <th><?= $translations['actions'] ?></th>
                    <?php elseif ($tabla === "ubicaciones"): ?>
                        <th><?= $translations['title'] ?></th>
                        <th><?= $translations['address'] ?></th>
                        <th><?= $translations['created_at'] ?></th>
                        <th><?= $translations['actions'] ?></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $resultado): ?>
                    <tr>
                        <?php if ($tabla === "contactos"): ?>
                            <td><?= htmlspecialchars($resultado[1]) ?></td>
                            <td><?= htmlspecialchars($resultado[2]) ?></td>
                            <td><?= htmlspecialchars($resultado[4]) ?></td>
                            <td><?= htmlspecialchars($resultado[5]) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($resultado[6]) ?>" alt="Imagen de contacto" class="imagen-tabla">
                            </td>
                            <td><?= htmlspecialchars($resultado[7]) ?></td>
                            <td>
                                <a href="editar_contacto.php?id=<?= $resultado[0] ?>&lang=<?= $lang ?>" class="btn btn-editar"><?= $translations['btn_edit'] ?></a>
                                <a href="eliminar_contacto.php?id=<?= $resultado[0] ?>&lang=<?= $lang ?>" class="btn btn-eliminar" onclick="return confirm('<?= $translations['btn_confirm'] ?>')"><?= $translations['btn_delete'] ?></a>
                            </td>
                        <?php elseif ($tabla === "eventos"): ?>
                            <td><?= htmlspecialchars($resultado[1]) ?></td>
                            <td><?= htmlspecialchars($resultado[2]) ?></td>
                            <td><?= htmlspecialchars($resultado[3]) ?></td>
                            <td><?= htmlspecialchars($resultado[4]) ?></td>
                            <td><?= htmlspecialchars($resultado[5]) ?></td>
                            <td><?= htmlspecialchars($resultado[6]) ?></td>
                            <td><?= htmlspecialchars($resultado[7]) ?></td>
                            <td>
                                <?php if ($resultado[8] == 1): ?>
                                    <i class="fa fa-check-circle" style="color: green;"></i>
                                <?php else: ?>
                                    <i class="fa fa-times-circle" style="color: red;"></i>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($resultado[9]) ?></td>
                            <td>
                                <a href="editar_evento.php?id=<?= $resultado[0] ?>&lang=<?= $lang ?>" class="btn btn-editar"><?= $translations['btn_edit'] ?></a>
                                <a href="eliminar_evento.php?id=<?= $resultado[0] ?>&lang=<?= $lang ?>" class="btn btn-eliminar" onclick="return confirm('<?= $translations['btn_confirm_event'] ?>')"><?= $translations['btn_delete'] ?></a>
                            </td>
                        <?php elseif ($tabla === "ubicaciones"): ?>
                            <td><?= htmlspecialchars($resultado[1]) ?></td>
                            <td><?= htmlspecialchars($resultado[2]) ?></td>
                            <td><?= htmlspecialchars($resultado[5]) ?></td>
                            <td>
                                <a href="https://www.google.com/maps?q=<?= $resultado[3] ?>,<?= $resultado[4] ?>" class="btn btn-map"><?= $translations['btn_location'] ?></a>
                                <a href="editar_ubicacion.php?id=<?= $resultado[0] ?>&lang=<?= $lang ?>" class="btn btn-editar"><?= $translations['btn_edit'] ?></a>
                                <a href="eliminar_ubicacion.php?id=<?= $resultado[0] ?>&lang=<?= $lang ?>" class="btn btn-eliminar" onclick="return confirm('<?= $translations['btn_confirm_location'] ?>')"><?= $translations['btn_delete'] ?></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <p><?= $translations['no_results'] ?></p>
    <?php endif; ?>

    <?php include 'includes/footer.php'; ?>
</div>