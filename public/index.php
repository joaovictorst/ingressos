<?php

require_once __DIR__ . '/../src/Response.php';


try {
    $resposta = new Response();

    $resposta = $resposta->init($_SERVER['REQUEST_URI'], getenv('APP_VERSAO'));
    http_response_code($resposta['status']);
    echo json_encode($resposta['body'], JSON_PRETTY_PRINT);
} catch (\Throwable $th) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'erro interno do servidor'
    ], JSON_PRETTY_PRINT);
}
