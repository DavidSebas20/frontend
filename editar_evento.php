<link rel="stylesheet" href="assets/css/styles.css">

<div class="container">
    <?php
    include 'includes/header.php';
    include 'includes/language.php';

    $id = $_GET['id'];

    $successMessage = null;
    $errorMessage = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $recordatorio = ($_POST['recordatorio'] === 'true' || $_POST['recordatorio'] === '1') ? true : false;

        $data = [
            'id' => $id,
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
            apiRequest("PUT", "eventos/$id", $data);
            $successMessage = $translations['success_edit_event'];
            try {
                $ubicaciones = apiRequest("GET", "eventos/$id");
                $ubicacion = $ubicaciones[0];
            } catch (Exception $e) {
                echo "<p>Error: {$e->getMessage()}</p>";
                exit;
            }
        } catch (Exception $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    } else {
        try {
            $ubicaciones = apiRequest("GET", "eventos/$id");
            $ubicacion = $ubicaciones[0];
        } catch (Exception $e) {
            echo "<p>Error: {$e->getMessage()}</p>";
            exit;
        }
    }
    ?>

    <h1><?= $translations['edit_event'] ?></h1>
    
    <?php
    if ($successMessage) {
        echo "<p style='color: green;'>{$successMessage}</p>";
    } elseif ($errorMessage) {
        echo "<p style='color: red;'>{$errorMessage}</p>";
    }
    ?>

    <form method="POST">
        <label><?= $translations['title'] ?>:</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($ubicacion[1]) ?>" required><br>

        <label><?= $translations['invited'] ?>:</label>
        <input type="text" name="invitados" value="<?= htmlspecialchars($ubicacion[2]) ?>" required><br>

        <label><?= $translations['date_time'] ?>:</label>
        <input type="datetime-local" name="fecha_hora" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($ubicacion[3]))) ?>" required><br>

        <label><?= $translations['time_zone'] ?>:</label>
        <input type="text" name="zona_horaria" value="<?= htmlspecialchars($ubicacion[4]) ?>" required><br>

        <label><?= $translations['description'] ?>:</label>
        <textarea name="descripcion" required><?= htmlspecialchars($ubicacion[5]) ?></textarea><br>

        <label><?= $translations['classification'] ?>:</label>
        <input type="text" name="clasificacion" value="<?= htmlspecialchars($ubicacion[6]) ?>" required><br>

        <label><?= $translations['place'] ?>:</label>
        <input type="text" name="lugar" value="<?= htmlspecialchars($ubicacion[7]) ?>" required><br>

        <label><?= $translations['reminder'] ?>:</label>
        <select name="recordatorio" required>
            <option value="true" <?= $ubicacion[8] ? 'selected' : '' ?>><?= $translations['si'] ?></option>
            <option value="false" <?= !$ubicacion[8] ? 'selected' : '' ?>><?= $translations['no'] ?></option>
        </select><br>

        <button type="submit"><?= $translations['update'] ?></button>
    </form>

    <?php include 'includes/footer.php'; ?>
</div>