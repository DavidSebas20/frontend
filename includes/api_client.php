<?php
function apiRequest($method, $endpoint, $data = null) {
    $url = "https://backend-c-eventos.onrender.com/api/" . $endpoint;
    $options = [
        "http" => [
            "method" => $method,
            "header" => "Content-Type: application/json",
            "content" => $data ? json_encode($data) : null
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}
