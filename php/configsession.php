<?php
session_set_cookie_params([
    'lifetime' => 86400 * 30,  // 30 dias. Mudar caso seja necessário
    'path' => '/',
    'domain' => '',            // domínio se tiver que colocar
    'secure' => false,         // true se tiver usand HTTPS
    'httponly' => true,
    'samesite' => 'Lax'        // 'None' se usar HTTPS
]);

session_start();
