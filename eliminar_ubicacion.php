<?php
include 'includes/api_client.php';

$id = $_GET['id'];

try {
    apiRequest("DELETE", "ubicaciones/$id");
    header("Location: ubicaciones.php");
    exit;
} catch (Exception $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>
