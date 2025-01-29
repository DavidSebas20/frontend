<?php
require_once __DIR__ . '\language.php';
session_start();
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'es';
$_SESSION['lang'] = $lang;
$translations = loadLanguage($lang);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <div class="help-button">
            <a href="ayuda.php" class="btn btn-primary"><?= $translations['help'] ?></a>
        </div>
        <h1><?= htmlspecialchars($translations['system']) ?></h1>

        <div class="language-switch">
            <a href="<?= buildUrlWithParams(['lang' => 'en']) ?>">English</a> |
            <a href="<?= buildUrlWithParams(['lang' => 'es']) ?>">Español</a>
        </div>
        <nav>
            <a href="index.php"><?= htmlspecialchars($translations['home']) ?></a>
            <a href="registrar.php"><?= htmlspecialchars($translations['register']) ?></a>
            <a href="consultar.php"><?= htmlspecialchars($translations['consult']) ?></a>
            <a href="gestionar.php"><?= htmlspecialchars($translations['managment']) ?></a>

        </nav>
    </header>
</body>