<div class="container">
    <?php
    include 'includes/header.php';
    include 'includes/api_client.php';


    $ubicaciones = apiRequest("GET", "contactos");
    ?>
    <link rel="stylesheet" href="assets/css/styles.css">

    <h1>Gestión de Contactos</h1>
    <table>
        <thead>
            <tr>
                <th>Saludo</th>
                <th>Nombre Completo</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Imagen</th>
                <th>Acciones</th>
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
                    <td>
                        <a href="editar_contacto.php?id=<?= $ubicacion[0] ?>" class="btn btn-editar">Editar</a>
                        <a href="eliminar_contacto.php?id=<?= $ubicacion[0] ?>" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este contacto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include 'includes/footer.php'; ?>
</div>