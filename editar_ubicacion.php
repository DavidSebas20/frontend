<?php
include 'includes/api_client.php';

$id = $_GET['id'];

$successMessage = null; 
$errorMessage = null;   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Titulo' => $_POST['titulo'],
        'Direccion' => $_POST['direccion'],
        'Latitud' => $_POST['latitud'],
        'Longitud' => $_POST['longitud']
    ];

    try {
        apiRequest("PUT", "ubicaciones/$id", $data);
        $successMessage = $translations['add_contact'];
        try {
            $ubicaciones = apiRequest("GET", "ubicaciones/$id");
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
        $ubicaciones = apiRequest("GET", "ubicaciones/$id");
        $ubicacion = $ubicaciones[0];
    } catch (Exception $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
        exit;
    }
}
?>

<link rel="stylesheet" href="assets/css/styles.css">
<!-- Incluir Leaflet CSS y JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<div class="container">
    <?php include 'includes/header.php'; ?>
    <h1><?= $translations['edit_location'] ?></h1>
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

        <label><?= $translations['address'] ?>:</label>
        <input type="text" name="direccion" value="<?= htmlspecialchars($ubicacion[2]) ?>" id="direccion" required><br>

        <label><?= $translations['latitude'] ?>:</label>
        <input type="text" name="latitud" id="latitud" value="<?= htmlspecialchars($ubicacion[3]) ?>" readonly required><br>

        <label><?= $translations['longitude'] ?>:</label>
        <input type="text" name="longitud" id="longitud" value="<?= htmlspecialchars($ubicacion[4]) ?>" readonly required><br>

        <div id="map" style="width: 100%; height: 400px;"></div><br>

        <button type="submit"><?= $translations['update'] ?></button>
    </form>



    <?php include 'includes/footer.php'; ?>
</div>


<script>
    var lat = <?= htmlspecialchars($ubicacion[3]) ?>;
    var lng = <?= htmlspecialchars($ubicacion[4]) ?>;

    var map = L.map('map').setView([lat, lng], 13); // Centrar el mapa en la latitud y longitud de la ubicación actual

    // Cargar los tiles de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([lat, lng]).addTo(map); // Colocar un marcador en la ubicación actual

    // Función para manejar el clic en el mapa
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Mover el marcador a la nueva ubicación
        marker.setLatLng(e.latlng);

        // Actualizar los campos de latitud y longitud
        document.getElementById("latitud").value = lat;
        document.getElementById("longitud").value = lng;
    });
</script>