<link rel="stylesheet" href="assets/css/styles.css">
<div class="container">
    <?php
    ob_start(); 
    include 'includes/header.php';
    include 'includes/api_client.php';
    

    $successMessage = null;
    $errorMessage = null;

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
            $successMessage = $translations['success_edit_contact'];
            try {
                $ubicaciones = apiRequest("GET", "contactos/$id");
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
            $ubicaciones = apiRequest("GET", "contactos/$id");
            $ubicacion = $ubicaciones[0];
        } catch (Exception $e) {
            echo "<p>Error: {$e->getMessage()}</p>";
            exit;
        }
    }
    ?>
    <h1><?= $translations['edit_contact'] ?></h1>

    <?php
    if ($successMessage) {
        echo "<p style='color: green;'>{$successMessage}</p>";
    } elseif ($errorMessage) {
        echo "<p style='color: red;'>{$errorMessage}</p>";
    }
    ?>
    
    <form method="POST">
        <label><?= $translations['greeting'] ?>:</label>
        <input type="text" name="saludo" value="<?= htmlspecialchars($ubicacion[1]) ?>" required><br>
        <label><?= $translations['full_name'] ?>:</label>
        <input type="text" name="nombre_completo" value="<?= htmlspecialchars($ubicacion[2]) ?>" required><br>
        <label><?= $translations['id_number'] ?>:</label>
        <input type="text" name="numero_identificacion" value="<?= htmlspecialchars($ubicacion[3]) ?>" required><br>
        <label><?= $translations['email'] ?>:</label>
        <input type="email" name="correo" value="<?= htmlspecialchars($ubicacion[4]) ?>" required><br>
        <label><?= $translations['phone'] ?>:</label>
        <input type="text" name="telefono" value="<?= htmlspecialchars($ubicacion[5]) ?>" required><br>
        <label><?= $translations['photo'] ?>:</label>
        <input type="text" name="fotografia" value="<?= htmlspecialchars($ubicacion[6]) ?>"><br>
        <button type="submit"><?= $translations['update'] ?></button>
    </form>

    <?php include 'includes/footer.php'; ?>
</div>