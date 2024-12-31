<link rel="stylesheet" href="assets/css/styles.css">
<div class="container">
    
    <?php
    include 'includes/header.php';
    include 'includes/api_client.php';

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
            apiRequest("POST", "contactos", $data);
            header("Location: contactos.php");
            exit;
        } catch (Exception $e) {
            echo "<p>Error: {$e->getMessage()}</p>";
        }
    }
    ?>
    <h1>Agregar Contacto</h1>
    <form method="POST">
        <label>Saludo:</label>
        <input type="text" name="saludo" required><br>
        <label>Nombre Completo:</label>
        <input type="text" name="nombre_completo" required><br>
        <label>Número de Identificación:</label>
        <input type="text" name="numero_identificacion" required><br>
        <label>Correo Electrónico:</label>
        <input type="email" name="correo" required><br>
        <label>Teléfono:</label>
        <input type="text" name="telefono" required><br>
        <label>Fotografía (URL):</label>
        <input type="text" name="fotografia"><br>
        <button type="submit">Guardar</button>
    </form>
    <?php include 'includes/footer.php'; ?>
</div>