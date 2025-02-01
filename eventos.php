<div class="container">
    <?php
    include 'includes/header.php';
    include 'includes/api_client.php';

    $eventos = apiRequest("GET", "eventos");

    $eventosConRecordatorio = [];
    $eventosSinRecordatorio = [];
    $eventosExpirados = [];

    $fechaActual = new DateTime("now", new DateTimeZone("America/Guayaquil"));

    foreach ($eventos as $evento) {
        $fechaEvento = new DateTime($evento[3], new DateTimeZone("America/Guayaquil"));

        if ($evento[8] == 1) {
            if ($fechaEvento < $fechaActual) {
                $eventosExpirados[] = $evento;
            } else {
                $eventosConRecordatorio[] = $evento;
            }
        } else {
            $eventosSinRecordatorio[] = $evento;
        }
    }
    ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <h2><?= $translations['event_reminder'] ?></h2>
    <table>
        <thead>
            <tr>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventosConRecordatorio as $evento): ?>
                <tr>
                    <td><?= htmlspecialchars($evento[1]) ?></td>
                    <td><?= htmlspecialchars($evento[2]) ?></td>
                    <td><?= htmlspecialchars($evento[3]) ?></td>
                    <td><?= htmlspecialchars($evento[4]) ?></td>
                    <td><?= htmlspecialchars($evento[5]) ?></td>
                    <td><?= htmlspecialchars($evento[6]) ?></td>
                    <td><?= htmlspecialchars($evento[7]) ?></td>
                    <td><i class="fa fa-check-circle" style="color: green;"></i></td>
                    <td><?= htmlspecialchars($evento[9]) ?></td>
                    <td>
                        <a href="editar_evento.php?id=<?= $evento[0] ?>&lang=<?= $lang ?>" class="btn btn-editar"><?= $translations['btn_edit'] ?></a>
                        <a href="eliminar_evento.php?id=<?= $evento[0] ?>&lang=<?= $lang ?>" class="btn btn-eliminar" onclick="return confirm('<?= $translations['btn_confirm_event'] ?>')"><?= $translations['btn_delete'] ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2><?= $translations['event_no_reminder'] ?></h2>
    <table>
        <thead>
            <tr>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventosSinRecordatorio as $evento): ?>
                <tr>
                    <td><?= htmlspecialchars($evento[1]) ?></td>
                    <td><?= htmlspecialchars($evento[2]) ?></td>
                    <td><?= htmlspecialchars($evento[3]) ?></td>
                    <td><?= htmlspecialchars($evento[4]) ?></td>
                    <td><?= htmlspecialchars($evento[5]) ?></td>
                    <td><?= htmlspecialchars($evento[6]) ?></td>
                    <td><?= htmlspecialchars($evento[7]) ?></td>
                    <td><i class="fa fa-times-circle" style="color: red;"></i></td>
                    <td><?= htmlspecialchars($evento[9]) ?></td>
                    <td>
                        <a href="editar_evento.php?id=<?= $evento[0] ?>&lang=<?= $lang ?>" class="btn btn-editar"><?= $translations['btn_edit'] ?></a>
                        <a href="eliminar_evento.php?id=<?= $evento[0] ?>&lang=<?= $lang ?>" class="btn btn-eliminar" onclick="return confirm('<?= $translations['btn_confirm_event'] ?>')"><?= $translations['btn_delete'] ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2><?= $translations['event_expired'] ?></h2>
    <table>
        <thead>
            <tr>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventosExpirados as $evento): ?>
                <tr>
                    <td><?= htmlspecialchars($evento[1]) ?></td>
                    <td><?= htmlspecialchars($evento[2]) ?></td>
                    <td><?= htmlspecialchars($evento[3]) ?></td>
                    <td><?= htmlspecialchars($evento[4]) ?></td>
                    <td><?= htmlspecialchars($evento[5]) ?></td>
                    <td><?= htmlspecialchars($evento[6]) ?></td>
                    <td><?= htmlspecialchars($evento[7]) ?></td>
                    <td><i class="fa fa-check-circle" style="color: orange;"></i></td>
                    <td><?= htmlspecialchars($evento[9]) ?></td>
                    <td>
                        <a href="editar_evento.php?id=<?= $evento[0] ?>&lang=<?= $lang ?>" class="btn btn-editar"><?= $translations['btn_edit'] ?></a>
                        <a href="eliminar_evento.php?id=<?= $evento[0] ?>&lang=<?= $lang ?>" class="btn btn-eliminar" onclick="return confirm('<?= $translations['btn_confirm_event'] ?>')"><?= $translations['btn_delete'] ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include 'includes/footer.php'; ?>
</div>