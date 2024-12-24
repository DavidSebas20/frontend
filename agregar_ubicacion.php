<?php
include 'includes/header.php';
include 'includes/api_client.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Titulo' => $_POST['titulo'],
        'Direccion' => $_POST['direccion'],
        'Latitud' => $_POST['latitud'],
        'Longitud' => $_POST['longitud']
    ];

    try {
        apiRequest("POST", "ubicaciones", $data);
        header("Location: ubicaciones.php");
        exit;
    } catch (Exception $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
    }
}
?>

<link rel="stylesheet" href="assets/css/styles.css">
<!-- Incluir Leaflet CSS y JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<h1>Agregar Ubicación</h1>
<form method="POST">
    <label>Titulo:</label>
    <input type="text" name="titulo" required><br>

    <label>Dirección:</label>
    <input type="text" name="direccion" id="direccion" required><br>

    <label>Latitud:</label>
    <input type="text" name="latitud" id="latitud" readonly required><br>

    <label>Longitud:</label>
    <input type="text" name="longitud" id="longitud" readonly required><br>

    <div id="map" style="width: 100%; height: 400px;"></div><br>

    <button type="submit">Guardar</button>
</form>

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

<?php include 'includes/footer.php'; ?>
