<?php
include 'includes/api_client.php';

$id = $_GET['id'];

try {
    apiRequest("DELETE", "contactos/$id");
    header("Location: contactos.php");
    exit;
} catch (Exception $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>
