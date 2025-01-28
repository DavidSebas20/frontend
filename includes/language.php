<?php
function loadLanguage($lang = 'es') {
    $file = __DIR__ . "/lang/$lang.php";
    if (file_exists($file)) {
        return include($file);
    }
    return include(__DIR__ . '/lang/en.php'); // Idioma predeterminado
}
function buildUrlWithParams($newParams = []) {
    $currentParams = $_GET;

    $params = array_merge($currentParams, $newParams);

    return '?' . http_build_query($params);
}

