<?php
// Domínios permitidos
$dominiosPermitidos = [
    "http://localhost",
    "http://127.0.0.1",
    "https://flutlab.io",
    "https://ftp-bunco.alwaysdata.net"
];

// Verifica se a origem do request é válida
if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $dominiosPermitidos)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

// Headers e métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Resposta rápida para requisições OPTIONS (pré-flight CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
?>
