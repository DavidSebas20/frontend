<?php
include 'includes/header.php';
include 'includes/api_client.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Saludo' => $_POST['saludo'],
        'NombreCompleto' => $_POST['nombre_completo'],
        'NumeroIdentificacion' => $_POST['numero_identificacion'],
        'CorreoElectronico' => $_POST['correo'],
        'NumeroTelefono' => $_POST['telefono'],
        'Fotografia' => $_POST['fotografia']
    ];

    try {
        apiRequest("PUT", "contactos/$id", $data);
        header("Location: contactos.php");
        exit;
    } catch (Exception $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
    }
} else {
    try {
        $ubicaciones = apiRequest("GET", "contactos/$id");
        $ubicacion = $ubicaciones[0];
    } catch (Exception $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
        exit;
    }
}
?>
<link rel="stylesheet" href="assets/css/styles.css">

<h1>Editar Contacto</h1>
<form method="POST">
    <label>Saludo:</label>
    <input type="text" name="saludo" value="<?= htmlspecialchars($ubicacion[1]) ?>" required><br>
    <label>Nombre Completo:</label>
    <input type="text" name="nombre_completo" value="<?= htmlspecialchars($ubicacion[2]) ?>" required><br>
    <label>Número de Identificación:</label>
    <input type="text" name="numero_identificacion" value="<?= htmlspecialchars($ubicacion[3]) ?>" required><br>
    <label>Correo Electrónico:</label>
    <input type="email" name="correo" value="<?= htmlspecialchars($ubicacion[4]) ?>" required><br>
    <label>Teléfono:</label>
    <input type="text" name="telefono" value="<?= htmlspecialchars($ubicacion[5]) ?>" required><br>
    <label>Fotografía (URL):</label>
    <input type="text" name="fotografia" value="<?= htmlspecialchars($ubicacion[6]) ?>"><br>
    <button type="submit">Actualizar</button>
</form>

<?php include 'includes/footer.php'; ?>
