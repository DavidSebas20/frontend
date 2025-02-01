<div class="container">
    <?php
    include 'includes/header.php';
    include 'includes/api_client.php';

    $ubicaciones = apiRequest("GET", "ubicaciones");
    ?>

    <link rel="stylesheet" href="assets/css/styles.css">
    <h1><?= $translations['manage_locations'] ?></h1>
    <table>
        <thead>
            <tr>
                <th><?= $translations['title'] ?></th>
                <th><?= $translations['address'] ?></th>
                <th><?= $translations['created_at'] ?></th>
                <th><?= $translations['actions'] ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ubicaciones as $ubicacion): ?>
                <tr>
                    <td><?= htmlspecialchars($ubicacion[1]) ?></td>
                    <td><?= htmlspecialchars($ubicacion[2]) ?></td>
                    <td><?= htmlspecialchars($ubicacion[5]) ?></td>
                    <td>
                        <a href="https://www.google.com/maps?q=<?= $ubicacion[3] ?>,<?= $ubicacion[4] ?>" class="btn btn-map"><?= $translations['btn_location'] ?></a>
                        <a href="editar_ubicacion.php?id=<?= $ubicacion[0] ?>&lang=<?= $lang ?>" class="btn btn-editar"><?= $translations['btn_edit'] ?></a>
                        <a href="eliminar_ubicacion.php?id=<?= $ubicacion[0] ?>&lang=<?= $lang ?>" class="btn btn-eliminar" onclick="return confirm('<?= $translations['btn_confirm_location'] ?>')"><?= $translations['btn_delete'] ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include 'includes/footer.php'; ?>
</div>