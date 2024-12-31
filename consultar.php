<link rel="stylesheet" href="assets/css/styles.css">
<div class="container">
    <?php 
    include 'includes/header.php'; 
    include 'includes/api_client.php'; 

    // Inicializamos variables
    $resultados = [];
    $tabla = "";

    // Si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $busqueda = htmlspecialchars($_POST['busqueda']);
        $tabla = $_POST['tabla'];

        // Obtenemos todos los datos según la tabla seleccionada
        if ($tabla === "contactos") {
            $datos = apiRequest("GET", "contactos");
        } elseif ($tabla === "eventos") {
            $datos = apiRequest("GET", "eventos");
        } elseif ($tabla === "ubicaciones") {
            $datos = apiRequest("GET", "ubicaciones");
        }

        // Filtramos los resultados que coincidan con la búsqueda
        $resultados = array_filter($datos, function($item) use ($busqueda) {
            foreach ($item as $campo) {
                if (stripos($campo, $busqueda) !== false) {
                    return true;
                }
            }
            return false;
        });
    }
    ?>
    
    <h1>Consultar Información</h1>
    <form method="POST" action="consultar.php" class="form-busqueda">
        <input type="text" name="busqueda" placeholder="Ingrese el término a buscar" required>
        <div class="botones">
            <button type="submit" name="tabla" value="contactos" class="btn btn-contactos">Buscar en Contactos</button>
            <button type="submit" name="tabla" value="eventos" class="btn btn-eventos">Buscar en Eventos</button>
            <button type="submit" name="tabla" value="ubicaciones" class="btn btn-ubicaciones">Buscar en Ubicaciones</button>
        </div>
    </form>

    <?php if (!empty($resultados)): ?>
        <h2>Resultados en <?= ucfirst($tabla) ?></h2>
        <table>
            <thead>
                <tr>
                    <?php if ($tabla === "contactos"): ?>
                        <th>Saludo</th>
                        <th>Nombre Completo</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <th>Imagen</th>
                    <?php elseif ($tabla === "eventos"): ?>
                        <th>Título</th>
                        <th>Invitados</th>
                        <th>Fecha Hora</th>
                        <th>Zona Horaria</th>
                        <th>Descripción</th>
                        <th>Clasificación</th>
                        <th>Lugar</th>
                        <th>Recordatorio</th>
                    <?php elseif ($tabla === "ubicaciones"): ?>
                        <th>Título</th>
                        <th>Dirección</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $resultado): ?>
                    <tr>
                        <?php if ($tabla === "contactos"): ?>
                            <td><?= htmlspecialchars($resultado[1]) ?></td>
                            <td><?= htmlspecialchars($resultado[2]) ?></td>
                            <td><?= htmlspecialchars($resultado[4]) ?></td>
                            <td><?= htmlspecialchars($resultado[5]) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($resultado[6]) ?>" alt="Imagen de contacto" class="imagen-tabla">
                            </td>
                        <?php elseif ($tabla === "eventos"): ?>
                            <td><?= htmlspecialchars($resultado[1]) ?></td>
                            <td><?= htmlspecialchars($resultado[2]) ?></td>
                            <td><?= htmlspecialchars($resultado[3]) ?></td>
                            <td><?= htmlspecialchars($resultado[4]) ?></td>
                            <td><?= htmlspecialchars($resultado[5]) ?></td>
                            <td><?= htmlspecialchars($resultado[6]) ?></td>
                            <td><?= htmlspecialchars($resultado[7]) ?></td>
                            <td>
                                <?php if ($resultado[8] == 1): ?>
                                    <i class="fa fa-check-circle" style="color: green;"></i>
                                <?php else: ?>
                                    <i class="fa fa-times-circle" style="color: red;"></i>
                                <?php endif; ?>
                            </td>
                        <?php elseif ($tabla === "ubicaciones"): ?>
                            <td><?= htmlspecialchars($resultado[1]) ?></td>
                            <td><?= htmlspecialchars($resultado[2]) ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <p>No se encontraron resultados para la búsqueda.</p>
    <?php endif; ?>

    <?php include 'includes/footer.php'; ?>
</div>
