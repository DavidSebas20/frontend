<link rel="stylesheet" href="assets/css/styles.css">
<div class="container">
    <?php include 'includes/header.php'; ?>
    <ul>
        <li><a href="contactos.php?lang=<?= $lang ?>"><?= $translations['see_contacts'] ?></a></li>
        <li><a href="eventos.php?lang=<?= $lang ?>"><?= $translations['see_events'] ?></a></li>
        <li><a href="ubicaciones.php?lang=<?= $lang ?>"><?= $translations['see_locations'] ?></a></li>
    </ul>
    <?php include 'includes/footer.php'; ?>
</div>