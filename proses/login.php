<?php
require_once "../vendor/autoload.php";
require_once "koneksi.php";

use Dotenv\Dotenv;
use Firebase\JWT\JWT;

header('Content-Type: application/json');
$dotEnv = Dotenv::createImmutable(__DIR__ . '/../');
$dotEnv->load();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}
$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['username']) || !isset($input['password'])) {
    http_response_code(400);
    exit();
}
$query = $conn->query("SELECT *FROM auth WHERE username = '" . $input['username'] . "' AND password = '" . $input['password'] . "'");
$row = $query->num_rows;
$data = $query->fetch_assoc();
if ($row <= 0) {
    echo "gak enek";
}
$expired_time = time() + (15 * 60);
$payload = [
    'iss' => 'http://localhost/API_PRESENSI',
    'aud' => 'http://localhost/API_PRESENSI',
    'iat' => 1356999524,
    'nbf' => 1357000000,
    'username' => $data['username'],
    'exp' => $expired_time
];
$access_token = JWT::encode($payload, $_ENV['SECRET_TOKEN'], 'HS256');
echo json_encode([
    'accessToken' => $access_token,
    'expiry' => date(DATE_ISO8601, $expired_time)
]);
