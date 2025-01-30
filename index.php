<link rel="stylesheet" href="assets/css/styles.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management System - Home</title> 
</head>

<div class="container">
    <?php include 'includes/header.php'; ?>
    <h2><?= $translations['welcome'] ?></h2>
    <p><?= $translations['option'] ?></p>
    <ul>
        <li><a href="registrar.php"><?= $translations['register'] ?></a></li>
        <li><a href="consultar.php"><?= $translations['consult'] ?></a></li>
        <li><a href="gestionar.php"><?= $translations['managment'] ?></a></li>
    </ul>
    <?php include 'includes/footer.php'; ?>
</div>