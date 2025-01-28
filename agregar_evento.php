<link rel="stylesheet" href="assets/css/styles.css">
<div class="container">
    <?php
    ob_start();
    include 'includes/header.php';
    include 'includes/api_client.php';

    $successMessage = null;
    $errorMessage = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $recordatorio = ($_POST['recordatorio'] === 'true' || $_POST['recordatorio'] === '1') ? true : false;

        $data = [
            'id' => 0,
            'titulo' => $_POST['titulo'],
            'invitados' => $_POST['invitados'],
            'fechaHora' => $_POST['fecha_hora'],
            'zonaHoraria' => $_POST['zona_horaria'],
            'descripcion' => $_POST['descripcion'],
            'clasificacion' => $_POST['clasificacion'],
            'lugar' => $_POST['lugar'],
            'recordatorio' => $recordatorio
        ];

        try {
            apiRequest("POST", "eventos", $data);
            $successMessage = $translations['success_add_event'];
        } catch (Exception $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
    ?>
    <h1><?= $translations['add_event'] ?></h1>
    <?php
    if ($successMessage) {
        echo "<p style='color: green;'>{$successMessage}</p>";
    } elseif ($errorMessage) {
        echo "<p style='color: red;'>{$errorMessage}</p>";
    }
    ?>
    <form method="POST">
        <label><?= $translations['title'] ?>:</label>
        <input type="text" name="titulo" required><br>

        <label><?= $translations['invited'] ?>:</label>
        <input type="text" name="invitados" required><br>

        <label><?= $translations['date_time'] ?>:</label>
        <input type="datetime-local" name="fecha_hora" required><br>

        <label><?= $translations['time_zone'] ?>:</label>
        <input type="text" name="zona_horaria" required><br>

        <label><?= $translations['description'] ?>:</label>
        <textarea name="descripcion" required></textarea><br>

        <label><?= $translations['classification'] ?>:</label>
        <input type="text" name="clasificacion" required><br>

        <label><?= $translations['place'] ?>:</label>
        <input type="text" name="lugar" required><br>

        <label><?= $translations['reminder'] ?>:</label>
        <select name="recordatorio" required>
            <option value="true"><?= $translations['si'] ?></option>
            <option value="false"><?= $translations['no'] ?></option>
        </select><br>

        <button type="submit"><?= $translations['save'] ?></button>
    </form>

    <?php include 'includes/footer.php'; ?>

</div>