<?php
function apiRequest($method, $endpoint, $data = null) {
    $url = "https://backend-c-eventos.onrender.com/api/" . $endpoint;
    
    $options = [
        "http" => [
            "method" => $method,
            "header" => "Content-Type: application/json",
            "content" => $data ? json_encode($data) : null,
            "ignore_errors" => true // Captura errores HTTP en respuesta
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Obtener metadatos de la respuesta HTTP
    $http_response_header = $http_response_header ?? [];
    $status_code = null;

    if (!empty($http_response_header)) {
        preg_match('{HTTP\/\S*\s(\d{3})}', $http_response_header[0], $matches);
        $status_code = $matches[1] ?? null;
    }

    $decoded_response = json_decode($response, true);

    // Si el 'result' contiene un error relacionado con la restricción de longitud
    if (isset($decoded_response['result']) && strpos($decoded_response['result'], 'CHECK constraint failed') !== false) {
        return [
            "error" => true,
            "status" => $status_code,
            "message" => "El título no debe superar los 100 caracteres."
        ];
    }

    // Manejo de errores HTTP
    if ($status_code >= 400) {
        return [
            "error" => true,
            "status" => $status_code,
            "message" => $decoded_response['error'] ?? 'Error desconocido en la API'
        ];
    }

    return $decoded_response;
}
