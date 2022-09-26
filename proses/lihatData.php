<?php
require_once '../middleware/auth.php';
require_once 'koneksi.php';
try {
    $query = $conn->query("
        SELECT *FROM user 
        INNER JOIN auth ON user.auth_id = auth.id
        INNER JOIN kelas ON user.kelas_id = kelas.id
    ");
    $data = [];
    while ($res = $query->fetch_assoc()) {
        $t['nik'] = $res['nik'];
        $t['nama'] = $res['nama'];
        $t['telp'] = $res['telp'];
        $t['username'] = $res['username'];
        $t['password'] = $res['password'];
        $t['role'] = $res['role_id'] == 2 ? 'mahasiswa' : '';
        $t['kelas'] = $res['nama_kelas'];
        $data[] = $t;
    }
    http_response_code(200);
    echo json_encode([
        'status'        =>  200,
        'data'          => $data
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status'        =>  500,
        'message'       => $e->getMessage()
    ]);
}
