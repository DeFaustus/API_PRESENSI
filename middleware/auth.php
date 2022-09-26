<?php
require_once "../vendor/autoload.php";

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');
$dotEnv = Dotenv::createImmutable(__DIR__ . '/../');
$dotEnv->load();
$headers = getallheaders();
if (!isset($headers['Authorization'])) {
    http_response_code(400);
    echo json_encode([
        'status'        =>  400,
        'message'       => 'Bad Request'
    ]);
    exit();
}
list(, $token) = explode(' ', $headers['Authorization']);
try {
    JWT::decode($token, new Key($_ENV['SECRET_TOKEN'], 'HS256'));
} catch (Exception $e) {
    http_response_code(401);
    echo json_encode([
        'status'        =>  401,
        'message'       => $e->getMessage()
    ]);
    exit();
}
