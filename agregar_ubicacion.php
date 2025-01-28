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
            'Titulo' => $_POST['titulo'],
            'Direccion' => $_POST['direccion'],
            'Latitud' => $_POST['latitud'],
            'Longitud' => $_POST['longitud']
        ];

        try {
            apiRequest("POST", "ubicaciones", $data);
            $successMessage = $translations['success_add_location'];
        } catch (Exception $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
    ?>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <h1><?= $translations['add_location'] ?></h1>
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

        <label><?= $translations['address'] ?>:</label>
        <input type="text" name="direccion" id="direccion" required><br>

        <label><?= $translations['latitude'] ?>:</label>
        <input type="text" name="latitud" id="latitud" readonly required><br>

        <label><?= $translations['longitude'] ?>:</label>
        <input type="text" name="longitud" id="longitud" readonly required><br>

        <div id="map" style="width: 100%; height: 400px;"></div><br>

        <button type="submit"><?= $translations['save'] ?></button>
    </form>



    <?php include 'includes/footer.php'; ?>

</div>

<script>
    var map = L.map('map').setView([0, 0], 2); // Centrado en el mapa globalmente, puedes ajustarlo

    // Cargar los tiles de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker;

    // Función para manejar el clic en el mapa
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Colocar un marcador en el lugar donde se hizo clic
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker([lat, lng]).addTo(map);
        }

        // Actualizar los campos de latitud y longitud
        document.getElementById("latitud").value = lat;
        document.getElementById("longitud").value = lng;
    });
</script>