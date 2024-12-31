<link rel="stylesheet" href="assets/css/styles.css">
<div class="container">
    <?php
    include 'includes/header.php';
    include 'includes/api_client.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Convertir el recordatorio a booleano
        $recordatorio = ($_POST['recordatorio'] === 'true' || $_POST['recordatorio'] === '1') ? true : false;

        $data = [
            'id' => 0, // Según tu JSON, siempre envías "id" como 0 para agregar
            'titulo' => $_POST['titulo'],
            'invitados' => $_POST['invitados'],
            'fechaHora' => $_POST['fecha_hora'], // Asegúrate de que el formato sea válido
            'zonaHoraria' => $_POST['zona_horaria'],
            'descripcion' => $_POST['descripcion'],
            'clasificacion' => $_POST['clasificacion'],
            'lugar' => $_POST['lugar'],
            'recordatorio' => $recordatorio
        ];

        try {
            apiRequest("POST", "eventos", $data);
            header("Location: eventos.php");
            exit;
        } catch (Exception $e) {
            echo "<p>Error: {$e->getMessage()}</p>";
        }
    }
    ?>
    <h1>Agregar Evento</h1>
    <form method="POST">
        <label>Título:</label>
        <input type="text" name="titulo" required><br>

        <label>Invitados:</label>
        <input type="text" name="invitados" required><br>

        <label>Fecha y Hora:</label>
        <input type="datetime-local" name="fecha_hora" required><br>

        <label>Zona Horaria:</label>
        <input type="text" name="zona_horaria" required><br>

        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea><br>

        <label>Clasificación:</label>
        <input type="text" name="clasificacion" required><br>

        <label>Lugar:</label>
        <input type="text" name="lugar" required><br>

        <label>Recordatorio:</label>
        <select name="recordatorio" required>
            <option value="true">Sí</option>
            <option value="false">No</option>
        </select><br>

        <button type="submit">Guardar</button>
    </form>

    <?php include 'includes/footer.php'; ?>

</div>