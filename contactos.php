<div class="container">
    <?php
    include 'includes/header.php';
    include 'includes/api_client.php';


    $ubicaciones = apiRequest("GET", "contactos");
    ?>
    <link rel="stylesheet" href="assets/css/styles.css">

    <h1><?= $translations['manage_contacts'] ?></h1>
    <table>
        <thead>
            <tr>
                <th><?= $translations['greeting'] ?></th>
                <th><?= $translations['full_name'] ?></th>
                <th><?= $translations['email'] ?></th>
                <th><?= $translations['phone'] ?></th>
                <th><?= $translations['image'] ?></th>
                <th><?= $translations['created_at'] ?></th>
                <th><?= $translations['actions'] ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ubicaciones as $ubicacion): ?>
                <tr>
                    <td><?= htmlspecialchars($ubicacion[1]) ?></td>
                    <td><?= htmlspecialchars($ubicacion[2]) ?></td>
                    <td><?= htmlspecialchars($ubicacion[4]) ?></td>
                    <td><?= htmlspecialchars($ubicacion[5]) ?></td>
                    <td>
                        <img src="<?= htmlspecialchars($ubicacion[6]) ?>" alt="Imagen de contacto" class="imagen-tabla">
                    </td>
                    <td><?= htmlspecialchars($ubicacion[7]) ?></td>
                    <td>
                        <a href="editar_contacto.php?id=<?= $ubicacion[0] ?>" class="btn btn-editar"><?= $translations['btn_edit'] ?></a>
                        <a href="eliminar_contacto.php?id=<?= $ubicacion[0] ?>" class="btn btn-eliminar" onclick="return confirm('<?= $translations['btn_confirm'] ?>')"><?= $translations['btn_delete'] ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include 'includes/footer.php'; ?>
</div>