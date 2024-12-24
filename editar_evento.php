<?php
include 'includes/header.php';
include 'includes/api_client.php';

$id = $_GET['id'];

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
        header("Location: eventos.php");
        exit;
    } catch (Exception $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
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

<link rel="stylesheet" href="assets/css/styles.css">

<h1>Editar Evento</h1>
<form method="POST">
    <label>Título:</label>
    <input type="text" name="titulo" value="<?= htmlspecialchars($ubicacion[1]) ?>" required><br>

    <label>Invitados:</label>
    <input type="text" name="invitados" value="<?= htmlspecialchars($ubicacion[2]) ?>" required><br>

    <label>Fecha y Hora:</label>
    <input type="datetime-local" name="fecha_hora" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($ubicacion[3]))) ?>" required><br>

    <label>Zona Horaria:</label>
    <input type="text" name="zona_horaria" value="<?= htmlspecialchars($ubicacion[4]) ?>" required><br>

    <label>Descripción:</label>
    <textarea name="descripcion" required><?= htmlspecialchars($ubicacion[5]) ?></textarea><br>

    <label>Clasificación:</label>
    <input type="text" name="clasificacion" value="<?= htmlspecialchars($ubicacion[6]) ?>" required><br>

    <label>Lugar:</label>
    <input type="text" name="lugar" value="<?= htmlspecialchars($ubicacion[7]) ?>" required><br>

    <label>Recordatorio:</label>
    <select name="recordatorio" required>
        <option value="true" <?= $ubicacion[8] ? 'selected' : '' ?>>Sí</option>
        <option value="false" <?= !$ubicacion[8] ? 'selected' : '' ?>>No</option>
    </select><br>

    <button type="submit">Actualizar</button>
</form>

<?php include 'includes/footer.php'; ?>
