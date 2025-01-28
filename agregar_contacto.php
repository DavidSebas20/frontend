<link rel="stylesheet" href="assets/css/styles.css">
<div class="container">
    <?php
    ob_start(); 
    include 'includes/header.php';
    include 'includes/api_client.php';

    $successMessage = null; 
    $errorMessage = null;   

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
            $successMessage = $translations['success_add_contact'];
        } catch (Exception $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
    ?>
    <h1><?= $translations['add_contact'] ?></h1>
    <?php
    if ($successMessage) {
        echo "<p style='color: green;'>{$successMessage}</p>";
    } elseif ($errorMessage) {
        echo "<p style='color: red;'>{$errorMessage}</p>";
    }
    ?>
    <form method="POST">
        <label><?= $translations['greeting'] ?>:</label>
        <input type="text" name="saludo" required><br>
        <label><?= $translations['full_name'] ?>:</label>
        <input type="text" name="nombre_completo" required><br>
        <label><?= $translations['id_number'] ?>:</label>
        <input type="text" name="numero_identificacion" required><br>
        <label><?= $translations['email'] ?>:</label>
        <input type="email" name="correo" required><br>
        <label><?= $translations['phone'] ?>:</label>
        <input type="text" name="telefono" required><br>
        <label><?= $translations['photo'] ?>:</label>
        <input type="text" name="fotografia"><br>
        <button type="submit"><?= $translations['save'] ?></button>
    </form>
    <?php include 'includes/footer.php'; ?>
</div>
