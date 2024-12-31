<div class="container">
    <?php
    include 'includes/header.php';
    include 'includes/api_client.php';

    $ubicaciones = apiRequest("GET", "ubicaciones");
    ?>

    <link rel="stylesheet" href="assets/css/styles.css">
    <h1>Gestión de Ubicaciones</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ubicaciones as $ubicacion): ?>
                <tr>
                    <td><?= htmlspecialchars($ubicacion[1]) ?></td>
                    <td><?= htmlspecialchars($ubicacion[2]) ?></td>
                    <td>
                        <a href="https://www.google.com/maps?q=<?= $ubicacion[3] ?>,<?= $ubicacion[4] ?>" class="btn btn-map">Ver Ubicacion</a>
                        <a href="editar_ubicacion.php?id=<?= $ubicacion[0] ?>" class="btn btn-editar">Editar</a>
                        <a href="eliminar_ubicacion.php?id=<?= $ubicacion[0] ?>" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar esta ubicación?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include 'includes/footer.php'; ?>
</div>