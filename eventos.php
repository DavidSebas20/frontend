<div class="container">
    <?php
    include 'includes/header.php';
    include 'includes/api_client.php';

    $ubicaciones = apiRequest("GET", "eventos");
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <h1>Gestión de Eventos</h1>
    <table>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Invitados</th>
                <th>Fecha Hora</th>
                <th>Zona Horaria</th>
                <th>Descripcion</th>
                <th>Clasificacion</th>
                <th>Lugar</th>
                <th>Recordatorio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ubicaciones as $ubicacion): ?>
                <tr>
                    <td><?= htmlspecialchars($ubicacion[1]) ?></td> <!-- Titulo -->
                    <td><?= htmlspecialchars($ubicacion[2]) ?></td> <!-- Invitados -->
                    <td><?= htmlspecialchars($ubicacion[3]) ?></td> <!-- Fecha Hora -->
                    <td><?= htmlspecialchars($ubicacion[4]) ?></td> <!-- Zona Horaria -->
                    <td><?= htmlspecialchars($ubicacion[5]) ?></td> <!-- Descripcion -->
                    <td><?= htmlspecialchars($ubicacion[6]) ?></td> <!-- Clasificacion -->
                    <td><?= htmlspecialchars($ubicacion[7]) ?></td> <!-- Lugar -->
                    <td>
                        <?php if ($ubicacion[8] == 1): ?>
                            <i class="fa fa-check-circle" style="color: green;"></i>
                        <?php else: ?>
                            <i class="fa fa-times-circle" style="color: red;"></i>
                        <?php endif; ?>
                    </td>


                    <td>
                        <a href="editar_evento.php?id=<?= $ubicacion[0] ?>" class="btn btn-editar">Editar</a>
                        <a href="eliminar_evento.php?id=<?= $ubicacion[0] ?>" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este evento?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include 'includes/footer.php'; ?>
</div>