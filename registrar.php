<link rel="stylesheet" href="assets/css/styles.css">
<div class="container">
    <?php include 'includes/header.php'; ?>
    <ul>
        <li><a href="agregar_contacto.php?lang=<?= $lang ?>"><?= $translations['add_contact'] ?></a></li>
        <li><a href="agregar_evento.php?lang=<?= $lang ?>"><?= $translations['add_event'] ?></a></li>
        <li><a href="agregar_ubicacion.php?lang=<?= $lang ?>"><?= $translations['add_location'] ?></a></li>
    </ul>
    <?php include 'includes/footer.php'; ?>
</div>