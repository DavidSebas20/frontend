<?php
include 'includes/api_client.php';

$id = $_GET['id'];

try {
    apiRequest("DELETE", "eventos/$id");
    header("Location: eventos.php");
    exit;
} catch (Exception $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>
